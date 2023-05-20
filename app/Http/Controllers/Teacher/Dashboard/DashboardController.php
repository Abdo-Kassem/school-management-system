<?php

namespace App\Http\Controllers\Teacher\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Quizze;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    
    public function index()
    { 
        return view('pages.teachers.teacher_dashboard.teacher_dashboard',$this->getAll());
    }


    public function getAll()
    {
        $data = [];
        $teacher = Auth::user();

        $this->getCounts($data,$teacher);

        $this->getData($data,$teacher);
        return $data;
    }

    public function getCounts(&$data,$teacher)
    {
        
        $classrooms = $teacher->classrooms()->select('classe_rooms.id')->get();
        $studentsCount = 0;

        foreach($classrooms as $classroom) {
            $studentsCount += $classroom->students()->count();
        }

        $data['studentCount'] = $studentsCount;
        $data['classroomCount'] = $teacher->classrooms()->count();
        

        return $data;
    }

    public function getData(&$data,$teacher)
    {

        $data['books'] = Book::where('teacherID',$teacher->id)->orderBy('added_at','DESC')->limit(5)->get();
        $data['quizzes'] = Quizze::where('teacherID',$teacher->id)->orderBy('created_at','DESC')->limit(5)->get();

        return $data;
    }
}
