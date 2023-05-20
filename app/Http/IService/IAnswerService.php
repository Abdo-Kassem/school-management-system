<?php

namespace App\Http\IService;
use App\Http\IService\ParentInterfaces\IService;

interface IAnswerService
{
   public function storeQuesAnswer($request);

   public function getAll($quizzID);

   public function studentAnswer($quizzID,$studentID);
}

?>