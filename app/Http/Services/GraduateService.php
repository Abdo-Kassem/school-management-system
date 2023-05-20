<?php

namespace App\Http\Services;

use App\Http\Controllers\Student\GraduateController;
use App\Http\IService\IGraduate;
use App\Models\Promotion;
use App\Models\Student;
use Exception;
use Illuminate\Support\Facades\DB;

class GraduateService implements IGraduate
{

    public function getAll()
    {
        return Student::onlyTrashed()->get();
    }

    public function store($data)
    {
        try{

            return Student::where('classID',$data->classID)->where('gradeID',$data->gradeID)->delete();           

        }catch(Exception $ex) {
            throw $ex;
        }
        
    }

    public function update($data)
    {
        return Student::where('id',$data->graduateID)->restore();  
    }

    public function delete($request)
    {
        
    }

}
