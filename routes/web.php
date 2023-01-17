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

Route::get('/user/home', 'HomeController@index')->name('home');

Route::get('/t3', 'test3');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/t1', 'test1'); // user (logged in) only
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/t2', 'test2'); // admin only
    });
});

Route::get('/home', 'HomeController@index')->name('home');
