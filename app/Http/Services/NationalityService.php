<?php

namespace App\Http\Services;

use App\Http\IService\INationalityService;
use App\Models\Nationality;

class  NationalityService implements INationalityService
{
    public function getAll()
    {
        return Nationality::all();
    }

    
}


?>