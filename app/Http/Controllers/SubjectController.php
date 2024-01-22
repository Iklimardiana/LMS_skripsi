<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::paginate(10);
        $iteration = $subjects->firstItem();
        $teachers = User::where('role', 'teacher')->get(['id', 'first_name', 'last_name']);
        return view('admin.subject.view', compact('subjects', 'iteration', 'teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     $subjects = Subject::all();
    //     $teachers = User::where('role', 'teacher')->get(['id', 'first_name', 'last_name']);

    //     return view('admin.subject.view', compact('subjects', 'teachers'));
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'enrollment_key',
            'thumbnail' => 'mimes:png,jpeg,jpg|max:2048',
            'idTeacher' => 'required',
        ], [
            'idteacher.required' => 'Guru Harus Dipilih',
            'name.required' => 'Kolom Nama Harus Diisi'
        ]);

        $subject = Subject::findOrFail($id);

        if ($request->input('name') !== $subject->name) {
            $subject->name = $request->input('name');
        }
        if ($request->input('enrollment_key') !== $subject->price) {
            $subject->enrollment_key = $request->input('enrollment_key');
        }
        if ($request->input('idTeacher') !== $subject->idTeacher) {
            $subject->idTeacher = $request->input('idTeacher');
        }

        if ($request->has('thumbnail')) {
            $path = "images/thumbnail/";

            if ($subject->thumbnail && $subject->thumbnail !== 'defaultThumbnail.png') {
                File::delete($path . $subject->thumbnail);
            }

            $thumbnailName = time() . '.' . $request->thumbnail->extension();

            $request->thumbnail->move(public_path('images/thumbnail/'), $thumbnailName);

            $subject->thumbnail = $thumbnailName;
        }

        $subject->save();

        return redirect('/admin/subject');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
