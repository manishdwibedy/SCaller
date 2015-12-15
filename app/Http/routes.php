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


*/
// Authentication routes...
Route::get('/', 'LoginController@showLogin');
Route::post('auth/login', 'LoginController@attemptLogin');
Route::get('auth/logout', 'LoginController@logout');

// Home Page
Route::get('home',  ['middleware' => 'auth', 'uses' => 'LoginController@home']);

Route::get('schedule',  ['middleware' => 'auth', 'uses' => 'PageController@schedule']);
