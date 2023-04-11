<?php

namespace App\Http\IService;
use App\Http\IService\ParentInterfaces\IService;

interface IGradeService extends IService
{
    public function all();
}


?>