<?php

namespace App\Http\Controllers;

use App\Models\AnswerDiscussion;
use App\Models\DiscussionQuestion;
use App\Models\Subject;
use App\Models\Material;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DiscussionController extends Controller
{
    public function questions($id)
    {
        $subject = Subject::findOrFail($id);

        // Mengambil nama-nama materi unik dari kumpulan pertanyaan pada subjek ini
        $materials = Material::where('id', function ($query) use ($subject) {
            $query->select('id')
                ->where('idSubject', $subject->id)
                ->distinct();
        })->pluck('name', 'id');

        // Mengambil semua materi terkait dengan subjek
        $allMaterials = Material::where('idSubject', $subject->id)->get();

        // Mengambil pertanyaan berdasarkan materi yang dipilih (jika ada)
        $selectedMaterial = request('material');
        $questions = DiscussionQuestion::where('idSubject', $subject->id)
            ->when($selectedMaterial, function ($query) use ($selectedMaterial) {
                return $query->where('idMaterial', $selectedMaterial);
            })
            ->get();

        $questionCount = count($questions);

        return view("discussion.view", compact("subject", "questions", "questionCount", "materials", "allMaterials"));
    }

    public function showQuestion($id)
    {
        $question = DiscussionQuestion::findOrFail($id);
        return view("discussion.show", compact("question"));
    }

    public function storeQuestion(Request $request, $id)
    {
        $request->validate([
            'question' => 'required',
            'image' => 'nullable|mimes:png,jpeg,jpg|max:2048',
            'idMaterial' => 'required',
        ]);

        $subject = Subject::findOrFail($id);
        $idSubject = $subject->id;

        $idUser = Auth::id();

        $question = new DiscussionQuestion;

        if ($request->has('image')) {

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('images/discussion/'), $imageName);

            $question->image = $imageName;
        }

        $question->question = $request->question;
        $question->idMaterial = $request->idMaterial;
        $question->idUser = $idUser;
        $question->idSubject = $idSubject;


        $question->save();

        return back();
    }

    public function destroyQuestion($id)
    {
        $question = DiscussionQuestion::findOrFail($id);

        if (!empty($question->image)) {
            $imagePath = public_path('images/discussion/' . $question->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $question->delete();

        return back();
    }

    public function updateQuestion(Request $request, $id)
    {
        $question = DiscussionQuestion::findOrFail($id);
        $request->validate([
            'question' => 'required',
            'image' => 'mimes:png,jpeg,jpg|max:2048',
            'idMaterial' => 'required',
        ], [
            'idMaterial.required' => 'Materi Harus Dipilih',
            'question.required' => 'Kolom pertanyaan Harus Diisi',
        ]);

        if ($request->hasFile('image')) {
            if (!empty($question->image)) {
                $imagePath = public_path('images/discussion/' . $question->image);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }
        }

        $question->update([
            'question' => $request->question,
            'idMaterial' => $request->idMaterial,
        ]);

        // Mengunggah gambar baru jika ada gambar yang diunggah
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/discussion/'), $imageName);
            $question->image = $imageName;
            $question->save();
        }

        return back();
    }

    public function storeAnswer(Request $request, $id)
    {
        $request->validate([
            'answer' => 'required',
        ]);

        $question = DiscussionQuestion::findOrFail($id);
        $iduser = Auth::id();

        $answer = new AnswerDiscussion;

        $answer->idUser = $iduser;
        $answer->answer = $request->answer;
        $answer->idQuestion = $question->id;

        $answer->save();

        return back();

    }

    public function updateAnswer(Request $request, $id)
    {
        $request->validate([
            'answer' => 'required'
        ]);
        $idUser = Auth::id();

        $answer = AnswerDiscussion::findOrFail($id);
        $idQuestion = $answer->idQuestion;

        $answer->update([
            'answer' => $request->answer,
            'idQuestion' => $idQuestion,
            'idUser' => $idUser
        ]);

        return back();
    }

    public function destroyAnswer($id)
    {
        $answer = AnswerDiscussion::findOrFail($id);

        $answer->delete();

        return back();
    }
}
