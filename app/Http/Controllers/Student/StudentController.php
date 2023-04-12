<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\IService\IBloodService;
use App\Http\IService\IGradeService;
use App\Http\IService\INationalityService;
use App\Http\IService\IParentService;
use App\Http\IService\IReligionService;
use App\Http\IService\IStudentService;
use App\Http\Requests\Student\StudentValidator;
use Exception;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public $student , $religion , $blood , $nationality , $grade , $parent ,$class , $classroom;

    public function __construct(IStudentService $student,IReligionService $religion,IBloodService $blood,
                                INationalityService $nationality,IGradeService $grade,IParentService $parent)
    {
        $this->student = $student;
        $this->religion = $religion;
        $this->blood = $blood;
        $this->nationality = $nationality;
        $this->grade = $grade;
        $this->parent = $parent;
        
    }

    public function index()
    {
        $students = $this->student->getAll();
        $religions = $this->religion->getAll();
        $bloods = $this->blood->getAll();
        $nationalities = $this->nationality->getAll();
        $grades = $this->grade->all();
        $parents = $this->parent->all();
        
        return view('pages.students.students_show',
                    compact('students','religions','bloods','nationalities','grades','parents')
                );
    }

   
    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentValidator $request)
    {
        try{
            $student = $this->student->store($request);
            if($student)
                return redirect()->back()->with('success',trans('messages.success.add'));
            return redirect()->back()->with('fail',trans('messages.fail.add'));
        }catch(Exception $obj) {
            return redirect()->back()->with('fail','server hangout try again');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = $this->student->getByID($id);
        return view('pages.students.student_show',compact('student'));
        
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentValidator $request)
    {
        try{

            $this->student->update($request);
            return redirect()->back()->with('success',trans('messages.success.update'));

        }catch(Exception $obj) {
            throw $obj;
            return redirect()->back()->with('fail','server hangout try again');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{

            if($this->student->delete($id))
                return redirect()->back()->with('success',trans('messages.success.delete'));

            return redirect()->back()->with('fail',trans('messages.fail.delete'));

        }catch(Exception $ex) {
            
            return redirect()->back()->with('fail','server hangout please try again');

        }
    }

    public function deleteAttachment(Request $request)
    {
        try{

            if($this->student->deleteAttachment($request)) 
                return redirect()->back()->with('success',trans('messages.success.delete'));

            return redirect()->back()->with('fail',trans('messages.fail.delete'));

        }catch(Exception $obj) {
            throw $obj;
        }
    }

    public function downloadAttachment($studentID,$fileName)
    {
        return $this->student->downloadAttachment($studentID,$fileName);
    }

    public function uploadAttachment(Request $request)
    {
        try{
            if($this->student->uploadAttachment($request))
                return redirect()->back()->with('success',__('messages.success.add'));
            return redirect()->back()->with('fail',__('messages.fail.add'));
        }catch(Exception $obj) {
            return $obj;
        }
        
    }

}
