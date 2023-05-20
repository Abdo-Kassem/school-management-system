<?php

namespace App\Http\IService;
use App\Http\IService\ParentInterfaces\IService;
use Illuminate\Http\Request;

interface ISubjectService extends IService
{
   public function create();
   public function getTeacherBy(Request $request);
   public function getAllOfTeacher();
}

?>