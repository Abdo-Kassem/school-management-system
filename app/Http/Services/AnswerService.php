<?php

namespace App\Http\Services;

use App\Http\IService\IAnswerService;
use App\Models\Question;
use App\Models\Quizze;
use App\Models\Student;
use App\Models\StudentAnswer;
use Exception;
use Illuminate\Support\Facades\Auth;

class AnswerService implements IAnswerService
{

    
    
    public function storeQuesAnswer($request,$quizzID = 0)
    {
        $answers = '';
        
        foreach($request->answer as $questionID=>$answerID) {
            $answers .= $questionID.' '.$answerID.'-';
        }

       $answers = substr_replace($answers,'',-1);

        $grades = $this->examCorrect($request->answer);
        
        try{

            return StudentAnswer::insert([
                        'studentID' => Auth::guard('student')->id(),
                        'quizzID' => $quizzID,
                        'answersIndex' => $answers,
                        'grades' => $grades
                    ]);

        }catch(Exception $ex) {
            throw $ex;
        }

    }

    public function getAll($quizzID)
    {
        $answers = StudentAnswer::where('quizzID',$quizzID)->get();
        $quizzScore = Quizze::select('grades')->find($quizzID)->grades;
        return ['answers'=>$answers,'quizzScore'=>$quizzScore];
    }

    public function studentAnswer($quizzID, $studentID)
    {
        $answers = StudentAnswer::where('studentID',$studentID)->where('quizzID',$quizzID)->first();
        $answersIndex = explode('-',$answers->answersIndex);

        $questions = Question::where('quizzID',$quizzID)->get();
        $questionsCount = $questions->count();

        foreach($answersIndex as $answerIndex) {

            for($i = 0 ; $i < $questionsCount ; $i++) {
                if($questions[$i]->id == $answerIndex[0]) {
                    $questionAnswers = explode(PHP_EOL,$questions[$i]->answers);
                    $questions[$i]->studentAnswer = $questionAnswers[(int)$answerIndex[2]];
                   
                    break;
                }
            }

        }

        return $questions;
    }

    private function examCorrect(array $data)
    {
        $grades = 0;

        foreach($data as $questionID=>$answerID) {

            $question = Question::findorfail($questionID);

            $answers = explode(PHP_EOL,$question->answers);
            $studentAnswer = $answers[$answerID];

            if($question->answer == $studentAnswer) {
                $grades += $question->score;
            }   

        }
        return $grades;
    }

}


?>