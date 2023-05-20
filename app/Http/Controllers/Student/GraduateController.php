<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\IService\IGraduate;
use App\Http\Services\GradeService;
use Exception;
use Illuminate\Http\Request;

class GraduateController extends Controller
{
    private $graduate;

    public function __construct(IGraduate $graduate)
    {
        $this->graduate = $graduate;
    }


    public function index()
    {
        $graduates = $this->graduate->getAll();
        $grades = (new GradeService)->all();
        return view('pages.students.graduate.graduate_show',compact('graduates','grades'));
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        try{

            if($this->graduate->store($request)) {
                return redirect()->back()->with('success',trans('messages.success.add'));
            }else {
                return redirect()->back()->with('fail',trans('messages.fail.add'));
            }

        }catch(Exception $ex) {
            return redirect()->back()->with('fail',trans('server hangout please try again'));
        }
        
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        
    }

   
    public function update(Request $request)
    {
        if($this->graduate->update($request)) {
            return redirect()->back()->with('success',trans('messages.success.delete'));
        }
        return redirect()->back()->with('fail',trans('messages.fail.delete'));
    }

}
