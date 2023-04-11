<?php

namespace App\Http\Services;

use App\Http\IService\IStudentService;
use App\Models\Image;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentService implements IStudentService
{

    public function getAll()
    {
        return Student::with(['grade'=>function($q){$q->select(['name','id']);}])
                    ->with(['religion'=>function($q){ $q->select(['name','id']);}])
                    ->with(['class'=>function($q){$q->select(['name','id']);}])
                    ->with(['classroom'=>function($q){$q->select(['name','id']);}])->get();
    }

    public function getByID($studentID)
    {
        return Student::with('images')->findorfail($studentID);
    }

    public function store($data)
    {
        try{
            DB::beginTransaction();

            $student = new Student();

            $student->name = ['en' => $data->name_en, 'ar' => $data->name_ar];
            $student->email = $data->email;
            $student->password = Hash::make($data->password);
            $student->address = $data->address;
            $student->birth_date = $data->birthDate;
            $student->gender = $data->gender;
            $student->religionID = $data->religionID;
            $student->nationalitie_ID = $data->nationalityID;
            $student->bloodID = $data->bloodID;
            $student->gradeID = $data->gradeID;
            $student->classID = $data->classID;
            $student->classroomID = $data->classroomID;
            $student->parentID = $data->parentID;
            $student->academic_year = $data->acadimy_year;

            $student->save();
           
            if(isset($data->attachments)) {
                foreach($data->attachments as $attachment) {
                    $fileName = $attachment->getClientOriginalName();
                    $attachment->storeAs('attachments/students/'.$student->getTranslation('name','en').$student->id,$fileName);

                    $image = new Image();
                    $image->fileName = $fileName;
                    $image->ownerID = $student->id;
                    $image->model = 'App\Models\Student';
                    $image->save();
                }
            }

            DB::commit();
            return $student;
            
        }catch(Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        
    }

    public function uploadAttachment(Request $request)
    {

        try{

            foreach($request->file('images') as $file) {

                $fileName = $file->getClientOriginalName();

                $file->storeAs(
                    'attachments/students/'.$request->studentName.$request->studentID,$fileName
                );
    
                $image = new Image();
    
                $image->fileName = $fileName;
                $image->imagable_type = 'App\Models\Student';
                $image->imagable_id = $request->studentID;
    
                $image->save();
            }

            return true;

        }catch(Exception $obj) {
            throw $obj;
        }

    }

    public function update($data)
    {
        
        try{

            $student = Student::findorfail($data->studentID);

            $student->name = ['en' => $data->name_en, 'ar' => $data->name_ar];
            $student->email = $data->email;
            $student->address = $data->address;
            $student->birth_date = $data->birthDate;
            $student->gender = $data->gender;
            $student->religionID = $data->religionID;
            $student->nationalitie_ID = $data->nationalityID;
            $student->bloodID = $data->bloodID;
            $student->gradeID = $data->gradeID;
            $student->classID = $data->classID;
            $student->classroomID = $data->classroomID;
            $student->parentID = $data->parentID;
            $student->academic_year = $data->acadimy_year;

            return $student->save();
            
        }catch(Exception $ex) {
            throw $ex;
        }
    }

    public function delete($id)
    {

        $student = Student::findorfail($id);
        
        try{
           
            return $student->delete();

        }catch(Exception $ex) {
            throw $ex;
        }

    }

    public function deleteAttachment(Request $request)
    {
        $image = Image::findorfail($request->id);

        try{
           
            Storage::delete('attachments/students/'.$request->studentName.$request->studentID.'/'.$image->fileName);
            return $image->delete();

        }catch(Exception $obj) {
            throw $obj;
        }
    }

}


?>