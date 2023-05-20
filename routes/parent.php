<?php

use App\Http\Controllers\Parent\ParentController;
use App\Http\Controllers\Parent\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('parent/dashboard')->middleware('auth:parent')->group(function() {

    route::controller(ParentController::class)->group(function(){

        route::get('/','index')->name('parent.home');
        route::get('/son-fees','sonFees')->name('son_fees');

    });

    route::controller(ProfileController::class)->prefix('profile')->group(function() {

        route::get('/profile','index')->name('parent_profile.show');
        route::post('/profile/update','update')->name('parent_profile.update');

    });

})

?>