<?php

namespace App\Http\IService;
use App\Http\IService\ParentInterfaces\IService;

interface IStudentFeesService extends IService
{
    public function getStudyFees($data);
}


?>