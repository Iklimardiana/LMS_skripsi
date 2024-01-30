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
        $enrollment = Enrollment::where('idUser', $id)->get();
        $enrolledSubjectIds = Enrollment::where('idUser', $id)->pluck('idSubject')->toArray();
        $subjects = Subject::whereNotIn('id', $enrolledSubjectIds)->get();
        $progres = Progres::where('idUser', $id)->get();

        return view("student.subject.view", compact('subjects', 'enrollment', 'progres'));
    }

    public function profile($id)
    {
        $profile = User::findOrFail($id);

        return view('profile.view', compact('profile'));
    }
    public function editProfile($id)
    {
        $profile = User::findOrFail($id);

        return view('profile.edit', compact('profile'));
    }

    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'avatar' => 'image|mimes:jpeg,png,jpg|max:2048',
            'phone' => 'required',
            'entry_year' => 'required',
            'gender' => 'required'
        ]);

        $profile = User::findOrFail($id);

        if ($request->input('first_name') !== $profile->first_name) {
            $profile->first_name = $request->input('first_name');
        } elseif ($request->input('last_name') !== $profile->last_name) {
            $profile->last_name = $request->input('last_name');
        } elseif ($request->input('email') !== $profile->email) {
            $profile->email = $request->input('email');
        } elseif ($request->input('phone') !== $profile->phone) {
            $profile->phone = $request->input('phone');
        } elseif ($request->input('gender') !== $profile->gender) {
            $profile->gender = $request->input('gender');
        } elseif ($request->input('entry_year') !== $profile->entry_year) {
            $profile->entry_year = $request->input('entry_year');
        } elseif ($request->has('avatar')) {
            $path = "images/avatar/";

            if ($profile->avatar && $profile->avatar !== 'avatarDefault.png') {
                File::delete($path . $profile->avatar);
            }

            $avatarName = time() . '.' . $request->avatar->extension();

            $request->avatar->move(public_path('images/avatar/'), $avatarName);

            $profile->avatar = $avatarName;
        }

        $profile->save();

        return redirect('/student/profile/' . $profile->id);
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
        } else {
            return redirect('/student/subject')->with('error', 'Belum ada modul. Mohon untuk menunggu, Anda dapat mengakses mata pelajaran lain terlebih dahulu');
        }

        $submission = Assignment::where('idUser', $user)
            ->where('category', 'fromstudent')
            ->get();

        $currentSequence = $material ? $material->sequence : null;

        $currentProgres = Progres::where('idUser', $user)->where('idSubject', $id)->first();


        if ($currentProgres) {
            if ($currentProgres->sequence < $currentSequence)
                $currentProgres->sequence = $currentSequence;

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
                    ->where('idMaterial', $material->id)->first();
                if ($currentSubmission && $currentSubmission->idMaterial == $currentAttachment->idMaterial) {
                    $currentProgres->status = '1';
                    $currentProgres->save();
                } else {
                    $currentProgres->status = '0';
                    $currentProgres->save();
                }
            }

            if ($currentProgres->sequence == $subject->Material->count()) {
                $currentProgres->complete = '1';
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

        return view('student.material.view')->with(compact('currentProgres', 'material', 'subject', 'currentSequence', 'attachment', 'submission'));
    }
    public function createSubmission($id)
    {
        $material = Material::findOrFail($id);
        $idSubject = $material->idSubject;

        return view('student.submission.create', compact('material', 'idSubject'));
    }
}
