<?php

namespace App\Http\Controllers\Student\StudentDashboard;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    
    public function index()
    {
        return view('pages.students.dashboard.student_dashboard');
    }

    public function getSubjects()
    {
        $student = Student::select(['classID','id'])->find(Auth::guard('student')->id());
        $subjects = Subject::where('classID',$student->classID)->get();
        return view('pages.students.dashboard.subjects.index',compact('subjects'));

    }

    

}
