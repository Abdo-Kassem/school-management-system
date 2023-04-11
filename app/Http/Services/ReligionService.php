<?php

namespace App\Http\Services;

use App\Http\IService\IReligionService;
use App\Models\Religion;

class ReligionService implements IReligionService
{
    public function getAll()
    {
        return Religion::all();
    }

    
}


?>