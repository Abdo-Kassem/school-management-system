<?php

namespace App\Http\Controllers\Student\Attendance;

use App\Http\Controllers\Controller;
use App\Http\IService\IAttendanceService;
use Exception;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    protected $attendance;

    public function __construct(IAttendanceService $attendance)
    {
        $this->attendance = $attendance;
    }

    public function index() 
    {
        $grades = $this->attendance->getGrade();
        return view('pages.attendance.grade_show',compact('grades'));
    }

    public function show($ids) 
    {
        $students = $this->attendance->getClassroomStudents($ids);
        return view('pages.attendance.index',compact('students'));
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
}
