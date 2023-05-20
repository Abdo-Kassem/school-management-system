<?php

namespace App\Http\Controllers\Quizzes;

use App\Http\Controllers\Controller;
use App\Http\IService\IQuizzService;
use App\Http\Requests\Quizzes\QuizzValidate;
use Exception;

class QuizzController extends Controller
{
    private $quizz;

    public function __construct(IQuizzService $quizz)
    {
        $this->quizz = $quizz;
    }

    public function index()
    {
        
        $data = $this->quizz->getAll();

        return view('pages.quizzes.index',$data);
    }

    public function create()
    {
        $data = $this->quizz->create();
        return view('pages.quizzes.create',$data);
    }

    
    public function store(QuizzValidate $request)
    {
        try{

            if($this->quizz->store($request)) {
                return redirect()->back()->with('success',trans('messages.success.add'));
            }
            return redirect()->back()->with('fail',trans('messages.fail.add'));

        }catch(Exception $ex) {
            return redirect()->back()->with('fail','server hangout try again');
        }
    }

    public function update(QuizzValidate $request)
    {
        
        try{

            if($this->quizz->update($request)) {
                return redirect()->back()->with('success',trans('messages.success.update'));
            }
            return redirect()->back()->with('fail',trans('messages.fail.add'));

        }catch(Exception $ex) {
            return redirect()->back()->with('fail','server hangout try again');
        }
    }

    
    public function destroy($id)
    {
        try{

            if($this->quizz->delete($id)) {
                return redirect()->back()->with('success',trans('messages.success.delete'));
            }
            return redirect()->back()->with('fail',trans('messages.fail.delete'));

        }catch(Exception $ex) {
            return redirect()->back()->with('fail','server hangout try again');
        }
    }
}
