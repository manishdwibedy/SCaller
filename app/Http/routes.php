<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|


Route::get('/', function () {

    return view('login');
});
*/
// Authentication routes...
//Route::get('auth/login', 'LoginController@login');
Route::any('auth/login', 'LoginController@login1');
Route::get('/', 'LoginController@login');
//Route::post('auth/login', 'LoginController@login1');
Route::get('auth/logout', 'LoginController@logout');

Route::get('home', 'LoginController@home');
