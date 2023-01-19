<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', 'HomeController@index');

// INGELOGD ALS ADMIN
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function (){
    Route::resource('users', 'Admin\UserController');
});

//INGELOGD ALS USER
Route::middleware(['auth'])->prefix('user')->group(function () {


});

//pompen
Route::get('/pump/{id}', 'HomeController@showPump');
Route::patch('/pump/{id}', 'HomeController@updatePump');

