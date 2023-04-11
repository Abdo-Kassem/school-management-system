<?php

namespace App\Http\Controllers\ClasseRooms;

use App\Http\Controllers\Controller;
use App\Http\Requests\Classroom\CreateClassroomValidator;
use App\Http\Requests\Classroom\EditClassroomValidator;
use App\Models\Classe;
use App\Models\ClasseRoom;
use App\Models\Grade;
use App\Models\Teacher;
use App\Models\Teacher_Classroom;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClasseRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = Grade::with(['classeRooms'=>function($q){
            $q->with(['classe'=>function($q){
                $q->select(['name','id']);
            }])->with(['teachers'=>function($q){
                $q->select(['name','teachers.id']);
            }])->select(['name','status','id','gradeID','classesID']);
        }])->select(['id','name'])->get();
        
        $gradesToAddClassroom = Grade::whereHas('classes')->get();
        $classes = Classe::all();
        $teachers = Teacher::select(['name','id'])->get();

        return view('pages.classrooms.classe_room_show',compact('grades','gradesToAddClassroom','teachers','classes'));
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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateClassroomValidator $request)
    {

        try {

            foreach($request->list_classrooms as $classroom) {
              
                $currentClassroom = new ClasseRoom();
        
                DB::beginTransaction();

                $currentClassroom->name = ['ar'=>$classroom['name_ar'],'en'=>$classroom['name_en']];
                $currentClassroom->gradeID = $classroom['gradeID'];
                $currentClassroom->classesID = $classroom['classesID'];

                if(!isset($request->status)) {
                    $currentClassroom->status = 0;
                }

                $currentClassroom->save();
                
                foreach($classroom['teacherID'] as $id) {
                    Teacher_Classroom::insert([
                        'teacherID' => $id,
                        'classroomID' => $currentClassroom['id']
                    ]);
                }

                DB::commit();
                return redirect()->back()->with('success',__('messages.success.add'));

            }

            return redirect()->back()->with('fail',__('messages.fail.add'));

        }catch(Exception $obj) {
            throw $obj;
            return redirect()->back()->with('fail',__('messages.exception_fail'));
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
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditClassroomValidator $request)
    {

        $classroom = ClasseRoom::findorfail($request->id);

        $classroom->name = ['ar'=>$request->name_ar,'en'=>$request->name_en];

        $classroom->gradeID = $request->gradeID;

        $classroom->classesID = $request->classID;

        if(!isset($request->status))
            $classroom->status = 0;
        else
            $classroom->status = 1;

        try{

            DB::beginTransaction();

            $classroom->save();

            foreach($request->teacherID as $id) {
                Teacher_Classroom::insert([
                    'teacherID' => $id,
                    'classroomID' => $classroom['id']
                ]);
            }

            DB::commit();

            return redirect()->back()->with('success',__('messages.success.update'));

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
        $classroom = ClasseRoom::findorfail($id);

        if($classroom->delete())
            return redirect()->back()->with('success',__('messages.success.delete'));

        return redirect()->back()->with('fail',__('messages.fail.delete'));
    }

    public function getBygradeID(Request $request)
    {
        $classrooms = ClasseRoom::where('gradeID',$request->gradeID)->pluck('name','id');
        return $classrooms;
    }
}
