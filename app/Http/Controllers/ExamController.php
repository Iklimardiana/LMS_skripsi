<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ExamController extends Controller
{
    public function exams($id)
    {
        $examsQuery = Exam::where('idSubject', $id);

        if (request()->has('keyword')) {
            $keyword = request('keyword');
            $examsQuery->where(function ($query) use ($keyword) {
                $query->where('title', 'LIKE', '%' . $keyword . '%')
                    ->orwhere('type', 'LIKE', '%' . $keyword . '%');
            });
        }

        $exams = $examsQuery->paginate(10);
        $iteration = $exams->firstItem();
        $subject = Subject::find($id);
        return view('teacher.exam.view', compact('exams', 'iteration', 'subject'));
    }

    public function storeExam(Request $request, $idSubject)
    {
        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'duration' => 'required|numeric'
        ], [
            'title.required' => 'Judul/ nama ujian harus diisi',
            'type.required' => 'Tipe ujian harus dipilih',
            'duration.required' => 'Durasi waktu ujian harus diisi',
            'duration.numeric' => 'Durasi harus diisi dengan angka'
        ]);

        $exam = new Exam;

        $exam->title = $request->title;
        $exam->type = $request->type;
        $exam->duration = $request->duration;
        $exam->idSubject = $idSubject;

        $exam->save();

        return redirect()->back();
    }

    public function destroyExam($id)
    {
        $exam = Exam::findOrFail($id);

        $exam->delete();

        return redirect()->back();
    }

    public function updateStatus(Request $request, $id)
    {
        $exam = Exam::findOrFail($id);
        $newStatus = $exam->status == '1' ? '0' : '1';
        $exam->update(['status' => $newStatus]);

        return redirect()->back()->with('success', 'Status ujian berhasil diperbarui.');
    }

    public function updateExam(Request $request, $id)
    {
        $exam = Exam::findOrFail($id);
        $idSubject = $exam->idSubject;

        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'duration' => 'required|numeric'
        ], [
            'title.required' => 'Judul/ nama ujian harus diisi',
            'type.required' => 'Tipe ujian harus dipilih',
            'duration.required' => 'Durasi waktu ujian harus diisi',
            'duration.numeric' => 'Durasi harus diisi dengan angka'
        ]);

        $exam->title = $request->title;
        $exam->duration = $request->duration;
        $exam->type = $request->type;
        $exam->idSubject = $idSubject;

        $exam->save();

        return redirect()->back();
    }

    public function ExamStudent($id)
    {
        $examsQuery = Exam::where('idSubject', $id);

        if (request()->has('keyword')) {
            $keyword = request('keyword');
            $examsQuery->where(function ($query) use ($keyword) {
                $query->where('title', 'LIKE', '%' . $keyword . '%')
                    ->orwhere('type', 'LIKE', '%' . $keyword . '%');
            });
        }

        $exams = $examsQuery->get();
        $subject = Subject::find($id);
        return view('student.exam.view', compact('exams', 'subject'));
    }

    public function createQuestion($id)
    {
        $exam = Exam::findOrFail($id);

        return view('teacher.exam.question.create', compact('exam'));
    }

    public function storeQuestion(Request $request, $idExam)
    {
        DB::beginTransaction();
        $exam = Exam::findOrFail($idExam);

        $request->validate([
            'content' => 'required|string',
            'answer_content' => 'required|string',
        ], [
            'content.required' => 'Kolom uraian Pertanyan harus diisi',
            'answer_content.required' => 'Jawaban harus dipilih',
        ]);
        try {
            $question = new Question;
            $question->content = $request->input('content');
            $question->idExam = $exam->id;

            $question->save();
            $description = $request->input('content');

            $uploadedImages = session('uploaded_images_questions', []);

            foreach ($uploadedImages as $imageUrl) {
                if (strpos($description, $imageUrl) === false) {
                    $fileName = basename($imageUrl);
                    $filePath = public_path('images/media/questions/' . $fileName);

                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
            }

            // Hapus sesi setelah selesai
            session()->forget('uploaded_images_questions');

            foreach ($request->answer as $key => $choice) {
                if (!empty($choice['answer_content'])) {
                    $answer = new Answer;
                    $answer->idQuestion = $question->id;
                    $answer->answer_content = $choice['answer_content'];
                    $answer->isCorrect = $key == $request->answer_content ? '1' : '0';
                    $answer->save();

                    $description = $choice['answer_content'];
                    $uploadedImages = session("uploaded_images_answers_$key", []);

                    foreach ($uploadedImages as $imageUrl) {
                        if (strpos($description, $imageUrl) === false) {
                            $fileName = basename($imageUrl);
                            $filePath = public_path("images/media/answers_$key/" . $fileName);

                            if (file_exists($filePath)) {
                                unlink($filePath);
                            }
                        }
                    }

                    // Hapus sesi setelah selesai
                    session()->forget("uploaded_images_answers_$key");
                } else {
                    return back()->with('error', 'Jawaban tidak boleh kosong.');
                }
            }

            DB::commit();
            return redirect('/teacher/exam/' . $exam->idSubject)->with('success', 'Anda berhasil menambahkan soal');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function editQuestion($id)
    {
        $question = Question::findOrFail($id);
        $answer = Answer::where('idQuestion', $question->id)->get();

        return view('teacher.exam.question.edit', compact('question', 'answer'));
    }

    public function showQuestion($idExam)
    {
        $exam = Exam::findOrFail($idExam);
        $questions = Question::where('idExam', $exam->id)->get();

        return view('teacher.exam.question.show', compact('exam', 'questions'));
    }
}
