<?php

use App\Http\Controllers\Classes\Classes;
use App\Http\Controllers\ClasseRooms\ClasseRoomController;
use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Teacher\TeacherController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

route::prefix(LaravelLocalization::setLocale())->middleware(
            [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
        )->group(function() {

    Route::get('/', function () {
        return view('dashboard');
    })->middleware(['auth','verified'])->name('home');

    Route::middleware('auth')->controller(ProfileController::class)->group(function () {
        Route::get('/profile','edit')->name('profile.edit');
        Route::patch('/profile','update')->name('profile.update');
        Route::delete('/profile','destroy')->name('profile.destroy');
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

    route::controller()->prefix('parent')->group(function() {

        route::view('/add','livewire.show_form');
        
    });

    route::controller(TeacherController::class)->prefix('teacher')->group(function() {

        route::get('/','index')->name('teacher.index');
        route::post('/store','store')->name('teacher.store');
        route::patch('/update','update')->name('teacher.update');
        route::delete('/destroy/{id}','destroy')->name('teacher.destroy');
        
    });

    route::controller(StudentController::class)->prefix('student')->group(function() {

        route::get('/','index')->name('student.index');
        route::post('/store','store')->name('student.store');
        route::patch('/update','update')->name('student.update');
        route::delete('/destroy/{id}','destroy')->name('student.destroy');
        route::get('/show/{id}','show')->name('student.show');
        route::post('/upload/attachments','uploadAttachment')->name('upload.attachment');
        route::delete('/delete/attachment','deleteAttachment')->name('delete.attachment');
        
    });

});

require __DIR__.'/auth.php';
