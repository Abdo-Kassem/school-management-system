<?php

namespace App\Http\Controllers\Student\StudentDashboard;

use App\Http\Controllers\Controller;
use App\Http\IService\IAnswerService;
use Exception;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    private $answer;

    public function __construct(IAnswerService $answer)
    {
        $this->answer = $answer;
    }

    public function storStudentQuesAnswers(Request $request,$quizzName,$quizzID)
    {
        try{

            if($this->answer->storeQuesAnswer($request,$quizzID)) {
                return redirect()->route('student.quizz.index')->with('success',__('messages.success.send'));
            }

            return redirect()->route('student.quizz.index')->with('fail',__('messages.fail.send'));

        }catch(Exception $ex) {
            
            return redirect()->route('student.quizz.index')->with('fail',__('server hangout'));
        }
        
    }

    public function getAll($quizzID) 
    {
        $data = $this->answer->getAll($quizzID);
        return view('pages.teachers.teacher_dashboard.quizzes.answers.students_show',$data);
    }

    public function studentAnswer($quizzID,$studentID)
    {
         $questions = $this->answer->studentAnswer($quizzID,$studentID);
        return view('pages.teachers.teacher_dashboard.quizzes.answers.student_answer',compact('questions'));
    }

    
}
