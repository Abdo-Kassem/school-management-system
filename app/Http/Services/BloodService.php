<?php

namespace App\Http\Services;

use App\Http\IService\IBloodService;
use App\Models\Bloode;

class BloodService implements IBloodService
{
    public function getAll()
    {
        return Bloode::all();
    }

    
}


?>