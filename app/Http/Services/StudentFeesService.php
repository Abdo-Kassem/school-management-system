<?php

namespace App\Http\Services;

use App\Http\IService\IStudentFeesService;
use App\Models\Student;
use App\Models\Student_fee;
use App\Models\Study_Fee;
use Exception;

class StudentFeesService implements IStudentFeesService
{

    public function getAll()
    {
        return Student_fee::all();
    }

    public function store($data)
    {
        try{
            					
           $fee = new Student_fee();
           $fee->debit = $data->debit;
           $fee->credit = $data->credit;
           $fee->studentID = $data->studentID;
           $fee->study_feesID = $data->studyFeesID;
           $fee->created_at = date('Y/m/d');
            $fee->save();
            return true;

        }catch(Exception $ex) {
           
            throw $ex;
        }
        
    }

    public function update($data)
    {
        $studentFee = Student_fee::findorfail($data->studentFeesID);
        try{

            $studentFee->debit = $data->debit;
            $studentFee->credit = $data->credit;
            return $studentFee->save();
                  
        }catch(Exception $ex) {
            throw $ex;
        }
    }

    public function delete($id)
    {
        return Student_fee::where('id',$id)->delete();

    }
    
    public function getStudyFees($request) 
    {
        $student = Student::select(['gradeID','classID'])->findorfail($request->studentID);
        $fees = Study_Fee::where('gradeID',$student->gradeID)->where('classID',$student->classID)
                            ->where('type',$request->type)->select(['id','value'])->first();

        return $fees;
    }

}
