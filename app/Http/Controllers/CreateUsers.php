<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
use Log;
use DB;
use Auth;

class CreateUsers extends Controller
{
    //
    public function createUsers()
    {
        $inputs = Request::all();
        $userTypes = Request::get('userType');

        // Checking permission of user before creating new users

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

            foreach ($userTypes as $userType) {
                // Making a 'userType' user
                $user = \App\User::where('name', '=', $email)->first();
                $caller = \App\Role::where('name', '=', $userType)->first();

                // role attach alias
                $user->attachRole($caller); // parameter can be an Role object, array, or id
            }


            $data = array(
                        'name' => $email,
                        'username' => $email,
                        'password' => $password
                    );

            // Would sent a link to the user to activate his account
            // $this->sendLink($email);
            // \Mail::send('mail.email', $data, function ($message) use ($data) {
            //   $message->subject('Login Details ')
            //           ->to('manish.dwibedy@gmail.com');
            // });

        }


        return view('create-users', ['page' => 'create-users']);
    }

    function sendLink($email)
    {
        //$this->validate($email, ['email' => 'required|email']);

        $data = array();
        $data['email'] = $email;

        $response = Password::sendResetLink($data, function (Message $message) {
            $message->subject('Account created!');
        });

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return redirect()->back()->with('status', trans($response));

            case Password::INVALID_USER:
                return redirect()->back()->withErrors(['email' => trans($response)]);
        }
    }

    public function viewUsers()
    {
        $users = DB::table('users')
                    ->join('role_user', 'users.id', '=', 'role_user.user_id')
                    //->join('roles', 'roles.id', '=', 'role_user.user_id')
                    ->where('role_user.role_id', '>' , 2)
                    ->get();
        return view('view-users', ['page' => 'view-users', 'users' => $users]);
    }
}
