<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;


class AdminController extends Controller
{
    public function dashboard()
    {
        $subjectCount = Subject::count();
        $studentCount = User::where('role', 'student')->count();
        $teacherCount = User::where('role', 'teacher')->count();
        $teachers = User::where('role', 'teacher')->limit(10)->get();
        $students = User::where('role', 'student')->limit(10)->get();
        $subjects = Subject::limit(10)->get();

        return view('admin.dashboard', compact('subjectCount', 'studentCount', 'teacherCount', 'teachers', 'students', 'subjects'));
    }
    public function teachers()
    {
        $teachers = User::where('role', 'teacher')->paginate(8);
        $iteration = $teachers->firstItem();

        return view('admin.teacher.view', compact('teachers', 'iteration'));
    }
    public function createTeachers()
    {
        return view('admin.teacher.create');
    }

    public function storeTeacher(Request $request)
    {
        $str = Str::random(100);
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'nullable',
            'gender' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required',
        ], [
            'first_name.required' => 'Kolom Nama Depan Harus Diisi',
            'email.required' => 'Kolom Email Harus Diisi',
            'email.email' => 'Isi Email dengan Benar',
            'email.unique' => 'Email sudah terdaftar, gunakan email lain',
            'password.required' => 'Kolom Kata Sandi Harus Diisi',
            'password.min' => 'Panjang Kata Sandi minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi Kata Sandi tidak cocok',
            'gender.required' => 'Kolom Jenis Kelamin Harus Diisi',
            'phone.required' => 'Kolom Nomor Telpon Harus Diisi',
        ]);

        $user = new User;

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->role = 'teacher';
        $user->key = $str;


        $user->save();

        return redirect('/admin/teacher');
    }

    public function destroyTeacher($id)
    {
        $teachers = User::findOrFail($id);

        if ($teachers->avatar != 'avatarDefault.png') {
            File::delete(public_path($teachers->avatar));
        }

        $teachers->delete();

        return redirect('/admin/teacher');
    }

    public function student()
    {
        $students = User::where('role', 'student')->paginate(10);
        $iteration = $students->firstItem();

        return view('admin.student.view', compact('students', 'iteration'));
    }

    public function destroyStudent($id)
    {
        $students = User::findOrFail($id);

        if ($students->avatar != 'avatarDefault.png') {
            File::delete(public_path($students->avatar));
        }

        $students->delete();

        return redirect('/admin/student');
    }
    public function subject()
    {
        $subjects = Subject::paginate(10);
        $iteration = $subjects->firstItem();

        return view('admin.subject.view', compact('subjects', 'iteration'));
    }
    public function createSubject()
    {
        return view('admin.subjet.create');
    }
}
