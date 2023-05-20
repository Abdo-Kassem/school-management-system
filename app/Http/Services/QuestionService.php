<?php

namespace App\Http\Services;

use App\Http\IService\IQuestionService;
use App\Models\Question;
use App\Models\StudentAnswer;
use Exception;
use Illuminate\Support\Facades\Auth;

class QuestionService implements IQuestionService
{

    public function getAll($quizzID = 0)
    {
        if($quizzID == 0)
            return Question::all();
            
        return Question::where('quizzID',$quizzID)->get();
        
    }

    public function store($data)
    {
        try{
           
            $question = new Question();

            $question->title = $data->title;
            $question->answers = $data->answers;
            $question->answer = $data->answer;
            $question->score = $data->score;
            $question->quizzID = $data->quizzID;
          
            return $question->save();
            
            
        }catch(Exception $ex) {
           
            throw $ex;
        }
        
    }   

    public function update($data)
    {
        
        try{
           
            $question = Question::findorfail($data->questionID);

            $question->title = $data->title;
            $question->answers = $data->answers;
            $question->answer = $data->answer;
            $question->score = $data->score;
          
            return $question->save();
            
            
        }catch(Exception $ex) {
           
            throw $ex;
        }
    }


    public function delete($id)
    {

        try{

            return Question::findorfail($id)->delete();

        }catch(Exception $ex) {
           
            throw $ex;
        }

    }

}


?>