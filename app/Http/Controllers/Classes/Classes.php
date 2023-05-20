<?php

namespace App\Http\Controllers\Classes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Class\ClassesUpdateValidate;
use App\Models\Classe;
use App\Models\Grade;
use Exception;
use Illuminate\Http\Request;

class Classes extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $Grades = Grade::select(['name','id'])->get();
        $My_Classes = Classe::with('grade')->get();
        return view('pages.classes.classes_show',compact('Grades','My_Classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     *
     */
    public function store(Request $request)
    {
        $formsData = $request->List_Classes; //array of array and one array == form data

        $validationRes = $this->validat($formsData);
        if($validationRes !== -1)
            return $validationRes;

        try {

            foreach($formsData as $formData) {
                Classe::create([
                    'name' => ['en'=>$formData['name_en'],'ar'=>$formData['name_ar']],
                    'gradeID' => $formData['gradeID']
                ]);
            }
            return redirect()->back()->with('success',__('messages.success.add'));

        }
        catch(Exception $obj) {
            
            return redirect()->back()->with('fail',__('messages.fail.add'));

        }

        return redirect()->back()->with('fail',__('messages.fail.add'));
    }

    private function validat(array $forms)
    {
        $errors = [];
        foreach($forms as $form) {
            if(! isset($form['name_en'])){
                $errors[] = __('messages.name_en');
            }
            if(! isset($form['name_ar'])){
                $errors[] = __('messages.name_ar');
            }
            if( ! isset($form['gradeID']) || ! is_numeric($form['gradeID'])){
                $errors[] = __('messages.gradeID');
            }

            if(isset($form['gradeID'])){
                
                $classeExist = Classe::where(
                    function($q)use($form){
                        $q->where('name->ar',$form['name_ar'])->orWhere('name->en',$form['name_en']);
                    }
                )->where('gradeID',$form['gradeID'])->exists();
    
                if($classeExist){
                    $errors[] = __('messages.classes.exist');
                }

            }
           
            if(count($errors)>0)
                return redirect()->back()->withErrors($errors);
            
        }

        if(count($errors) === 0)
            return -1;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClassesUpdateValidate $request)
    {
        $classes = Classe::findorfail($request->id);

        $classesExistBefor = Classe::where('id','!=',$request->id)->Where(function($q) use($request){
            $q->where('name->en',$request->name_en)->orWhere('name->ar',$request->name_ar);
        })->exists();

        if($classesExistBefor)
            return redirect()->back()->with('fail',__('messages.classes.exist'));

        $classes->name = ['en'=>$request->name_en,'ar'=>$request->name_ar];
        $classes->gradeID = $request->gradeID;

        if($classes->save()) {
            return redirect()->back()->with('success',trans('messages.success.update'));
        }
        return redirect()->back()->with('fail',__('messages.fail.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classe = Classe::findorfail($id);

        if($classe->delete())
            return redirect()->back()->with('success',__('messages.success.delete'));

        return redirect()->back()->with('fail',__('messages.fail.delete'));

    }
    
    public function destroyAll(Request $request) 
    {
    
        $classes_ids = explode(',',$request->delete_all_id);

        unset($classes_ids[0]); //delete -1 fro array

        foreach($classes_ids as $id) {
            $study_year = Classe::findorfail($id);
            $study_year->delete();
        }
        return redirect()->back()->with('success',trans('messages.success.delete'));
    }

    public function filter(Request $request)
    {
        $Grades = Grade::all();
        $details = Classe::where('gradeID',$request->gradeID)->get();
        return view('pages.classes.classes_show',compact('Grades','details'));
    }

    public function getByGradeID(Request $request)
    {
        $classes = Classe::where('gradeID',$request->gradeID)->pluck('name','id');
        return $classes;
    }

}
