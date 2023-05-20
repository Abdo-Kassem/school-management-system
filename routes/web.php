<?php

use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\Classes\Classes;
use App\Http\Controllers\ClasseRooms\ClasseRoomController;
use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\Liberary\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Quizzes\QuestionController;

use App\Http\Controllers\Student\Attendance\AttendanceController;
use App\Http\Controllers\Student\FeesController;
use App\Http\Controllers\Student\GraduateController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Teacher\TeacherController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Student\Promotion;
use App\Http\Controllers\Student\StudentFeesController;
use App\Http\Controllers\Subjects\SubjectController;
use App\Http\Controllers\Auth\Selection;
use App\Http\Controllers\Parent\ProfileController as ParentProfileController;
use App\Http\Controllers\Quizzes\QuizzController;
use App\Http\Livewire\Calendar;
use Livewire\Livewire;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Livewire::component('calendar', Calendar::class);

route::prefix(LaravelLocalization::setLocale())->middleware(
            [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ,'auth:web']
        )->group(function() {
           

    Route::get('/admin/dashboard',[AdminHomeController::class,'index'])->name('home');
    

    route::controller(ParentProfileController::class)->prefix('profile')->group(function(){

        route::get('/',[ProfileController::class,'index'])->name('admin_profile.show');
        route::post('/update',[ProfileController::class,'update'])->name('admin_profile.update');

    });
    
    route::controller(GradeController::class)->group(function() {

        route::get('grades','index')->name('grades');
        route::post('grade/store','store')->name('Grades.store');
        route::post('grade/update','update')->name('Grades.update');
        route::delete('grade/destroy/{id}','destroy')->name('Grades.destroy');

    });

    route::controller(Classes::class)->prefix('classes')->group(function() {

        route::get('/','index')->name('classes');
        route::post('/store','store')->name('classes.store');
        route::patch('/update','update')->name('classes.update');
        route::delete('/destroy/{id}','destroy')->name('classes.destroy');
        route::delete('/delete-all-selected','destroyAll')->name('classes.destroy.all');
        route::get('/filter','filter')->name('classes.filter');

        route::get('/get','getByGradeID')->name('classes.get');

    });

    route::controller(ClasseRoomController::class)->prefix('classrooms')->group(function() {

        route::get('/','index')->name('classe.rooms');
        route::post('/store','store')->name('classroom.store');
        route::patch('/update','update')->name('classroom.update');
        route::delete('/destroy/{id}','destroy')->name('classroom.destroy');
        route::delete('/delete-all-selected','destroyAll')->name('classroom.destroy.all');

        route::get('/get','getBygradeID')->name('classroom.get');

    });

    
    route::view('parent/add','livewire.show_form');


    route::controller(TeacherController::class)->prefix('teacher')->group(function() {

        route::get('/','index')->name('teacher.index');
        route::post('/store','store')->name('teacher.store');
        route::patch('/update','update')->name('teacher.update');
        route::delete('/destroy/{id}','destroy')->name('teacher.destroy');

    });


    Route::controller(StudentController::class)->prefix('student')->group(function() {

        route::get('/','index')->name('student.index');
        route::post('/store','store')->name('student.store');
        route::patch('/update','update')->name('student.update');
        route::delete('/destroy/{id}','destroy')->name('student.destroy');
        route::get('/show/{id}','show')->name('student.show');
        route::get('/add-student-fees/{id}','addStudentFees')->name('student.addStudyFees');
        route::post('/upload/attachments','uploadAttachment')->name('upload.attachment');
        route::delete('/delete/attachment','deleteAttachment')->name('delete.attachment');
        route::get('/download/attachment/{studentID}/{fileName}','downloadAttachment')->name('download.attachment');

    });


    route::prefix('promotion')->group(function() {

        route::controller(Promotion::class)->group(function(){
            route::get('/','index')->name('promotion.index');
            route::get('/create','create')->name('promotion.create');
            route::post('/store','store')->name('promotion.store');
            route::delete('/destroy-all','deleteAll')->name('promotion.destroy.all');
            route::delete('/destroy','destroy')->name('promotion.destroy');

            route::get('show/{promotionID}','show')->name('promotion.show');
            route::get('graduate/student/{id}','show')->name('promotion.graduate');
            
        });

        route::get('classes/get',[Classes::class,'getBygradeID'])->name('classroom.get');
    });


    route::prefix('study-fees')->group(function() {

        route::controller(FeesController::class)->group(function() {

            route::get('/list','index')->name('fees.index');
            route::get('/create','create')->name('fees.create');
            route::post('/store','store')->name('fees.store');
            route::post('/update','update')->name('fees.update');
            route::delete('/destroy/{id}','destroy')->name('fees.destroy');

            route::get('show/{feesID}','show')->name('fees.show');

        });

        route::get('classes/get',[Classes::class,'getBygradeID'])->name('classroom.get');

    });


    route::prefix('student-fees')->controller(StudentFeesController::class)->group(function() {

        route::get('/','index')->name('student_fees.index');
        route::get('/create/{stdentID}','create')->name('student_fees.create');
        route::post('/store','store')->name('student_fees.store');
        route::post('/update','update')->name('student_fees.update');
        route::delete('/destroy/{id}','destroy')->name('student_fees.destroy');

        route::get('/fees-value','getStudyFees')->name('student-fees.fees_value');

    });


    route::prefix('student-attendance')->controller(AttendanceController::class)->group(function() {

        route::get('/','index')->name('student-attendance.index');
        route::get('/students/{ids}','show')->name('student-attendance.show');
        route::post('/store','store')->name('attendance.store');

    });


    route::prefix('subject')->group(function() {

        route::controller(SubjectController::class)->group(function(){
            route::get('/','index')->name('subject.index');
            route::get('/create','create')->name('subject.create');
            route::post('/store','store')->name('subject.store');

            route::post('/update','update')->name('subject.update');

            route::delete('/destroy/{id}','destroy')->name('subject.destroy');
        });

        route::get('classes/get',[Classes::class,'getByGradeID'])->name('classes.get');

    });


    route::prefix('quizz')->group(function() {

        route::controller(QuizzController::class)->group(function(){
            route::get('/all','index')->name('quizz.index');
            route::get('/create','create')->name('quizz.create');
            route::post('/store','store')->name('quizz.store');

            route::post('/update','update')->name('quizz.update');

            route::delete('/destroy/{id}','destroy')->name('quizz.destroy');
        });

        route::controller(QuestionController::class)->prefix('questions')->group(function(){

            route::get('/{quizzID}','index')->name('questions.index');
            
            route::post('/store','store')->name('questions.store');

            route::post('/update','update')->name('questions.update');

            route::delete('/destroy/{id}','destroy')->name('questions.destroy');
        });

        route::get('classes/get',[Classes::class,'getByGradeID'])->name('classes.get');
        route::get('classrooms/get',[ClasseRoomController::class,'getBygradeID'])->name('classroom.get');
        route::get('teacher/get',[SubjectController::class,'getTeacherBy'])->name('teacher.get');

    });


    route::controller(GraduateController::class)->prefix('graduate')->group(function() {

        route::get('/','index')->name('graduate.index');
        route::post('/store','store')->name('graduate.store');
        route::delete('/destroy','update')->name('graduate.destroy');

    });


    route::prefix('books')->group(function() {

        route::controller(BookController::class)->group(function(){
            route::get('/all','index')->name('book.index');
            route::get('/create','create')->name('book.create');
            route::post('/store','store')->name('book.store');

            route::post('/update','update')->name('book.update');

            route::get('/destroy/{id}','destroy')->name('book.destroy');

            route::get('/download/{fileName}','downloadAttachment')->name('book.download');
        });

        route::get('classes/get',[Classes::class,'getByGradeID'])->name('classes.get');
        route::get('classrooms/get',[ClasseRoomController::class,'getBygradeID'])->name('classroom.get');
        route::get('teacher/get/byGrade',[TeacherController::class,'getTeacherBy'])->name('teacher.getByGrade');

    });

});

require __DIR__.'/auth.php';

route::prefix(LaravelLocalization::setLocale())->middleware(
    [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
)->group(function() {

    Route::get('/',[Selection::class,'index'])->middleware('guest')->name('auth.selection');

    require __DIR__.'/student.php';
    require __DIR__.'/parent.php';
    require __DIR__.'/teacher.php';

});