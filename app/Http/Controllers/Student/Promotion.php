<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\IService\IPromotion;
use App\Models\Grade;
use Exception;
use Illuminate\Http\Request;

class Promotion extends Controller
{

    public $promotion;

    public function __construct(IPromotion $promotion)
    {
        $this->promotion = $promotion;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promotions = $this->promotion->getAll();
        return view('pages.students.promotion.promotion_show',compact('promotions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grades = Grade::all();
        return view('pages.students.promotion.create_promotion',compact('grades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{

            if($this->promotion->store($request))
                return redirect()->back()->with('success',trans('messages.success.add'));

            return redirect()->back()->with('fail',trans('messages.fail.add'));

        }catch(Exception $ex) {
            throw $ex;
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
        $promotion = null;
        $students = $this->promotion->show($id,$promotion);
        return view('pages.students.promotion.promotion_students_show',compact('students','promotion'));
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       
        if($this->promotion->delete($request))
            return redirect()->back()->with('success',trans('messages.success.delete'));

        return redirect()->back()->with('fail',trans('messages.fail.delete'));
    }

    public function deleteAll(Request $request) 
    {
        try{

            if($this->promotion->deleteAll($request))
                return redirect()->back()->with('success',trans('messages.success.delete'));

            return redirect()->back()->with('fail',trans('messages.fail.delete'));

        }catch(Exception $ex) {
            return redirect()->back()->with('fail',trans('server hangout'));
        }
    }
}
