<?php

use App\Http\Controllers\Student\StudentDashboard\AnswerController;
use App\Http\Controllers\Student\StudentDashboard\BookController;
use App\Http\Controllers\Student\StudentDashboard\QuestionController;
use App\Http\Controllers\Student\StudentDashboard\QuizzController;
use App\Http\Controllers\Student\StudentDashboard\StudentController;
use Illuminate\Support\Facades\Route;

Route::prefix('student/dashboard')->middleware('auth:student')->group(function(){

    route::get('/',[StudentController::class,'index'])->name('student.home');

    route::get('/quizzes/all',[QuizzController::class,'getQuizzes'])->name('student.quizz.index');

    route::get('/quizzes/{quizzName}/{quizzID}',[QuestionController::class,'getQuestion'])->name('student.questions.index');

    route::post('/quizz_answer/{quizzName}/{quizzID}',[AnswerController::class,'storStudentQuesAnswers'])->name('student.quizz.answer');
    
    route::get('/subjects',[StudentController::class,'getSubjects'])->name('student.subject.index');
    
    route::get('/books',[BookController::class,'getBooks'])->name('student.books');

    route::get('/book/download/{fileName}',[BookController::class,'download'])->name('student.book.download');

})

?>