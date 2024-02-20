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
        $answers = Answer::where('idQuestion', $question->id)->get();
        $answerCount = $answers->count();

        return view('teacher.exam.question.edit', compact('question', 'answers', 'answerCount'));
    }

    public function showQuestion($idExam)
    {
        $exam = Exam::findOrFail($idExam);
        $questions = Question::where('idExam', $exam->id)->get();

        return view('teacher.exam.question.show', compact('exam', 'questions'));
    }

    public function updateQuestion(Request $request, $idExam, $idQuestion)
    {
        DB::beginTransaction();
        $exam = Exam::findOrFail($idExam);
        $question = Question::findOrFail($idQuestion);
        $answers = Answer::where('idQuestion', $question->id)->get();

        $request->validate([
            'content' => 'required|string',
            'answer_content' => 'required|string',
        ], [
            'content.required' => 'Kolom uraian Pertanyan harus diisi',
            'answer_content.required' => 'Jawaban harus dipilih',
        ]);

        try {
            $description = $request->input('content');

            // Handle file upload logic
            $uploadedImages = session('uploaded_images_questions', []);

            // Ambil deskripsi dari formulir
            $description = $request->input('content');

            // Ambil URL gambar dari deskripsi yang ada di database
            $existingImageUrls = $this->extractImageUrlsFromContent($question->content);

            // Loop melalui URL gambar yang diunggah
            foreach ($uploadedImages as $imageUrl) {
                if (!in_array($imageUrl, $existingImageUrls) && strpos($description, $imageUrl) === false) {
                    $this->deleteImageFromStorage($imageUrl);
                }
            }
            foreach ($existingImageUrls as $existingImageUrl) {
                // Hanya hapus gambar jika URL tidak ada di dalam deskripsi saat ini
                if (strpos($description, $existingImageUrl) === false) {
                    $this->deleteImageFromStorage($existingImageUrl);
                }
            }

            $question->content = $request->input('content');
            $question->idExam = $exam->id;
            $question->save();

            // Hapus sesi setelah selesai
            session()->forget('uploaded_images_questions');

            // $answers sekarang berisi kumpulan ID jawaban yang sesuai dengan pertanyaan tertentu
            $answers = Answer::where('idQuestion', $question->id)->get();
            $idAnswer = $answers->pluck('id');

            foreach ($request->answer as $key => $choice) {
                if (!empty($choice['answer_content'])) {
                    $answerId = $idAnswer[$key - 1] ?? null;

                    if ($answerId !== null) {
                        $answer = Answer::findOrFail($answerId);

                        $description = $choice['answer_content'];
                        $uploadedImages = session("uploaded_images_answers_$key", []);

                        // Ambil URL gambar dari deskripsi yang ada di database
                        $existingImageUrls = $this->extractImageUrlsFromContent($description);

                        // Loop melalui URL gambar yang diunggah
                        foreach ($uploadedImages as $imageUrl) {
                            if (!in_array($imageUrl, $existingImageUrls) && strpos($description, $imageUrl) === false) {
                                $fileName = basename($imageUrl);
                                $filePath = public_path("images/media/answers_$key/" . $fileName);

                                if (file_exists($filePath)) {
                                    unlink($filePath);
                                }
                            }
                        }
                        foreach ($existingImageUrls as $existingImageUrl) {
                            // Hanya hapus gambar jika URL tidak ada di dalam deskripsi saat ini
                            if (strpos($description, $existingImageUrl) === false) {
                                $fileName = basename($existingImageUrl);
                                $filePath = public_path("images/media/answers_$key/" . $fileName);

                                if (file_exists($filePath)) {
                                    unlink($filePath);
                                }
                            }
                        }
                        $answer->answer_content = $choice['answer_content'];
                        $answer->isCorrect = $key == $request->answer_content ? '1' : '0';

                        $answer->save();
                    } else {
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
                    }
                } else {
                    return back()->with('error', 'Jawaban tidak boleh kosong.');
                }
            }


            DB::commit();
            return redirect('/teacher/' . $question->idExam . '/questions/show')->with('success', 'Anda berhasil mengubah soal');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroyQuestion($id)
    {
        DB::beginTransaction();

        try {
            $question = Question::findOrFail($id);

            $this->deleteQuestionImages($question->content);

            $answers = Answer::where('idQuestion', $id)->get();
            $idAnswer = $answers->pluck('id');

            foreach ($answers as $key => $answer) {
                $answerId = $idAnswer[$key] ?? null;
                $answer = Answer::findOrFail($answerId);
                $uploadedimages = $answer['answer_content'];
                $existingImageUrls = $this->extractImageUrlsFromContent($uploadedimages);

                foreach ($existingImageUrls as $imageUrl) {
                    $fileName = basename($imageUrl);
                    $filePath = public_path("images/media/answers_" . ($key + 1) . "/" . $fileName);

                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
                $answer->delete();
            }

            Answer::where('idQuestion', $id)->delete();

            $question->delete();

            DB::commit();

            return back()->with('success', 'Pertanyaan dan jawabannya berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroyAnswer($id)
    {
        // Mengambil jawaban berdasarkan ID
        $answer = Answer::findOrFail($id);
        // Menghapus jawaban dari database
        $answer->delete();

        // Menyimpan ID pertanyaan untuk penggunaan berikutnya
        // $idQuestion = $answer->idQuestion;

        // // Menghitung jumlah jawaban yang masih terkait dengan pertanyaan
        // $remainingAnswersCount = Answer::where('idQuestion', $idQuestion)->count();

        // $uploadedImages = $this->extractImageUrlsFromContent($answer->answer_content);
        // dd($uploadedImages);

        // // Loop untuk setiap gambar dan hapus
        // foreach ($uploadedImages as $imageUrl) {
        //     $fileName = basename($imageUrl);

        //     // Menghapus gambar dari folder answers_1 hingga answers_n
        //     for ($key = 1; $key <= $remainingAnswersCount; $key++) {
        //         $filePath = public_path("images/media/answers_$key/" . $fileName);

        //         if (file_exists($filePath)) {
        //             unlink($filePath);
        //         }
        //     }
        // }

        // // Menghapus folder answers_1 hingga answers_n
        // for ($key = 1; $key <= $remainingAnswersCount; $key++) {
        //     $folderPath = public_path("images/media/answers_" . $key);

        //     if (is_dir($folderPath)) {
        //         rmdir($folderPath);
        //     }
        // }

        return back()->with('success', 'Jawaban berhasil dihapus.');
    }

    private function deleteAnswerImages($content, $key)
    {
        // Saring gambar-gambar yang seharusnya dihapus
        $existingImageUrls = $this->extractImageUrlsFromContent($content);

        foreach ($existingImageUrls as $imageUrl) {
            $fileName = basename($imageUrl);
            $filePath = public_path("images/media/answers_$key/" . $fileName);

            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
    }

    /**
     * Extract image URLs from the content.
     *
     * @param string $content
     * @return array
     */
    private function extractImageUrlsFromContent($content)
    {
        $pattern = '/<img[^>]+src\s*=\s*["\']([^"\']+)["\'][^>]*>/i';
        preg_match_all($pattern, $content, $matches);

        return $matches[1];
    }

    /**
     * Delete image from storage.
     *
     * @param string $imageUrl
     * @return void
     */
    private function deleteImageFromStorage($imageUrl)
    {
        $fileName = basename($imageUrl);
        $filePath = public_path('images/media/questions/' . $fileName);

        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    private function deleteQuestionImages($content)
    {
        $existingImageUrls = $this->extractImageUrlsFromContent($content);

        foreach ($existingImageUrls as $imageUrl) {
            $this->deleteImageFromStorage($imageUrl);
        }
    }
}
