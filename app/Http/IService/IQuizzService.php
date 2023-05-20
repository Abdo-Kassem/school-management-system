<?php

namespace App\Http\IService;
use App\Http\IService\ParentInterfaces\IService;

interface IQuizzService extends IService
{
   public function create();

   public function getAllOfTeacher();

   public function createByTeacher();

   public function getAllOfStudent();
}

?>