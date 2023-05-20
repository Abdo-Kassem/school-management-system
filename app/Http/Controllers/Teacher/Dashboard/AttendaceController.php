<?php

namespace App\Http\Controllers\Teacher\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\IService\IAttendanceService;
use Exception;
use Illuminate\Http\Request;

class AttendaceController extends Controller
{
    protected $attendance;

    public function __construct(IAttendanceService $attendance)
    {
        $this->attendance = $attendance;
    }


    public function index() 
    {
        $students = $this->attendance->getStudentOfTeacher();
        return view('pages.teachers.teacher_dashboard.attendance.index',compact('students'));
    }

    public function store(Request $request) 
    {
        try{

            if($this->attendance->store($request)) {
                return redirect()->back()->with('success',__('messages.success.update'));
            }

            return redirect()->back()->with('success',__('messages.fail.update'));

        }catch(Exception $ex) {
            return redirect()->back()->with('fail','server hangout try again');

        }
    }

    public function attendanceReport()
    {
        $students = $this->attendance->getStudentOfTeacher();
        return view('pages.teachers.teacher_dashboard.attendance.attendance_report',compact('students'));
    }

    public function attendanceSearch(Request $request) 
    {
        $students = $this->attendance->getStudentOfTeacher();//return all students of teacher
        $students_report = $this->attendance->attendanceSearch($request); //get specific students
        return view('pages.teachers.teacher_dashboard.attendance.attendance_report',compact('students','students_report'));
    }
}
