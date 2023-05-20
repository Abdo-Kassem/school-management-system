<?php

namespace App\Http\Services;

use App\Http\IService\IClassService;
use App\Models\Classe;
use Exception;
use Illuminate\Support\Facades\Auth;

class ClassService implements IClassService
{
    public function getAll()
    {
       
    }

    public function getClassOfTeacher()
    {
        $teacher = Auth::guard('teacher')->user();
        $classrooms = $teacher->classrooms()->select('classe_rooms.id','classesID')->get();
        $classes = [];

        foreach($classrooms as $classroom) {
            $class = $classroom->classe()->first();;
            $classes[$class->id] = $class; 
        }
        return $classes;
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