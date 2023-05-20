<?php

namespace App\Http\Controllers\Student\StudentDashboard;

use App\Http\Controllers\Controller;
use App\Http\IService\IBookService;


class BookController extends Controller
{
    private $book;

    public function __construct(IBookService $book)
    {
        $this->book = $book;
    }

    public function getBooks()
    {
        $books = $this->book->getAllOfStudent();
        return view('pages\students\dashboard\books\index',compact('books'));
    }

    public function download($fileName)
    {
        return $this->book->downloadAttachment($fileName);
    }
    
}
