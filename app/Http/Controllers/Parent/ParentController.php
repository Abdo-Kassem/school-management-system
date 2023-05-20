<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Student_fee;
use Illuminate\Support\Facades\Auth;

class ParentController extends Controller
{
    public function index()
    {
        return view('pages.parent.parent_dashboard');
    }

    public function sonFees()
    {
        $studentIDs = Student::where('parentID',Auth::guard('parent')->id())->pluck('id');
        $studentFees = Student_fee::wherein('studentID',$studentIDs)->get();
        return view('pages.parent.student_fees_show',compact('studentFees'));
    }

    

}
