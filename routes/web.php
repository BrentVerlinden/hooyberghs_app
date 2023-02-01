<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Auth::routes();

// werven overzicht
Route::get('/', 'WerfController@home');
// homepage, overzicht
//Route::get('/', 'HomeController@index');

// INGELOGD ALS ADMIN
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function (){
    Route::resource('/werf/{werfid}/users', 'Admin\UserController');
    Route::resource('/werf/{werfid}/pumps', 'Admin\PumpController');
    // logboek
    Route::resource('/werf/{werfid}/log', 'LogController');

    //pompen
    Route::patch('/werf/{werfid}/pump/{id}', 'HomeController@updatePump');
    Route::patch('/werf/{werfid}/pump/{id}/handle-value-change', 'HomeController@handleValueChange');

    //pomp settings
//    Route::resource('/werf/{werfid}/pumpsettings', 'Admin\PumpSettingsController');
    Route::put('/werf/{werfid}/pumpsettings/{pumpid}', 'Admin\PumpSettingsController@update');
    Route::put('/werf/{werfid}/pumpsettings/extra/{pumpid}', 'Admin\PumpSettingsController@off');
    Route::get('/werf/{werfid}/pumpsettings', 'Admin\PumpSettingsController@index');
//    Route::patch('/werf/{werfid}/pumpsettings', 'Admin\PumpSettingsController@update');

//    Route::get('/werf/crud', 'WerfController@crud');

    Route::resource('werf/crud', 'WerfController');

});

//INGELOGD ALS USER
Route::middleware(['auth'])->prefix('user')->group(function () {
    // pompen
    Route::get('/werf/{werfid}/pump/{id}', 'HomeController@showPump');

    // home
    Route::get('/werf/{werfid}/home', 'HomeController@index');

    // werf
    Route::get('werf', 'WerfController@home');
//    Route::resource('werf', 'WerfController');
});

