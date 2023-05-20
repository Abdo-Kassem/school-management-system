<?php

namespace App\Http\IService;
use Illuminate\Http\Request;

interface IAttendanceService 
{
    public function getGrade();

    public function getClassroomStudents(string $ids);

    public function getStudentOfTeacher();

    public function store($data);

    public function attendanceSearch($data);
}

?>