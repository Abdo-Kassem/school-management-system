<?php

namespace App\Http\Services;

use App\Http\IService\IClassroomService;
use App\Models\ClasseRoom;
use Exception;
use Illuminate\Support\Facades\Auth;

class ClassroomService implements IClassroomService
{
    public function getAll()
    {
       
    }

    public function getClassroomsOfTeacher()
    {
        return Auth::guard('teacher')->user()->classrooms;
    }

    public function store($data)
    {
        try{


        }catch(Exception $ex) {
            throw $ex;
        }
        
    }

    public function update($data)
    {
       
        try {


        }catch(Exception $ex) {
            throw $ex;
        }
    }

    public function delete($id)
    {
        
        try{

        }catch(Exception $ex) {
            return $ex;
        }

    }
}


?>