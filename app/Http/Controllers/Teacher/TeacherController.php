<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\IService\IGradeService;
use App\Http\IService\ISpecializationService;
use App\Http\IService\ITeacherService;
use App\Http\Requests\Teacher\CreateTeacherValidation as TeacherCreateTeacherValidation;
use App\Http\Requests\Teacher\UpdateTeacherValidation as TeacherUpdateTeacherValidation;
use Exception;

class TeacherController extends Controller
{
    public $teacher ;
    public $grade ;
    public $specialization;

    public function __construct(ITeacherService $teacher,IGradeService $grade,ISpecializationService $specialization)
    {
        $this->teacher = $teacher;
        $this->grade = $grade;
        $this->specialization = $specialization;
    }

    public function index()
    {
        $teachers = $this->teacher->getAll();
        $grades = $this->grade->getAll();
        $specializations = $this->specialization->getAll();
        return view('pages.teachers.teacher_show',compact('teachers','grades','specializations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeacherCreateTeacherValidation $request)
    {
        try{
            $teacher = $this->teacher->store($request);
            return redirect()->back()->with('success',trans('messages.success.add'));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeacherUpdateTeacherValidation $request)
    {
        try{
            $this->teacher->update($request);
            return redirect()->back()->with('success',trans('messages.success.update'));
        }catch(Exception $obj) {
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
            
            if($this->teacher->delete($id))
                return redirect()->back()->with('success',trans('messages.success.delete'));

            return redirect()->back()->with('fail',trans('messages.fail.delete'));

        }catch(Exception $ex) {
            return redirect()->back()->with('fail','server hangout please try again');
        }
    }
}
