<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'api/','namespace'=>'Api'], function() {

    //routes user
    Route::resource('user/', 'UserController');

    Route::post('login/','AuthController@login');

    //routes participant
    Route::resource('participant/', 'ParticipantController');
    Route::get('participant/{uuid}', 'ParticipantController@remove');

    //routes report
    Route::resource('report/', 'ReportController');
});
