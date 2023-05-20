<?php

use App\Http\Controllers\ClasseRooms\ClasseRoomController;
use App\Http\Controllers\Classes\Classes;
use App\Http\Controllers\Student\StudentDashboard\AnswerController;
use App\Http\Controllers\Subjects\SubjectController;
use App\Http\Controllers\Teacher\Dashboard\AttendaceController;
use App\Http\Controllers\Teacher\Dashboard\BookController;
use App\Http\Controllers\Teacher\Dashboard\ClassController;
use App\Http\Controllers\Teacher\Dashboard\ClassroomController;
use App\Http\Controllers\Teacher\Dashboard\DashboardController;
use App\Http\Controllers\Teacher\Dashboard\ProfileController;
use App\Http\Controllers\Teacher\Dashboard\QuestionController;
use App\Http\Controllers\Teacher\Dashboard\QuizzController;
use App\Http\Controllers\Teacher\Dashboard\StudentController;
use App\Http\Controllers\Teacher\Dashboard\SubjectController as DashboardSubjectController;
use Illuminate\Support\Facades\Route;

Route::prefix('teacher')->middleware('auth:teacher')->group(function(){

    Route::prefix('dashboard')->group(function () {

        route::get('/',[DashboardController::class,'index'])->name('teacher.home');
        //==============================students============================
        Route::get('student',[StudentController::class,'index'])->name('teacher.student.index');
        route::get('/student/show/{id}',[StudentController::class,'show'])->name('teacher.student.show');
    
        route::get('class',[ClassController::class,'index'])->name('teacher.class');
    
        route::get('/classrooms',[ClassroomController::class,'index'])->name('classeroom');
       
        Route::get('attendance',[AttendaceController::class,'index'])->name('teacher_student_attendance');
        Route::post('attendance/store',[AttendaceController::class,'store'])->name('teacher_attendance.store');
    
        Route::get('attendance_report',[AttendaceController::class,'attendanceReport'])->name('teacher_attendance_report');
        Route::post('attendance_report',[AttendaceController::class,'attendanceSearch'])->name('attendance.search');
    
        Route::get('student/marks',[AttendaceController::class,'attendanceReport'])->name('teacher_marks_report');
    
        route::prefix('quizz')->group(function() {
    
            route::controller(QuizzController::class)->group(function(){
    
                route::get('/all','index')->name('teacher.quizz.index');
                route::get('/create','create')->name('teacher.quizz.create');
                route::post('/store','store')->name('teacher.quizz.store');
    
                route::post('/update','update')->name('teacher.quizz.update');
    
                route::delete('/destroy/{id}','destroy')->name('teacher.quizz.destroy');
    
            });
    
            route::controller(QuestionController::class)->prefix('questions')->group(function(){
    
                route::get('/{quizzID}','index')->name('teacher.questions.index');
                
                route::post('/store','store')->name('teacher.questions.store');
    
                route::post('/update','update')->name('teacher.questions.update');
    
                route::delete('/destroy/{id}','destroy')->name('teacher.questions.destroy');
            });
    
            route::get('classes/get',[Classes::class,'getByGradeID'])->name('classes.get');
            route::get('classrooms/get',[ClasseRoomController::class,'getBygradeID'])->name('classroom.get');
            route::get('teacher/get',[SubjectController::class,'getTeacherBy'])->name('teacher.get');
    
            route::get('answers/{quizzID}',[AnswerController::class,'getAll'])->name('quizz.answer');
    
            route::get('answers/student_answer/{quizzID}/{studentID}',[AnswerController::class,'studentAnswer'])->name('quizz.student.answer');
    
        });
    
        Route::get('profile', [ProfileController::class,'index'])->name('teacher_profile.show');
        Route::post('profile', [ProfileController::class,'update'])->name('teacher_profile.update');
    
        route::controller(BookController::class)->prefix('book')->group(function(){
    
            route::get('/',[BookController::class,'index'])->name('teacher.books');
            route::get('/create',[BookController::class,'create'])->name('teacher.book.create');
            route::post('/store',[BookController::class,'store'])->name('teacher.book.store');
    
            route::post('/update','update')->name('teacher.book.update');
    
            route::get('/destroy/{id}','destroy')->name('teacher.book.destroy');
    
            route::get('/download/{fileName}','downloadAttachment')->name('teacher.book.download');
    
            route::get('classes/get',[Classes::class,'getByGradeID'])->name('classes.get'); //for ajax
            
        });
    
        route::get('classes/get',[Classes::class,'getByGradeID'])->name('classes.get'); //for ajax

        route::get('/subjects',[DashboardSubjectController::class,'index'])->name('teacher.subject.index');
        
    });

});


?>