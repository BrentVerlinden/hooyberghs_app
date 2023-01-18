<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

// homepage, overzicht
Route::get('/', 'HomeController@index');

// INGELOGD ALS ADMIN
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function (){
    // logboek
    Route::resource('log', 'LogController');
    Route::get('filtered', 'LogController@filtered');
    //pompen
    Route::patch('/pump/{id}', 'HomeController@updatePump');

});

//INGELOGD ALS USER
Route::middleware(['auth'])->prefix('user')->group(function () {
    // pompen
    Route::get('/pump/{id}', 'HomeController@showPump');
});

