<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Student;
use App\Models\Student_fee;
use App\Models\Teacher;

class AdminHomeController extends Controller
{

    public function index()
    { 
        return view('dashboards.admin_dashboard',$this->getAll());
    }


    public function getAll()
    {
        $data = [];

        $this->getCounts($data);

        $this->getData($data);

        return $data;
    }

    public function getCounts(&$data)
    {

        $data['studentCount'] = Student::count();
        $data['teacherCount'] = Teacher::count();
        $data['booksCount'] = Book::count();
        $data['studentFeesCount'] = Student_fee::count(); 

        return $data;
    }

    public function getData(&$data)
    {

        $data['books'] = Book::orderBy('added_at','DESC')->limit(5)->get();
        $data['teachers'] = Teacher::orderBy('joining_date','DESC')->limit(5)->get();
        $data['students'] = Student::orderBy('id','DESC')->limit(5)->get();
        $data['studentFees'] = Student_fee::orderBy('id','DESC')->limit(5)->get();

        return $data;
    }

}
