<?php

namespace App\Http\Controllers\Subjects;

use App\Http\Controllers\Controller;
use App\Http\IService\ISubjectService;
use App\Http\Requests\Subjects\SubjectValidate;
use Exception;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    
    private $subject;

    public function __construct(ISubjectService $subject)
    {
        $this->subject = $subject;
    }

    public function index()
    {
        $grades = null;
        $teachers = null;
        $subjects = $this->subject->getAll($grades,$teachers);

        return view('pages.subjects.index',compact('grades','subjects','teachers'));
    }

    public function create()
    {
        $teachers = null;
        $grades = $this->subject->create($teachers);
        return view('pages.subjects.create',compact('grades','teachers'));
    }

    
    public function store(SubjectValidate $request)
    {
        try{

            if($this->subject->store($request)) {
                return redirect()->back()->with('success',trans('messages.success.add'));
            }
            return redirect()->back()->with('fail',trans('messages.fail.add'));

        }catch(Exception $ex) {
            return redirect()->back()->with('fail','server hangout try again');
        }
    }

    
    public function show($id)
    {
        //
    }

   
    public function update(SubjectValidate $request)
    {
        try{

            if($this->subject->update($request)) {
                return redirect()->back()->with('success',trans('messages.success.update'));
            }
            return redirect()->back()->with('fail',trans('messages.fail.add'));

        }catch(Exception $ex) {
            return redirect()->back()->with('fail','server hangout try again');
        }
    }

    
    public function destroy($id)
    {
        try{

            if($this->subject->delete($id)) {
                return redirect()->back()->with('success',trans('messages.success.delete'));
            }
            return redirect()->back()->with('fail',trans('messages.fail.delete'));

        }catch(Exception $ex) {
            return redirect()->back()->with('fail','server hangout try again');
        }
    }

    public function getTeacherBy(Request $request) 
    {
        return $this->subject->getTeacherBy($request);
    }
}
