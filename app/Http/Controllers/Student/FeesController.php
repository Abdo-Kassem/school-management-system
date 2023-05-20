<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\IService\IFeesService;
use App\Http\Requests\Student\StudyFeesValidator;
use App\Http\Services\GradeService;
use Exception;
use Illuminate\Http\Request;

class FeesController extends Controller
{
    
    private $fees;

    public function __construct(IFeesService $fees)
    {
        $this->fees = $fees;
    }

    public function index()
    {
        $fees = $this->fees->getAll();
        return view('pages.fees.fees_show',compact('fees'));
    }

    public function create()
    {
        $grades = (new GradeService)->all();
        return view('pages.fees.create_study_fees',compact('grades'));
    }

    
    public function store(StudyFeesValidator $request)
    {
        try{

            if($this->fees->store($request)){
                return redirect()->back()->with('success',trans('messages.success.add'));
            }

            return redirect()->back()->with('fail',trans('messages.fail.add'));

        }catch(Exception $ex) {
            return redirect()->back()->with('fail','server hngout');
        }
      
    }

    
    public function show($id)
    {
        //
    }

    
    public function update(Request $request)
    {
        try{

            if($this->fees->update($request))
                return redirect()->back()->with('success',trans('messages.success.update'));

            return redirect()->back()->with('fail',trans('messages.fail.update'));

        }catch(Exception $ex) {
            return redirect()->back()->with('server hangout');
        }
    }

    
    public function destroy($id)
    {
        if($this->fees->delete($id))
            return redirect()->back()->with('success',trans('messages.success.delete'));

        return redirect()->back()->with('fail',trans('messages.fail.delete'));
    }
}
