<?php

namespace App\Http\Services;

use App\Http\IService\IFeesService;
use App\Models\Promotion;
use App\Models\Student;
use App\Models\Study_Fee;
use Exception;
use Illuminate\Support\Facades\DB;

class FeesService implements IFeesService
{

    public function getAll()
    {
        return Study_Fee::all();
    }

    public function store($data)
    {
        try{

           $fee = new Study_Fee();
           $fee->name = ['ar'=>$data->name_ar,'en'=>$data->name_en];
           $fee->type = $data->type;
           $fee->value = $data->cost;
           $fee->notes = $data->notes;
           $fee->acadimic_year = $data->acadimic_year;
           $fee->gradeID = $data->gradeID;
           $fee->classID = $data->classID;
            $fee->save();
            return true;

        }catch(Exception $ex) {
           
            throw $ex;
        }
        
    }

    public function update($data)
    {
        try{

            Study_Fee::where('id',$data->feesID)->update([
                        'name'=>['ar'=>$data->name_ar,'en'=>$data->name_en],
                        'type' => $data->type,
                        'value' => $data->cost,
                        'notes' => $data->notes,
                        'acadimic_year' => $data->acadimic_year
                    ]);
            return true;

        }catch(Exception $ex) {
            throw $ex;
        }
    }

    public function delete($id)
    {
        return Study_Fee::where('id',$id)->delete();

    }

    public function show($id)
    {
        
    }  
}
