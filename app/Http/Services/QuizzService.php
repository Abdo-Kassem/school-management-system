<?php

namespace App\Http\Services;

use App\Http\IService\IQuizzService;
use App\Models\Grade;
use App\Models\Quizze;
use App\Models\StudentAnswer;
use App\Models\Subject;
use App\Models\Teacher;
use Exception;
use Illuminate\Support\Facades\Auth;

class QuizzService implements IQuizzService
{

    public function getAll()
    {
        $data = [];
        $data['grades'] = Grade::select(['name','id'])->get();
        //$data['teachers'] = Teacher::select(['name','id'])->get();
        $data['subjects'] = Subject::select(['name','id'])->get();
        $data['quizzes'] = Quizze::all();
        
        return $data;

    }

    public function getAllOfTeacher()
    {
        $teacher = Auth::guard('teacher')->user();
        $data = [];
        $data['grades'] = $teacher->grade()->select(['name','id'])->get();
        $data['subjects'] = $teacher->subjects()->get();
        $data['quizzes'] = $teacher->quizz;
        
        return $data;
    }

    public function getAllOfStudent()
    {
        $student = Auth::guard('student')->user();

        $classroomID = $student->classroom()->select('id')->first()->id;

        $quizzes = Quizze::where('classroomID',$classroomID)->get();

        foreach($quizzes as $quizz) {

            $studentAnswer = StudentAnswer::where('studentID',$student->id)->where('quizzID',$quizz->id)->select('grades')->first();
            
            if($studentAnswer) {
                $quizz->exist = true;
                $quizz->studentGrades = $studentAnswer->grades;
            }else {
                $quizz->exist = false;
            }

        }
        return $quizzes;
    }

    public function createByTeacher() 
    {
        $teacher = Auth::guard('teacher')->user();

        $data = [];

        $data['grades']  = $teacher->grade()->select(['name','id'])->whereHas('classes')->whereHas('classerooms')->select(['name','id'])->get();
        $data['subjects'] = $teacher->subjects()->select(['name','id'])->get();

        return $data;
    }

    public function create(&$teachers = null)
    {
        $data = [];
        $data['grades'] = Grade::whereHas('classes')->whereHas('classerooms')->select(['name','id'])->get();
        $data['teachers'] = Teacher::select(['name','id'])->get();
        $data['subjects'] = Subject::select(['name','id'])->get();

        return $data;
    }


    public function store($data)
    {
        try{
           
            $quizz = new Quizze();

            $quizz->name = ['ar'=>$data->name_ar,'en'=>$data->name_en];
            $quizz->grades = $data->grades;
            $quizz->gradeID = $data->gradeID;
            $quizz->classID = $data->classID;
            $quizz->classroomID = $data->classroomID;
            $quizz->subjectID = $data->subjectID;

            if(isset($data->teacherID))
                $quizz->teacherID = $data->teacherID;
            elseif(Auth::guard('teacher')->check())
                $quizz->teacherID = Auth::guard('teacher')->id();
            else
                throw new Exception('not teacher ');

            return $quizz->save();
               
        }catch(Exception $ex) {
           
            throw $ex;
        }
        
    }    


    public function update($data)
    {
        
        try{
           
            $quizz = Quizze::findorfail($data->id);

            $quizz->name = ['ar'=>$data->name_ar,'en'=>$data->name_en];
            $quizz->grades = $data->grades;
            $quizz->gradeID = $data->gradeID;
            $quizz->classID = $data->classID;
            $quizz->classroomID = $data->classroomID;
            $quizz->subjectID = $data->subjectID;

            if(isset($data->teacherID))
                $quizz->teacherID = $data->teacherID;
            elseif(Auth::guard('teacher')->check())
                $quizz->teacherID = Auth::guard('teacher')->id();
            else
                throw new Exception('not teacher ');

            return $quizz->save();
            
            
        }catch(Exception $ex) {
           
            throw $ex;
        }
    }


    public function delete($id)
    {

        try{

            return Quizze::findorfail($id)->delete();

        }catch(Exception $ex) {
           
            throw $ex;
        }

    }

}


?>