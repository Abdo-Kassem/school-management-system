<?php

namespace App\Http\Services;

use App\Http\IService\ISpecializationService;
use App\Models\Specialization;

class SpecializationService implements ISpecializationService
{
    public function getAll()
    {
        return Specialization::all();
    }

    public function store($data)
    {
        
    }

    public function update($data)
    {
        
    }

    public function delete($id)
    {
        
    }
}


?>