<?php

namespace App\Http\IService;
use App\Http\IService\ParentInterfaces\IService;

interface IClassroomService extends IService
{
    public function getClassroomsOfTeacher();
}


?>