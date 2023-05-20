<?php

namespace App\Http\Controllers\Teacher\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\IService\IClassService;

class ClassController extends Controller
{
    public $class;

    public function __construct(IClassService $class)
    {
        $this->class = $class;
    }

    public function index()
    {
        $classes = $this->class->getClassOfTeacher();
        return view('pages.teachers.teacher_dashboard.classes_show',compact('classes'));
    }

}
