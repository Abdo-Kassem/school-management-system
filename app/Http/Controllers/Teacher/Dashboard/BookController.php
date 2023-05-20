<?php

namespace App\Http\Controllers\Teacher\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\IService\IBookService;
use App\Http\Requests\Books\BookValidate;
use Exception;

class BookController extends Controller
{
    private $book;

    public function __construct(IBookService $book)
    {
        $this->book = $book;
    }
    
    public function index()
    {
        return view('pages.teachers.teacher_dashboard.liberary.index',$this->book->getAll());
    }

    
    public function create()
    {
        $grades = $this->book->createByTeacher();

        return view('pages.teachers.teacher_dashboard.liberary.add_book',compact('grades'));
    }

    
    public function store(BookValidate $request)
    {
        try{

            if($this->book->store($request)) {
                return redirect()->back()->with('success',trans('messages.success.add'));
            }
            return redirect()->back()->with('fail',trans('messages.fail.add'));

        }catch(Exception $ex) {
            
            return redirect()->back()->with('fail','server hangout try again');
        }
    }

    
    public function update(BookValidate $request)
    {
        try{

            if($this->book->update($request)) {
                return redirect()->back()->with('success',trans('messages.success.update'));
            }
            return redirect()->back()->with('fail',trans('messages.fail.update'));

        }catch(Exception $ex) {
            return $ex;
            return redirect()->back()->with('fail','server hangout try again');
        }
    }

   
    public function destroy($id)
    {
        try{

            if($this->book->delete($id)) {
                return redirect()->route('book.index')->with('success',trans('messages.success.delete'));
            }
            return redirect()->route('book.index')->with('fail',trans('messages.fail.delete'));

        }catch(Exception $ex) {
            return redirect()->route('book.index')->with('fail','server hangout try again');
        }
    }

    public function downloadAttachment($fileName)
    {
        return $this->book->downloadAttachment($fileName);
    }
}
