<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Log;
use DB;

class CreateUsers extends Controller
{
    //
    public function createUsers()
    {
        $inputs = Request::all();

        $users = json_decode(Request::input('users'));
        foreach($users as $user)
        {
            Log::info ($user);

            DB::table('users')->insert([
                'name' => $user,
                'email' => $user,
                'password' => bcrypt($user),
                'type' => 'caller'
            ]);

            // Making a caller user
            $user = \App\User::where('name', '=', $user)->first();
            $caller = \App\Role::where('name', '=', 'caller')->first();

            // role attach alias
            $user->attachRole($caller); // parameter can be an Role object, array, or id

            $message = 'An account has been created for you. The details are as follows: <br> ';
            $message .= 'User ID - ' . $user . '<br>';
            $message .= 'Password - ' . $user . '<br><br>';
            $message .= 'Regards <br> Manish Dwibedy';

            Mail::queue('This is the body of my email', $data, function($message)
            {
                $message->to('foo@example.com', 'John Smith')->subject('This is my subject');
            });
        }
        return view('create-users', ['page' => 'create-users']);
    }
}
