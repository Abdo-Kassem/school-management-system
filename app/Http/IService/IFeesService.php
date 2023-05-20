<?php

namespace App\Http\IService;
use App\Http\IService\ParentInterfaces\IService;

interface IFeesService extends IService
{
    public function show($id);

}


?>