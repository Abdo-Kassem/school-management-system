<?php

namespace App\Http\Services;

use App\Http\IService\ISubjectService;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectService implements ISubjectService
{

    public function getAll(&$grades = null,&$teachers = null)
    {
        $grades = Grade::all();
        $teachers = Teacher::all();
        return Subject::all();

    }

    public function getAllOfTeacher()
    {
        $teacher = Auth::guard('teacher')->user();
        return $teacher->subjects;
    }

    public function create(&$teachers = null)
    {
        $teachers = Teacher::all();
        return Grade::all();
    }


    public function store($data)
    {
        try{
            
            $subject = new Subject();

            $subject->name = ['ar'=>$data->name_ar,'en'=>$data->name_en];
            $subject->gradeID = $data->gradeID;
            $subject->classID = $data->classID;
            $subject->teacherID = $data->teacherID;

            return $subject->save();
            
        }catch(Exception $ex) {
           
            throw $ex;
        }
        
    }    


    public function update($data)
    {
        
        try{
            
            $subject = Subject::findorfail($data->id);

            $subject->name = ['ar'=>$data->name_ar,'en'=>$data->name_en];
            $subject->gradeID = $data->gradeID;
            $subject->classID = $data->classID;
            $subject->teacherID = $data->teacherID;

            return $subject->save();
            
        }catch(Exception $ex) {
           
            throw $ex;
        }
    }


    public function delete($id)
    {

        $subject = Subject::findorfail($id);
        try{

            return $subject->delete();

        }catch(Exception $ex) {
           
            throw $ex;
        }

    }

    
    /*get teachers of specifc subjectID */
    public function getTeacherBy(Request $request)
    {
        $subject = Subject::findorfail($request->subjectID);

        return $subject->teacher()->pluck('name','id');
    }

}


?>