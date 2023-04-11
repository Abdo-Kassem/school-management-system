<?php

namespace App\Http\IService;
use App\Http\IService\ParentInterfaces\IService;

interface IParentService extends IService
{
    public function all();
}


?>