<?php

namespace App\Http\Controllers\Teacher\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Services\StudentService;

class StudentController extends Controller
{

    public $student ;

    public function __construct(StudentService $student)
    {
        $this->student = $student;
    }


    public function index()
    {
        $students = $this->student->getStudentsOfTeacher();
        
        return view('pages.teachers.teacher_dashboard.students.students_show',compact('students'));

    }

    public function show($id)
    {
        $student = $this->student->getByID($id);
        return view('pages.students.students.student_show',compact('student'));
        
    }
}
