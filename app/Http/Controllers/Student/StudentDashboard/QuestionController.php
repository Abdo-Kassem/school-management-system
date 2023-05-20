<?php

namespace App\Http\Controllers\Student\StudentDashboard;

use App\Http\Controllers\Controller;
use App\Http\IService\IQuestionService;
use Exception;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    
    private $question;

    public function __construct(IQuestionService $question)
    {
        $this->question = $question;
    }


    public function getQuestion($quizzName,$quizzID)
    {
        $questions = $this->question->getAll($quizzID);
       
        return view('pages.students.dashboard.quizzes.questions.question_index',compact('questions','quizzName','quizzID'));

    }


}
