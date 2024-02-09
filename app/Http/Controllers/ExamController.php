<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            $question->content = strip_tags($request->content);
            $question->idExam = $exam->id;

            $question->save();
            foreach ($request->answer as $key => $choice) {
                if (!empty($choice['answer_content'])) {
                    $answer = new Answer;
                    $answer->idQuestion = $question->id;
                    $answer->answer_content = strip_tags($choice['answer_content']);
                    $answer->isCorrect = $key == $request->answer_content ? '1' : '0';
                    $answer->save();
                } else {
                    return back()->with('error', 'Jawaban tidak boleh kosong.');
                }
            }

            DB::commit();

            // return response()->json([
            //     'status' => TRUE,
            //     'message' => 'Question and answers saved successfully.',
            //     'data' => $question
            // ], 200);
            return redirect('/teacher/exam/' . $exam->idSubject)->with('success', 'Anda berhasil menambahkan soal');
        } catch (\Exception $e) {
            DB::rollBack();

            // return response()->json([
            //     'status' => FALSE,
            //     'message' => 'Failed to save question and answers. ' . $e->getMessage()
            // ], 500);
            return back()->with('error', $e->getMessage());
        }
    }

    public function storeOption(Request $request, $idQuestion)
    {
        $request->validate([
            'content' => 'required',
            'isCorrect' => 'required',
        ], [
            'content.required' => 'Konten soal harus diisi',
            'isCorrect.required' => 'Mohon pilih benar atau salahnya option',
        ]);

        $question = Question::findOrFail($idQuestion);
        $idQuestion = $question->id;

        $option = new Answer;

        $option->content = $request->input('content');
        $option->idQuestion = $idQuestion;

        $option->save();

        $description = $request->input('content');

        $uploadedImages = session('uploaded_images', []);

        foreach ($uploadedImages as $imageUrl) {
            if (strpos($description, $imageUrl) === false) {
                $fileName = basename($imageUrl);
                $filePath = public_path('images/media/' . $fileName);

                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }

        // Hapus sesi setelah selesai
        session()->forget('uploaded_images');

        return response()->json([
            'id' => $option->id,
            'content' => $option->content,
            'idQuestion' => $option->idQuestion,
            'isCorrect' => $option->isCorrect
            // Add more fields as needed
        ]);
    }
}
