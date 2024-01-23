<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Support\Facades\File;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::paginate(10);
        $iteration = $subjects->firstItem();
        $teachers = User::where('role', 'teacher')->get(['id', 'first_name', 'last_name']);
        return view('admin.subject.view', compact('subjects', 'iteration', 'teachers'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'idTeacher' => 'required',
        ], [
            'name.required' => 'Kolom Nama Mata Pelajaran Harus Diisi',
            'idTeacher.required' => 'Guru Mata Pelajaran Harus Dipilih'
        ]);

        $subject = new Subject;

        $subject->name = $request->name;
        $subject->idTeacher = $request->idTeacher;

        $subject->save();
        return redirect('/admin/subject');
    }

    public function update(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'enrollment_key' => 'confirmed',
            'thumbnail' => 'mimes:png,jpeg,jpg|max:2048',
            'idTeacher' => 'required',
        ], [
            'idteacher.required' => 'Guru Harus Dipilih',
            'name.required' => 'Kolom Nama Harus Diisi'
        ]);

        if ($request->input('name') !== $subject->name) {
            $subject->name = $request->input('name');
        }
        if ($request->input('enrollment_key') !== $subject->enrollment_key) {
            $subject->enrollment_key = $request->input('enrollment_key');
        }
        if ($request->input('idTeacher') !== $subject->idTeacher) {
            $subject->idTeacher = $request->input('idTeacher');
        }

        if ($request->has('thumbnail')) {
            $path = "images/thumbnail/";

            if ($subject->thumbnail && $subject->thumbnail !== 'thumbnailDefault.jpg') {
                File::delete($path . $subject->thumbnail);
            }

            $thumbnailName = time() . '.' . $request->thumbnail->extension();

            $request->thumbnail->move(public_path('images/thumbnail/'), $thumbnailName);

            $subject->thumbnail = $thumbnailName;
        }

        $subject->save();

        return redirect('/admin/subject');
    }
    public function destroy($id)
    {
        $subject = Subject::findorFail($id);

        if ($subject->thumbnaail != 'thumbnailDefault.jpg') {
            File::delete(public_path($subject->thumbnail));
        }

        $subject->delete();

        return redirect('/admin/subject');
    }
}
