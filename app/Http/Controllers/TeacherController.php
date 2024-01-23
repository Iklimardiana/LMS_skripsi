<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Material;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subject;
use App\Models\Enrollment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;


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
                // Use the students() relationship to get the students enrolled in the subject
                $enrollmentStudents = $enrollment->user()->where('role', 'student')->get();

                if ($enrollmentStudents->isNotEmpty()) {
                    // Store students in an array using subject name as key
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
        $subjects = Subject::where('id', $id)->first();
        $enrollment = Enrollment::where('idSubject', $id)->paginate(10);
        $iteration = $enrollment->firstItem();
        $students = $enrollment->pluck('user')->where('role', 'student');

        return view('teacher.student.view', compact('subjects', 'iteration', 'students', 'enrollment'));
    }

    public function materials($id)
    {
        $materials = Material::where('idSubject', $id)
            ->orderBy('sequence', 'ASC')->paginate(7);
        $iteration = $materials->firstItem();
        $subject = Material::find($id);
        $assignment = Assignment::where('idSubject', $id)
            ->where('type', '0')->get();

        return view('teacher.material.view', compact('materials', 'subject', 'assignment', 'iteration'));
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
            $profile->phone = $request->input('gender');
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

        return redirect('/teacher/profile/' . $profile->id);
    }
}
