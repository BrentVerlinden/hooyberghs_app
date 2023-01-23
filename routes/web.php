<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

// werven overzicht
Route::get('/', 'WerfController@home');
// homepage, overzicht
//Route::get('/', 'HomeController@index');

// INGELOGD ALS ADMIN
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function (){
    Route::resource('users', 'Admin\UserController');
    // logboek
    Route::resource('log', 'LogController');

    //pompen
    Route::patch('/pump/{id}', 'HomeController@updatePump');

    //pomp settings
    Route::resource('pumpsettings', 'Admin\PumpSettingsController');

//    Route::get('/werf/crud', 'WerfController@crud');

    Route::resource('werf/crud', 'WerfController');

});

//INGELOGD ALS USER
Route::middleware(['auth'])->prefix('user')->group(function () {
    // pompen
    Route::get('/pump/{id}', 'HomeController@showPump');

    // werf
    Route::get('werf', 'WerfController@home');
//    Route::resource('werf', 'WerfController');
});

