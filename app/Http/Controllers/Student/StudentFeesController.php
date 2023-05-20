<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\IService\IStudentFeesService;
use App\Http\Requests\Student\StudentFeesValidator;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;

class StudentFeesController extends Controller
{
    
    private $studentFees;

    public function __construct(IStudentFeesService $studentFees)
    {
        $this->studentFees = $studentFees;
    }

    public function index()
    {
        $studentFees = $this->studentFees->getAll();
        return view('pages.studentFees.student_fees_show',compact('studentFees'));
    }

    public function create($studentID)
    {
        $student = Student::findorfail($studentID);
        return view('pages.studentFees.create_student_fees',compact('student'));
    }

    
    public function store(StudentFeesValidator $request)
    {
        try{

            if($this->studentFees->store($request)){
                return redirect()->back()->with('success',trans('messages.success.add'));
            }

            return redirect()->back()->with('fail',trans('messages.fail.add'));

        }catch(Exception $ex) {
            return redirect()->back()->with('fail','server hangout');
        }
      
    }

    
    public function update(Request $request)
    {
        try{

            if($this->studentFees->update($request))
                return redirect()->back()->with('success',trans('messages.success.update'));

            return redirect()->back()->with('fail',trans('messages.fail.update'));

        }catch(Exception $ex) {
            return redirect()->back()->with('server hangout');
        }
    }

    
    public function destroy($id)
    {
        if($this->studentFees->delete($id))
            return redirect()->back()->with('success',trans('messages.success.delete'));

        return redirect()->back()->with('fail',trans('messages.fail.delete'));
    }

    public function getStudyFees(Request $request)
    {
        return $this->studentFees->getStudyFees($request);
    }
}
