<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'welcome');
Auth::routes();
Route::view('/t3', 'test3');

// INGELOGD ALS ADMIN
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function (){
    Route::view('/t2', 'test2');
});

//INGELOGD ALS USER
Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::view('/t1', 'test1'); // user (logged in) only
});


Route::get('/home', 'HomeController@index')->name('home');
