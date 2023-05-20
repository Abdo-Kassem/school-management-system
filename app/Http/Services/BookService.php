<?php

namespace App\Http\Services;

use App\Http\IService\IBookService;
use App\Models\Book;
use App\Models\Classe;
use App\Models\Grade;
use App\Models\Teacher;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookService implements IBookService
{

    public function getAll()
    {
        return ['books'=>Book::all(),'grades'=>Grade::whereHas('classes')->get()];
    }

    public function getAllOfTeacher()
    {
        $teacher = Auth::guard('teacher')->user();

        $books = Book::where('teacherID',$teacher->id)->get();
        $grades = $teacher->grade()->whereHas('classes')->get();

        return ['books'=>$books,'grades'=>$grades];
    }

    public function getAllOfStudent()
    {
        $student = Auth::guard('student')->user();

        return Book::where('classID',$student->classID)->get();
    }

    public function create()
    {
        $data = [];

        $data['grades'] = Grade::whereHas('classes')->get();
        $data['classes'] = Classe::all();
        $data['teachers'] = Teacher::all();

        return $data;
    }

    public function createByTeacher()
    {
        $teacher = Auth::guard('teacher')->user();

        return $grades = $teacher->grade()->whereHas('classes')->select(['id','name','notes'])->get();

    }

    public function store($data)
    {
        try{

            $fileName = time().$data->file_name->getClientOriginalName();

            $data->file_name->storeAs('attachments/books/',$fileName);

            return Book::create([
                'title' => ['ar'=>$data->title_ar,'en'=>$data->title_en],
                'file_name' => $fileName,
                'gradeID' => $data->gradeID,
                'classID' => $data->classID,
                'teacherID' => Auth::guard('teacher')->id()
            ]);
            
        }catch(Exception $ex) {
            throw $ex;
        }
        
    }    

    public function update($data)
    {
        
        try{

            Book::where('id',$data->id)->update([
                'title' => ['ar'=>$data->title_ar,'en'=>$data->title_en],
                'gradeID' => $data->gradeID,
                'classID' => $data->classID,
                'teacherID' => Auth::guard('teacher')->id()
            ]);
            return true;
            
        }catch(Exception $ex) {
            throw $ex;
        }
    }

    public function delete($id)
    {

        try{

           $book = Book::select('file_name','id')->findorfail($id);

           $filePath = Storage::path('attachments/books/'.$book->file_name);

           if(is_file($filePath)) {

                unlink($filePath);

                $book->delete();

                return true;
           }

           return false;

        }catch(Exception $ex) {
           
            throw $ex;
        }

    }

    

    public function downloadAttachment($fileName)
    {
        
        return response()->download(Storage::path('attachments/books/'.$fileName));
    
    }

}


?>