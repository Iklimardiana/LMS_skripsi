<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Material;
use App\Models\Progres;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subject;
use App\Models\Enrollment;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class TeacherController extends Controller
{
    public function dashboard()
    {
        $teacherId = Auth::user()->id;

        $subjects = Subject::where('idTeacher', $teacherId)->get();
        $subjectCount = $subjects->count();

        $totalStudents = 0;
        $students = [];

        foreach ($subjects as $subject) {
            $enrollments = Enrollment::where('idSubject', $subject->id)->get();

            foreach ($enrollments as $enrollment) {
                $enrollmentStudents = $enrollment->user()->where('role', 'student')->get();

                if ($enrollmentStudents->isNotEmpty()) {
                    $students[$subject->name][] = $enrollmentStudents;
                    $totalStudents += $enrollmentStudents->count();
                }
            }
        }

        return view("teacher.dashboard", compact('totalStudents', 'students', 'subjectCount', 'subjects'));
    }

    public function subjects()
    {
        $teacherId = Auth::user()->id;
        $subjects = Subject::where('idTeacher', $teacherId)->get();

        if (request('keyword')) {
            $subjects = Subject::where('idTeacher', $teacherId)->where('name', 'LIKE', '%' . request('keyword') . '%')->get();
        }

        if (!empty($subjects)) {
            foreach ($subjects as $subject) {
                $enrollment = Enrollment::where('idSubject', $subject->id)->first();

                if ($enrollment) {
                    $students = $enrollment->User()->where('role', 'student')->get();
                }
            }
        } else {
            $subjects = [];
        }
        return view("teacher.subject.view", compact('subjects'));
    }

    public function students($id)
    {
        $subject = Subject::where('id', $id)->first();
        $enrollmentQuery = Enrollment::where('idSubject', $id);

        if (request('keyword')) {
            $enrollmentQuery->whereHas('user', function ($query) {
                $keyword = request('keyword');
                $query->where(function ($subquery) use ($keyword) {
                    $subquery->where('first_name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('last_name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere(DB::raw("CONCAT(first_name, ' ', last_name)"), 'LIKE', '%' . $keyword . '%')
                        ->where('role', 'student');
                });
            });
        }

        $enrollment = $enrollmentQuery->paginate(10);
        $iteration = $enrollment->firstItem();
        $students = $enrollment->pluck('user')->where('role', 'student');
        $progres = Progres::where('idSubject', $id)->get();

        return view('teacher.student.view', compact('subject', 'progres', 'iteration', 'students', 'enrollment'));
    }

    public function materials($id)
    {
        $materialsQuery = Material::where('idSubject', $id)->orderBy('sequence', 'ASC');

        if (request()->has('keyword')) {
            $keyword = request('keyword');
            $materialsQuery->where(function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%')
                    ->orwhere('sequence', 'LIKE', '%' . $keyword . '%');
            });
        }

        $materials = $materialsQuery->paginate(10);
        $iteration = $materials->firstItem();
        $subjects = Subject::find($id);
        $assignment = Assignment::where('idSubject', $id)
            ->where('category', 'fromteacher')->get();

        return view('teacher.material.view', compact('materials', 'subjects', 'assignment', 'iteration'));
    }

    public function settingSubject(Request $request, $id)
    {
        $request->validate([
            'enrollment_key' => 'required|string|min:6|confirmed',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'enrollment_key.required' => 'Enrollment Key harus diisi. Coba lagi',
            'enrollment_key.confirmed' => 'Konfirmasi Enrollment key tidak cocok. Coba lagi',
            'thumbnail.image' => 'File harus berupa gambar.',
            'thumbnail.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg, gif.',
            'thumbnail.max' => 'Ukuran gambar tidak boleh melebihi 2 MB.',
        ]);

        $subject = Subject::findOrFail($id);

        if ($subject->idTeacher !== auth()->user()->id) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $subject->update([
            'enrollment_key' => $request->enrollment_key,
        ]);

        if ($request->hasFile('thumbnail')) {
            $path = "images/thumbnail/";

            if ($subject->thumbnail && $subject->thumbnail !== 'thumbnailDefault.jpg') {
                File::delete(public_path($path . $subject->thumbnail));
            }

            $thumbnailName = time() . '.' . $request->thumbnail->extension();
            $request->thumbnail->move(public_path($path), $thumbnailName);
            $subject->thumbnail = $thumbnailName;
            $subject->save();
        }

        return redirect('/teacher/subject');

    }

    public function createMaterial($idSubject)
    {
        $subjects = Subject::find($idSubject);
        return view('teacher.material.create', compact('subjects'));
    }

    public function storeMaterial(Request $request, $idSubject)
    {
        $request->validate([
            'sequence' => 'required|numeric',
            'name' => 'required',
            'content' => 'required'
        ], [
            'sequence.required' => 'Urutan materi harus diisi',
            'sequence.numeric' => 'urutan materi harus berupa angka',
            'name.required' => 'Judul materi harus diisi',
            'content.required' => 'Konten materi harus diisi'
        ]);

        $newSequence = $request->sequence;

        $existingMaterial = Material::where('idSubject', $idSubject)
            ->where('sequence', $newSequence)->first();

        if ($existingMaterial) {
            Material::where('idSubject', $idSubject)
                ->where('sequence', '>=', $newSequence)
                ->increment('sequence');
        }

        $materials = new Material;

        $materials->name = $request->name;
        $materials->content = $request->input('content');
        $materials->sequence = $request->sequence;
        $materials->idSubject = $idSubject;

        $materials->save();

        $description = $request->input('content');

        $uploadedImages = session('uploaded_images_materials', []);

        foreach ($uploadedImages as $imageUrl) {
            if (strpos($description, $imageUrl) === false) {
                $fileName = basename($imageUrl);
                $filePath = public_path('images/media/materials/' . $fileName);

                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }

        // Hapus sesi setelah selesai
        session()->forget('uploaded_images_materials');

        // Ambil urutan yang ada setelah penyimpanan
        $existingSequencesAfterSave = Material::where('idSubject', $idSubject)
            ->orderBy('sequence')
            ->pluck('sequence')
            ->toArray();

        // Bandingkan urutan sebelum dan setelah penyimpanan
        $missingSequences = array_diff(range(1, max($existingSequencesAfterSave)), $existingSequencesAfterSave);

        if (!empty($missingSequences)) {
            $errorMessage = 'Materi tersimpan, namun urutan ' . implode(', ', $missingSequences) . ' terlewat! Mohon untuk edit terlebih dahulu urutan materi dengan benar!';
            return redirect('/teacher/materials/' . $idSubject)->with('messageError', $errorMessage);
        } else {
            return redirect('/teacher/materials/' . $materials->idSubject);
        }
    }


    public function showMaterial($id)
    {
        $material = Material::findOrFail($id);
        $convertedContent = $this->convertOEmbedToIframe($material->content);
        $containsImageAndCaption = $this->containsImageAndCaption($convertedContent);
        $materialContent = $this->centerImages($convertedContent, $containsImageAndCaption);
        return view('teacher.material.show-detail', compact('convertedContent', 'material'));
    }
    private function convertOEmbedToIframe($content)
    {
        $convertedContent = preg_replace('/<oembed[^>]*url="https:\/\/www.youtube.com\/watch\?v=([^"]+)"[^>]*><\/oembed>/i', '<iframe class="w-full" src="https://www.youtube.com/embed/$1" width="560" height="315" frameborder="0" allowfullscreen></iframe>', $content);

        if ($this->containsImageAndCaption($convertedContent)) {
            $convertedContent = $this->centerImages($convertedContent, true);
        }

        return $convertedContent;
    }

    protected function containsImageAndCaption($content)
    {
        return preg_match('/<figure class="image">.*?<\/figure>/', $content) || preg_match('/<figure class="image image_resized">.*?<\/figure>/', $content) || preg_match('/<figcaption>.*?<\/figcaption>/', $content);
    }

    protected function centerImages($content, $containsImageAndCaption)
    {
        if ($containsImageAndCaption) {
            $content = preg_replace('/<figure class="image"><img(.*?)<\/figure>/', '<figure class="image"><div class="w-full flex flex-col items-center justify-center text-center"><img$1</div></figure>', $content);

            $content = preg_replace('/<figure class="(image image_resized)"(?: style="(.*?)")?><img(.*?)<\/figure>/', '<div class="w-full flex flex-col items-center justify-center text-center"><figure class="$1 flex flex-col items-center justify-center" style="$2"><img$3</figure></div>', $content);

            $content = preg_replace('/<figcaption>(.*?)<\/figcaption>/', '<figcaption class="text-center">$1</figcaption>', $content);

            return $content;
        }

        return $content;
    }

    public function editMaterial($id)
    {
        $materials = Material::findOrFail($id);
        $subjects = Subject::findOrFail($materials->idSubject);

        return view('teacher.material.edit', compact('materials', 'subjects'));
    }
    public function updateMaterial(Request $request, $id)
    {
        $request->validate([
            'sequence' => 'required',
            'name' => 'required',
            'content' => 'required'
        ]);

        $materials = Material::findOrFail($id);

        $newSequence = $request->sequence;

        $existingMaterials = Material::where('idSubject', $materials->idSubject)
            ->where('sequence', $newSequence)
            ->where('id', '!=', $id) // Menambahkan kondisi agar tidak memeriksa materi yang sedang diperbarui
            ->first();

        if ($existingMaterials) {
            Material::where('idSubject', $materials->idSubject)
                ->where('sequence', '>=', $newSequence)
                ->where('id', '!=', $id) // Menambahkan kondisi agar tidak memperbarui materi yang sedang diperbarui
                ->increment('sequence');
        }

        // Handle file upload logic
        $uploadedImages = session('uploaded_images_materials', []);

        // Ambil deskripsi dari formulir
        $description = $request->input('content');

        // Ambil URL gambar dari deskripsi yang ada di database
        $existingImageUrls = $this->extractImageUrlsFromContent($materials->content);

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

        $materials->sequence = $request->sequence;
        $materials->name = $request->name;
        $materials->content = $request->input('content');

        $materials->save();

        session()->forget('uploaded_images_materials');

        // Ambil urutan yang ada setelah penyimpanan
        $existingSequencesAfterSave = Material::where('idSubject', $materials->idSubject)
            ->orderBy('sequence')
            ->pluck('sequence')
            ->toArray();

        // Bandingkan urutan sebelum dan setelah penyimpanan
        $missingSequences = array_diff(range(1, max($existingSequencesAfterSave)), $existingSequencesAfterSave);

        if (!empty($missingSequences)) {
            $errorMessage = 'Materi tersimpan, namun urutan ' . implode(', ', $missingSequences) . ' terlewat! Mohon untuk edit terlebih dahulu urutan materi dengan benar!';
            return redirect('/teacher/materials/' . $materials->idSubject)->with('messageError', $errorMessage);
        } else {
            return redirect('/teacher/materials/' . $materials->idSubject);
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
        $filePath = public_path('images/media/materials/' . $fileName);

        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
    public function destroyMaterial($id)
    {
        $materials = Material::findOrFail($id);

        $this->deleteMaterialImages($materials->content);

        $materials->delete();
        $existingSequencesAfterSave = Material::where('idSubject', $materials->idSubject)
            ->orderBy('sequence')
            ->pluck('sequence')
            ->toArray();

        // Bandingkan urutan sebelum dan setelah penyimpanan
        $missingSequences = array_diff(range(1, max($existingSequencesAfterSave)), $existingSequencesAfterSave);

        if (!empty($missingSequences)) {
            $errorMessage = 'Materi terhapus, namun urutan ' . implode(', ', $missingSequences) . ' terlewat! Mohon untuk edit terlebih dahulu urutan materi dengan benar!';
            return back()->with('messageError', $errorMessage);
        } else {
            return back();
        }
    }
    private function deleteMaterialImages($content)
    {
        $existingImageUrls = $this->extractImageUrlsFromContent($content);

        foreach ($existingImageUrls as $imageUrl) {
            $this->deleteImageFromStorage($imageUrl);
        }
    }
    public function attachments($id)
    {
        $attachments = Assignment::where('idMaterial', $id)->where('category', 'fromstudent')->paginate(10);
        $iteration = $attachments->firstItem();
        $material = Material::findOrFail($id);

        return view('teacher.attachment.view', compact('attachments', 'iteration', 'material'));
    }

    public function scoreAttachment(Request $request, $id)
    {
        $request->validate([
            'score' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/'
        ], [
            'score.required' => 'Nilai harus diisi',
            'score.numeric' => 'Nilai harus berupa angka',
            'score.regex' => 'Nilai harus berupa angka atau angka desimal dengan maksimal dua digit di belakang koma'
        ]);

        $attachments = Assignment::where('id', $id)->first();

        $attachments->update([
            'score' => $request->score,
        ]);

        return redirect('/teacher/attachment/' . $attachments->idMaterial);
    }
    public function createAssigment($id)
    {
        $materials = Material::findOrFail($id);
        $idSubject = $materials->idSubject;

        return view('teacher.assignment.create', compact('materials', 'idSubject'));
    }

    public function storeAssignment(Request $request, $id)
    {
        $request->validate([
            'type' => 'required',
            'attachment' => 'required',
        ]);

        if ($request->has('attachment')) {
            $attachment = $request->attachment;

            if (filter_var($attachment, FILTER_VALIDATE_URL)) {
                $request->validate([
                    'attachment' => 'url',
                ], [
                    'attachment.url' => 'Tautan tugas harus valid/ benar',
                ]);
            } else {
                $request->validate([
                    'attachment' => 'file|mimes:pdf|max:3048',
                ]);

                $fileName = time() . '.' . $request->attachment->extension();
                $request->attachment->move(public_path('attachment/task/'), $fileName);

                $request->attachment = $fileName;
            }
        } else {
            return redirect()->back()->withErrors(['attachment' => 'Lampiran tugas wajib diisi']);
        }

        $materials = Material::findOrFail($id);

        $subjects = $materials->subject;

        $assignment = new Assignment();

        $assignment->attachment = $request->attachment;
        $assignment->score = $request->score;
        $assignment->category = 'fromteacher';
        $assignment->type = $request->type;
        $assignment->idmaterial = $materials->id;
        $assignment->idSubject = $subjects->id;
        $assignment->idUser = Auth::user()->id;

        $assignment->save();

        return redirect('/teacher/materials/' . $subjects->id);
    }
    public function editAssigment($id)
    {
        $assignment = Assignment::findOrFail($id);

        $idSubject = $assignment->idSubject;

        $material = Material::where('id', $assignment->idMaterial)->first();

        return view('teacher.assignment.edit', compact('idSubject', 'assignment', 'material'));
    }

    public function updateAssignment(Request $request, $id)
    {
        $assignment = Assignment::findOrFail($id);
        $idMaterial = $assignment->idMaterial;
        $idSubject = $assignment->idSubject;

        $request->validate([
            'type' => 'required',
            'attachment' => 'required',
        ]);

        if ($request->has('attachment')) {
            $attachment = $request->attachment;

            if (filter_var($attachment, FILTER_VALIDATE_URL)) {
                $request->validate([
                    'attachment' => 'url',
                ], [
                    'attachment.url' => 'The assignment must be a valid URL.',
                ]);

                if ($assignment->attachment && File::exists(public_path('attachment/task/' . $assignment->attachment))) {
                    File::delete(public_path('attachment/task/' . $assignment->attachment));
                }

                $assignment->attachment = $request->attachment;
            } else {
                $request->validate([
                    'attachment' => 'file|mimes:pdf|max:3048',
                ]);

                if ($request->hasFile('attachment')) {
                    if ($assignment->attachment && File::exists(public_path('attachment/task/' . $assignment->attachment))) {
                        File::delete(public_path('attachment/task/' . $assignment->attachment));
                    }

                    $fileName = time() . '.' . $request->attachment->extension();
                    $request->attachment->move(public_path('attachment/task/'), $fileName);
                    $assignment->attachment = $fileName;
                }
            }
        } else {
            return redirect()->back()->withErrors(['assignment' => 'The assignment field is required.']);
        }

        $assignment->score = $request->score;
        $assignment->category = 'fromteacher';
        $assignment->type = $request->type;
        $assignment->idMaterial = $idMaterial;
        $assignment->idSubject = $idSubject;
        $assignment->idUser = Auth::user()->id;

        $assignment->save();

        return redirect('/teacher/materials/' . $idSubject);
    }
    public function destroyAssignment($id)
    {
        $assignment = Assignment::findOrFail($id);

        File::delete(public_path('attachment/task/' . $assignment->attachment));

        $assignment->delete();

        return back();
    }
}
