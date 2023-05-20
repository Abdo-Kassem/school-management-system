<?php

namespace App\Http\IService;
use App\Http\IService\ParentInterfaces\IService;

interface IClassService extends IService
{
   public function getClassOfTeacher();
}


?>