<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Enrollment;
use App\Models\Material;
use App\Models\Progres;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function subjects()
    {
        $id = Auth::user()->id;
        $enrollmentQuery = Enrollment::where('idUser', $id);
        $enrolledSubjectIds = Enrollment::where('idUser', $id)->pluck('idSubject')->toArray();
        $unenrolledSubjectsQuery = Subject::whereNotIn('id', $enrolledSubjectIds);

        if (request('enrolled_keyword')) {
            $enrollmentQuery->whereHas('subject', function ($query) {
                $keyword = request('enrolled_keyword');
                $query->where(function ($subquery) use ($keyword) {
                    $subquery->where('name', 'LIKE', '%' . $keyword . '%');
                });
            });
        } elseif (request('unenrolled_keyword')) {
            $unenrolledSubjectsQuery->where('name', 'LIKE', '%' . request('unenrolled_keyword') . '%');
        }

        $subjects = $unenrolledSubjectsQuery->get();
        $enrollment = $enrollmentQuery->get();
        $progres = Progres::where('idUser', $id)->get();

        return view("student.subject.view", compact('subjects', 'enrollment', 'progres'));
    }

    public function enrollSubject(Request $request)
    {
        $user = Auth::user();

        $enrollmentkeyStudent = $request->input('enrollment_key');

        $subject = Subject::where('enrollment_key', $enrollmentkeyStudent)->first();

        if (!$subject) {
            return redirect()->back()->with('error', 'Kunci pendaftaran tidak valid.');
        }

        $isEnrolled = Enrollment::where('idUser', $user->id)
            ->where('idSubject', $subject->id)
            ->exists();

        if ($isEnrolled) {
            return redirect()->back()->with('error', 'Anda sudah terdaftar pada mata pelajaran ini.');
        }
        if ($enrollmentkeyStudent !== $subject->enrollment_key) {
            return redirect()->back()->with('error', 'Enrollment Key tidak sesuai.');
        }
        Enrollment::create([
            'idUser' => $user->id,
            'idSubject' => $subject->id,
        ]);

        return redirect()->back()->with('success', 'Anda berhasil terdaftar pada mata pelajaran ini.');
    }

    public function materials(Request $request, $id)
    {
        $user = Auth::user()->id;
        $sequence = $request->input('sequence', 1);
        $subject = Subject::findOrFail($id);

        $material = $subject->Material()->where('sequence', $sequence)->first();
        if ($material) {
            $attachment = Assignment::where('idMaterial', $material->id)
                ->where('category', 'fromteacher')
                ->get();

            // Konversi tag OEmbed ke tag iframe
            $convertedContent = $this->convertOEmbedToIframe($material->content);
            $containsImageAndCaption = $this->containsImageAndCaption($convertedContent);
            $materialContent = $this->centerImages($convertedContent, $containsImageAndCaption);
        } else {
            return redirect('/student/subject')->with('error', 'Belum ada modul. Mohon untuk menunggu, Anda dapat mengakses mata pelajaran lain terlebih dahulu');
        }
        $submission = Assignment::where('idUser', $user)
            ->where('category', 'fromstudent')
            ->get();

        $newAssignments = Assignment::where('idMaterial', $material->id)
            ->where('category', 'fromteacher')
            ->get();

        $hasNewAssignments = count($newAssignments) > 0;

        $currentSequence = $material ? $material->sequence : null;
        $currentProgres = Progres::where('idUser', $user)->where('idSubject', $id)->first();
        if ($currentProgres) {
            if ($currentProgres->sequence < $currentSequence) {
                $currentProgres->sequence = $currentSequence;
            }
            $progres = Progres::where('idUser', $user)
                ->where('idSubject', $id)->first();
            $currentAttachment = Assignment::where('idMaterial', $material->id)
                ->where('idSubject', $id)
                ->where('category', 'fromteacher')
                ->first();
            if ($currentAttachment == null) {
                $progres->status = '1';
                $progres->save();
            } else {
                $currentSubmission = Assignment::where('idUser', $user)
                    ->where('idSubject', $id)
                    ->where('category', 'fromstudent')
                    ->where('idMaterial', $material->id)->first();
                if ($currentSubmission && $currentSubmission->idMaterial == $currentAttachment->idMaterial) {
                    $currentProgres->status = '1';
                    $currentProgres->save();
                } else {
                    $currentProgres->status = $hasNewAssignments ? '0' : '1';
                    $currentProgres->save();
                }
            }
            if ($currentProgres->sequence > $subject->Material->count()) {
                $currentProgres->sequence = $subject->Material->count();
                if ($currentProgres->status == '1') {
                    $currentProgres->complete = '1';
                    $currentProgres->save();
                } else {
                    $currentProgres->complete = '0';
                    $currentProgres->save();
                }
            } elseif ($currentProgres->sequence == $subject->Material->count() && $currentProgres->status == '1') {
                $currentProgres->complete = '1';
                $currentProgres->save();
            } else {
                $currentProgres->complete = '0';
                $currentProgres->save();
            }
            $currentProgres->save();
        } else {
            $currentAttachment = Assignment::where('idMaterial', $material->id)
                ->where('idSubject', $id)
                ->where('category', 'fromteacher')
                ->first();
            $currentProgres = new Progres;
            $currentProgres->idUSer = $user;
            $currentProgres->idSubject = $id;
            $currentProgres->sequence = 1;
            if ($currentAttachment == null) {
                $currentProgres->status = '1';
                $currentProgres->save();
            } else {
                $currentSubmission = Assignment::where('idUser', $user)
                    ->where('idSubject', $id)
                    ->where('idMaterial', $material->id)->first();
                if ($currentSubmission && $currentSubmission->idMaterial == $currentAttachment->idMaterial) {
                    $currentProgres->status = '1';
                    $currentProgres->save();
                } else {
                    $currentProgres->status = '0';
                    $currentProgres->save();
                }
            }
            $currentProgres->save();
        }
        return view('student.material.view')->with(compact('currentProgres', 'convertedContent', 'material', 'subject', 'currentSequence', 'attachment', 'submission', 'containsImageAndCaption', 'materialContent'));
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
    public function createSubmission($id)
    {
        $material = Material::findOrFail($id);
        $idSubject = $material->idSubject;

        return view('student.submission.create', compact('material', 'idSubject'));
    }
    public function storeSubmission(Request $request, $id)
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
                $request->attachment->move(public_path('attachment/submission/'), $fileName);

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
        $assignment->category = 'fromstudent';
        $assignment->type = $request->type;
        $assignment->idmaterial = $materials->id;
        $assignment->idSubject = $subjects->id;
        $assignment->idUser = Auth::user()->id;

        $request->session()->flash('toast', [
            'type' => 'success',
            'message' => 'Tugas berhasil disimpan'
        ]);

        $assignment->save();

        return redirect('/student/materials/' . $subjects->id . '?sequence=' . $materials->sequence);
    }
    public function destroySubmission($id)
    {
        $submission = Assignment::findOrFail($id);

        $material = $submission->material;
        File::delete(public_path('attachment/submission/' . $submission->attachment));
        $submission->delete();

        $this->updateProgres($material);

        return redirect()->back();
    }
    protected function updateProgres($material)
    {
        $user = Auth::user()->id;
        $subject = $material->subject;

        $currentProgres = Progres::where('idUser', $user)->where('idSubject', $subject->id)->first();

        if ($currentProgres) {
            $currentProgres->complete = '0';
            $currentProgres->sequence = $material->sequence;

            $currentProgres->save();
        }
    }
    public function editSubmission($id)
    {
        $submission = Assignment::findOrFail($id);

        $idSubject = $submission->idSubject;

        $material = Material::where('id', $submission->idMaterial)->first();

        return view('student.submission.edit', compact('idSubject', 'submission', 'material'));
    }

    public function updateSubmission(Request $request, $id)
    {
        $submission = Assignment::findOrFail($id);
        $idMaterial = $submission->idMaterial;
        $idSubject = $submission->idSubject;

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
                    'attachment.url' => 'The submission must be a valid URL.',
                ]);

                if ($submission->attachment && File::exists(public_path('attachment/submission/' . $submission->attachment))) {
                    File::delete(public_path('attachment/submission/' . $submission->attachment));
                }

                $submission->attachment = $request->attachment;
            } else {
                $request->validate([
                    'attachment' => 'file|mimes:pdf|max:3048',
                ]);

                if ($request->hasFile('attachment')) {
                    if ($submission->attachment && File::exists(public_path('attachment/submission/' . $submission->attachment))) {
                        File::delete(public_path('attachment/submission/' . $submission->attachment));
                    }

                    $fileName = time() . '.' . $request->attachment->extension();
                    $request->attachment->move(public_path('attachment/submission/'), $fileName);
                    $submission->attachment = $fileName;
                }
            }
        } else {
            return redirect()->back()->withErrors(['submission' => 'The submission field is required.']);
        }

        $submission->score = $request->score;
        $submission->category = 'fromstudent';
        $submission->type = $request->type;
        $submission->idMaterial = $idMaterial;
        $submission->idSubject = $idSubject;
        $submission->idUser = Auth::user()->id;

        $request->session()->flash('toast', [
            'type' => 'success',
            'message' => 'Tugas berhasil diperbarui!'
        ]);
        $submission->save();

        return redirect('/student/materials/' . $idSubject . '?sequence=' . $submission->material->sequence);
    }
}
