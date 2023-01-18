<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', 'HomeController@index');

// INGELOGD ALS ADMIN
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function (){

});

//INGELOGD ALS USER
Route::middleware(['auth'])->prefix('user')->group(function () {


});

//pompen
Route::get('/pump/{id}', 'HomeController@showPump');
Route::patch('/pump/{id}', 'HomeController@updatePump');

// logboek
Route::resource('log', 'LogController');

