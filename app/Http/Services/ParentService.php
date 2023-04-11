<?php

namespace App\Http\Services;

use App\Http\IService\IParentService;
use App\Models\My_Parent;
use Exception;

class ParentService implements IParentService
{
    public function getAll()
    {
       
    }

    public function all()
    {
        return My_Parent::all();
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