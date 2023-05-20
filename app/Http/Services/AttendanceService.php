<?php

namespace App\Http\Services;

use App\Http\IService\IAttendanceService;
use App\Models\Attendance;
use App\Models\ClasseRoom;
use App\Models\Grade;
use App\Models\Student;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class AttendanceService implements IAttendanceService
{

    public function getGrade()
    {
        return Grade::with('classes')->get();
    }

    public function getClassroomStudents(string $ids)
    {
        $gradeClassClassroomIDs = explode(' ',$ids);
        return Student::where('gradeID',$gradeClassClassroomIDs[0])->
                        where('classID',$gradeClassClassroomIDs[1])->
                        where('classroomID',$gradeClassClassroomIDs[2])->get();
    
    }

    public function getStudentOfTeacher()
    {
        $teacher = Auth::guard('teacher')->user();
        $classrooms = $teacher->classrooms;

        $students = null;

        foreach($classrooms as $classroom) {

            if(!isset($students)) {
                $students = $classroom->students;
            }else {
                $students = $students->merge($classroom->students);
            }
                
        }

        return $students;
    }

    public function store($data) 
    {
     
        try{

            foreach($data->status as $studentID=>$attendanceStatus) {

                if($data->attendancID[$studentID] == -1)
                    $attendance = new Attendance();
                else
                    $attendance = Attendance::findOrFail($data->attendancID[$studentID]);

                $attendance->studentID = $studentID;
                $attendance->status = $attendanceStatus;
                $attendance->currentDate = date('Y/m/d');
    
                $attendance->save();
            }

            return true;
    

        }catch(Exception $ex) {
            throw $ex;
        }
        
    }

    public function attendanceSearch($data)
    {
        
        if($data->student_id == 0) {
            $students = $this->getStudentOfTeacher();
        }else {
            $students = Student::where('id',$data->student_id)->get();
        }

        foreach($students as $student) {
            $student->attendance = $student->attendance()->whereBetween('currentDate',[$data->from,$data->to])->
                    select(['currentDate','status'])->first();
        }

        return $students;
    }

}


?>