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

//Managing Scheduling
Route::get('schedule',  ['middleware' => 'auth', 'uses' => 'PageController@schedule']);

// Caller Scheduling Shifts
Route::post('schedule',  ['middleware' => 'auth', 'uses' => 'ShiftController@scheduleShifts']);

//Only manager can manage shifts, others get redirected to the home page.
Entrust::routeNeedsRole('manage-shifts', array('manager'), Redirect::to('/home'));

Route::get('manage-shifts',  ['middleware' => 'auth', 'uses' => 'PageController@manageShifts']);
Route::post('manage-shifts',  ['middleware' => 'auth', 'uses' => 'ShiftController@ModifyShifts']);

Route::get('caller-shifts',  ['middleware' => 'auth', 'uses' => 'PageController@viewCallerShifts']);

Route::get('caller-shift-details', 'ShiftController@getCallerShiftDetails');

Route::get('export-xls', 'ShiftController@exportToExcel');
Route::get('export-pdf', 'ShiftController@exportToPDF');
