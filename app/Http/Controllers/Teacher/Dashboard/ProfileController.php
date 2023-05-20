<?php

namespace App\Http\Controllers\Teacher\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\IService\ITeacherService;
use App\Http\Requests\Teacher\ProfileTeacherValidation;
use Exception;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public $teacher ;
   
    public function __construct(ITeacherService $teacher)
    {
        $this->teacher = $teacher;
    }

    public function index()
    {
        $teacher = Auth::guard('teacher')->user();
        return view('pages.teachers.teacher_dashboard.profile',compact('teacher'));
    }

    public function update(ProfileTeacherValidation $request)
    {
        try{

            if($this->teacher->updateTeacherProfile($request))
                return redirect()->route('logout');

            return redirect()->back()->with('fail',trans('messages.fail.update'));

        }catch(Exception $ex) {
            
            return redirect()->back()->with('fail','server hangout try again');
        }
        
    }

}
