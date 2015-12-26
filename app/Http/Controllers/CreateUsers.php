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

        $emails = json_decode(Request::input('users'));
        foreach($emails as $email)
        {
            Log::info ('username - ' . $email);

            $password = str_random(10);
            DB::table('users')->insert([
                'name' => $email,
                'email' => $email,
                'password' => bcrypt($password),
                'type' => 'caller'
            ]);

            // Making a caller user
            $user = \App\User::where('name', '=', $email)->first();
            $caller = \App\Role::where('name', '=', 'caller')->first();

            // role attach alias
            $user->attachRole($caller); // parameter can be an Role object, array, or id

            $data = array(
                        'name' => $email,
                        'username' => $email,
                        'password' => $password
                    );

            \Mail::send('mail.email', $data, function ($message) use ($data) {
              $message->subject('Login Details ')
                      ->to('manish.dwibedy@gmail.com');
            });

        }
        return view('create-users', ['page' => 'create-users']);
    }
}
