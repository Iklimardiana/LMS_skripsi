<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use App\Models\Subject;
use App\Models\UserAnswer;
use App\Models\UserExam;
use Illuminate\Http\Request;

class ExamStudentController extends Controller
{
    public function index()
    {
        $userExam = UserExam::with('exam')->where([
            'idStudent' => auth()->id(),
            'status' => 0
        ])->where('finish', '>=', now())->first();

        return view('student.exam.start', compact('userExam'));
    }

    public function examList($id)
    {
        $subject = Subject::find($id);
        $examsQuery = Exam::where('idSubject', $id);

        if (request()->has('keyword')) {
            $keyword = request('keyword');
            $examsQuery->where(function ($query) use ($keyword) {
                $query->where('title', 'LIKE', '%' . $keyword . '%')
                    ->orwhere('type', 'LIKE', '%' . $keyword . '%');
            });
        }

        $exams = $examsQuery->get();
        $iteration = 1;

        $ongoingExam = UserExam::where('idStudent', auth()->id())
            ->where('status', 0)
            ->first();
        // Menyiapkan array yang akan berisi informasi tentang ketersediaan ujian untuk setiap ujian
        $examAvailability = [];

        foreach ($exams as $exam) {
            $userExam = UserExam::where('idExam', $exam->id)
                ->where('idStudent', auth()->id())
                ->first();
            // dd($userExam);

            $status = $exam->status;
            $userExamStatus = $userExam ? $userExam->status : null;
            $isUserExamInProgress = $userExam && $userExam->timeRemaining() > 0;
            $timeExpired = $userExam && $userExam->timeRemaining() <= 0;

            // Menentukan status ujian (mulai, lanjutkan, atau tampilkan skor) berdasarkan kondisi
            if ($status == 1 && !$userExam) {
                $availability = 'start'; // Mulai ujian
            } elseif ($status == 1 && $userExamStatus == 0 && $isUserExamInProgress) {
                $availability = 'continue'; // Lanjutkan ujian
            } elseif ($status == 1 && $userExamStatus == 1) {
                $availability = 'score'; // Tampilkan skor
            } else {
                $availability = null; // Ujian tidak tersedia
            }

            $examAvailability[$exam->id] = [
                'availability' => $availability,
                'score' => $userExam ? $userExam->score : null,
                'finish' => $userExam ? $userExam->finish : null,
            ];

        }

        return view('student.exam.view', compact('exams', 'subject', 'examAvailability', 'iteration', 'ongoingExam'));
    }

    // public function examList($id)
    // {
    //     $examsQuery = Exam::where('idSubject', $id);

    //     if (request()->has('keyword')) {
    //         $keyword = request('keyword');
    //         $examsQuery->where(function ($query) use ($keyword) {
    //             $query->where('title', 'LIKE', '%' . $keyword . '%')
    //                 ->orwhere('type', 'LIKE', '%' . $keyword . '%');
    //         });
    //     }

    //     $exams = $examsQuery->get();
    //     $subject = Subject::find($id);
    //     return view('student.exam.view', compact('exams', 'subject'));
    // }
    public function startExam(Request $request, $id)
    {
        $exam = Exam::find($id);

        $userExam = new UserExam;
        $userExam->idExam = $exam->id;
        $userExam->idStudent = auth()->id();
        $userExam->begin = now();
        $userExam->finish = now()->addMinutes($exam->duration);
        $userExam->save();

        $questions = $exam->Question()->pluck('id');
        $randomQuestions = Question::whereIn('id', $questions)->inRandomOrder()->get();

        foreach ($randomQuestions as $question) {
            $userAnswer = new UserAnswer;
            $userAnswer->idUserExam = $userExam->id;
            $userAnswer->idQuestion = $question['id'];
            $userAnswer->is_correct = '0';
            $userAnswer->save();
        }

        // dd($userExam);
        // dd($id);

        return redirect()->route('exam', ['id' => $id]);
    }

    public function question(Request $request)
    {
        $question = UserAnswer::with('question.answer')->where('idUserExam', $request->idUserExam)->paginate(1);

        return response()->json($question);
    }

    public function questionList(Request $request)
    {
        $question = UserAnswer::where('idUserExam', $request->idUserExam)->get();

        return response()->json($question);
    }

    public function saveAnswer(Request $request)
    {
        $userAnswer = UserAnswer::with('Question.trueAnswer')->findOrFail($request->id);
        // dd($userAnswer);
        $userAnswer->user_answer = $request->user_answer;

        if ($userAnswer->Question->trueAnswer->id == $userAnswer->user_answer) {
            $userAnswer->is_correct = '1';
        } else {
            $userAnswer->is_correct = '0';
        }

        $userAnswer->save();

        $this->_countScore($userAnswer->idUserExam);

        return response()->json(true);
    }

    public function finishExam(Request $request)
    {
        $userExam = UserExam::findOrFail($request->idUserExam);
        $userExam->status = 1;
        $userExam->save();

        $this->_countScore($userExam->id);

        return response()->json(true);
    }

    private function _countScore($userExamId)
    {
        $userExam = UserExam::with('UserAnswer')->findOrFail($userExamId);
        $totalQuestion = count($userExam->UserAnswer);

        $true = 0;
        foreach ($userExam->UserAnswer as $key => $value) {
            if ($value->is_correct == 1) {
                $true++;
            }
        }

        $score = ($true / $totalQuestion) * 100;

        $userExam->score = $score;
        $userExam->save();

        return $score;
    }
}
