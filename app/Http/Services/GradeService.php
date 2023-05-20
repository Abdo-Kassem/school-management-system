<?php

namespace App\Http\Services;

use App\Http\IService\IGradeService;
use App\Models\Grade;
use Illuminate\Support\Facades\Auth;

class GradeService implements IGradeService
{
    public function getAll()
    {
        return Grade::all();
    }

    public function all()
    {
        return Grade::whereHas('classes')->get();
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