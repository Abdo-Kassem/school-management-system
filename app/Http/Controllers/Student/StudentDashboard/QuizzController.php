<?php

namespace App\Http\Controllers\Student\StudentDashboard;

use App\Http\Controllers\Controller;
use App\Http\IService\IQuizzService;

class QuizzController extends Controller
{
    private $quizz;

    public function __construct(IQuizzService $quizz)
    {
        $this->quizz = $quizz;
    }

    public function getQuizzes()
    {
        $quizzes = $this->quizz->getAllOfStudent();
        return view('pages.students.dashboard.quizzes.index',compact('quizzes'));
    }

}
