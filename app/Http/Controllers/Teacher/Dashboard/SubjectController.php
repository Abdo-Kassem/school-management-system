<?php

namespace App\Http\Controllers\Teacher\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\IService\ISubjectService;

class SubjectController extends Controller
{
    private $subject;

    public function __construct(ISubjectService $subject) 
    {
        $this->subject = $subject;
    }

    public function index()
    {
        $subjects = $this->subject->getAllOfTeacher();
        return view('pages.teachers.teacher_dashboard.subject',compact('subjects'));
    }
}
