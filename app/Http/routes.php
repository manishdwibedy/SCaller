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
Route::get('/', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'LoginController@logout');

// Home Page
Route::get('home',  ['middleware' => 'auth', 'uses' => 'LoginController@home']);

//Managing Scheduling
Route::get('schedule',  ['middleware' => 'auth', 'uses' => 'PageController@schedule']);

// Caller Scheduling Shifts
Route::post('schedule',  ['middleware' => 'auth', 'uses' => 'ShiftController@scheduleShifts']);

// Only manager can manage shifts, others get redirected to the home page.
Entrust::routeNeedsRole('manage-shifts', array('manager'), Redirect::to('/home'));

// Managing the shift data
Route::get('manage-shifts',  ['middleware' => 'auth', 'uses' => 'PageController@manageShifts']);
Route::post('manage-shifts',  ['middleware' => 'auth', 'uses' => 'ShiftController@ModifyShifts']);

// View caller details
Route::get('caller-shifts',  ['middleware' => 'auth', 'uses' => 'PageController@viewCallerShifts']);
Route::get('caller-shift-details', 'ShiftController@getCallerShiftDetails');

// Exporting shift data
Route::get('export-xls', 'ShiftController@exportToExcel');
Route::get('export-pdf', 'ShiftController@exportToPDF');

// Creating users
Route::get('create-users', 'PageController@createUsers');
Route::post('create-users', 'CreateUsers@createUsers');
Route::get('view-users', 'CreateUsers@viewUsers');


// Resting the password for inactive users
Route::get('reset-password', 'Auth\PasswordController@getEmail');
Route::post('reset-password', 'Auth\PasswordController@postEmail');
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

//
Route::get('activateAccount', 'LoginController@showActivateAccount');
Route::post('activateAccount', 'LoginController@activateAccount');

//
Route::get('reminder', 'ReminderController@showReminder');
Route::post('reminder', 'ReminderController@setReminder');

// User messaging system
Route::get('new-message', 'MessageController@newMessage');
Route::post('new-message', 'MessageController@sendMessage');
Route::get('searchUsers', 'MessageController@getUsers');
