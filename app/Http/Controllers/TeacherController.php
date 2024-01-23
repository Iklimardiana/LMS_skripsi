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
}
