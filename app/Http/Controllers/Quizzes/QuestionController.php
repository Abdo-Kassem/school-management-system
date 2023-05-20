<?php

namespace App\Http\Controllers\Quizzes;

use App\Http\Controllers\Controller;
use App\Http\IService\IQuestionService;
use App\Http\Requests\Quizzes\QuestionValidate;
use Exception;

class QuestionController extends Controller
{
    private $question;

    public function __construct(IQuestionService $question)
    {
        $this->question = $question;
    }

    public function index($quizzID)
    {
        
        $questions = $this->question->getAll();

        return view('pages.quizzes.questions.question_index',compact('questions','quizzID'));
    }

    
    public function store(QuestionValidate $request)
    {
        try{

            if($this->question->store($request)) {
                return redirect()->back()->with('success',trans('messages.success.add'));
            }
            return redirect()->back()->with('fail',trans('messages.fail.add'));

        }catch(Exception $ex) {
            
            return redirect()->back()->with('fail','server hangout try again');
        }
    }

    public function update(QuestionValidate $request)
    {
        
        try{

            if($this->question->update($request)) {
                return redirect()->back()->with('success',trans('messages.success.update'));
            }
            return redirect()->back()->with('fail',trans('messages.fail.add'));

        }catch(Exception $ex) {
            return $ex;
            return redirect()->back()->with('fail','server hangout try again');
        }
    }

    
    public function destroy($id)
    {
        try{

            if($this->question->delete($id)) {
                return redirect()->back()->with('success',trans('messages.success.delete'));
            }
            return redirect()->back()->with('fail',trans('messages.fail.delete'));

        }catch(Exception $ex) {
            return redirect()->back()->with('fail','server hangout try again');
        }
    }

}
