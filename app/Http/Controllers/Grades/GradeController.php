<?php 

namespace App\Http\Controllers\Grades;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Grade\GradeValidator;
use App\Models\Grade;
use Exception;

class GradeController extends Controller 
{

/**
 * Display a listing of the resource.
 *
 * @return Response
 */
public function index()
{
    $Grades = Grade::all();
    return view('pages.grades.show_grades',compact('Grades'));
}

/**
 * Show the form for creating a new resource.
 *
 * @return Response
 */
public function create()
{

}

/**
 * Store a newly created resource in storage.
 *
 * @return Response
 */
public function store(GradeValidator $request)
{
    if(Grade::where('name->en',$request->name_en)->orWhere('name->ar',$request->name_ar)->exists())
        return redirect()->back()->with('fail',__('messages.grade.exist'));
    
    try{
        if(isset($request->notes)) {
            $grade = Grade::create([
                'name' => ['ar'=>$request->name_ar,'en'=>$request->name_en],
                'notes' => $request->notes
            ]);
        }else {
            $grade = Grade::create([
                'name' => ['ar'=>$request->name_ar,'en'=>$request->name_en]
            ]);
        }
    }catch(Exception $ob){
        return redirect()->back()->with('fail',__('messages.exception_fail'));
    }
    if($grade) {
        return redirect()->back()->with('success',__('messages.success.add'));
    }
    return redirect()->back()->with('fail',__('messages.fail.add'));
}

/**
 * Display the specified resource.
 *
 * @param  int  $id
 * @return Response
 */
public function show($id)
{

}

/**
 * Show the form for editing the specified resource.
 *
 * @param  int  $id
 * @return Response
 */
public function edit($id)
{

}

/**
 * Update the specified resource in storage.
 *
 * @param  Request $request
 * @return Response
 */
public function update(GradeValidator $request)
{

    $grade = Grade::findorfail($request->id);

    $gradeExistBefor = Grade::where('id','!=',$request->id)->Where(function($q) use($request){
        $q->where('name->en',$request->name_en)->orWhere('name->ar',$request->name_ar);
    })->exists();

    if($gradeExistBefor){
        return redirect()->back()->with('fail',__('messages.grade.exist'));
    }

    try {
    
        $grade->name = ['ar'=>$request->name_ar,'en'=>$request->name_en];
        if(isset($request->notes)) {
            $grade->notes = $request->notes;
        }
        $grade->save();

    }catch(Exception $obj) {
        return redirect()->back()->with('fail',__('messages.exception_fail'));
    }
    return redirect()->back()->with('success',__('messages.success.update'));
}

/**
 * Remove the specified resource from storage.
 *
 * @param  int  $id
 * @return Response
 */
public function destroy($id)
{
    $grade = Grade::findorfail($id);
    $studyYearsCount = $grade->classes()->count();

    if($studyYearsCount>0)
        return redirect()->back()->with('warning',__('messages.grade_deletion_warning'));

    if($grade->delete()) {
        return redirect()->back()->with('success',__('messages.success.delete'));
    }
    return redirect()->back()->with('fail',__('messages.fail.delete'));  }

}

?>