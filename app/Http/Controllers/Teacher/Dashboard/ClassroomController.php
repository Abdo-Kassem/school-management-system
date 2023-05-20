<?php

namespace App\Http\Controllers\Teacher\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\IService\IClassroomService;


class ClassroomController extends Controller
{
    public $classroom;

    public function __construct(IClassroomService $classroom)
    {
        $this->classroom = $classroom;
    }

    public function index()
    {
        $classrooms = $this->classroom->getClassroomsOfTeacher();
        return view('pages.teachers.teacher_dashboard.classe_room_show',compact('classrooms'));
    }

}
