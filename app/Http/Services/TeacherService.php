<?php

namespace App\Http\Services;

use App\Http\IService\ITeacherService;
use App\Models\Teacher;
use Exception;
use Illuminate\Support\Facades\Hash;

class TeacherService implements ITeacherService
{
    public function getAll()
    {
        return Teacher::with(['specialization'=>function($q){
            $q->select('name','id');
        }])->with(['grade'=>function($q){
            $q->select('name','id');
        }])->get();
    }

    public function store($data)
    {
        try{

            $teacher = new Teacher();
       
            $teacher->email = $data->email;
            $teacher->password = Hash::make($data->password);
            $teacher->name = ['en'=>$data->name_en,'ar'=>$data->name_ar];
            $teacher->phone = $data->phone;
            $teacher->salary = $data->salary;
            $teacher->address = $data->address;
            $teacher->gender = $data->gender;
            $teacher->specializationID = $data->specializationID;
            $teacher->gradeID = $data->gradeID;
            $teacher->joining_date = $data->joining_date;

            $teacher->save();

            return $teacher;

        }catch(Exception $ex) {
            throw $ex;
        }
        
    }

    public function update($data)
    {
        $teacher = Teacher::findorfail($data->teacherID);

        try {

            $teacher->email = $data->email;
            $teacher->name = ['en'=>$data->name_en,'ar'=>$data->name_ar];
            $teacher->phone = $data->phone;
            $teacher->salary = $data->salary;
            $teacher->address = $data->address;
            $teacher->gender = $data->gender;
            $teacher->specializationID = $data->specializationID;
            $teacher->gradeID = $data->gradeID;
            $teacher->joining_date = $data->joining_date;

            $teacher->save();

        }catch(Exception $ex) {
            throw $ex;
        }
    }

    public function delete($id)
    {
        $teacher = Teacher::findorfail($id);
        try{

            if($teacher->delete())
                return true;
            return false;

        }catch(Exception $ex) {
            return $ex;
        }

    }
}


?>