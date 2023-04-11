<?php

namespace App\Http\Services;

use App\Http\IService\IClassService;
use App\Models\Classe;
use Exception;

class ClassService implements IClassService
{
    public function getAll()
    {
       
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