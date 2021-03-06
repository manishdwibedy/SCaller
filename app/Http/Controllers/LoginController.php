<?php

namespace App\Http\Controllers;

use Log;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Input;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showLogin()
    {
      return view('login')->with('err','');
    }

    /**
     * Trying to login the user
     */
    public function attemptLogin(){
      if (Auth::attempt(array('email' => Request::get('email'),'password' => Request::get('password'))))
      {
          Log::info('Trying to login' );
          return redirect()->intended('home');
      }
      else{
          Log::info('Login failed');
          //return view('login')->with('err', 'Wrong username/password');
          return redirect('/')->with('err', 'Wrong username/password');
      }
    }

    /**
     * Logging out the current user
     */
    public function logout() {
        Auth::logout();

        return Redirect::away('/');
    }

    /**
     * Returns the user to the home page
     */
    public function home(){
        return view('home' , ['page' => 'home']);
    }

    public function test(){
        //$input = Request::all();
        $name = Request::input('checkbox_0');
        //return view('manage-schedule')->with(array('saved', true));
        return view('manage-schedule' , ['page' => 'home', 'saved' => true]);
        //echo 'asd'.$name;
    }

    public function showActivateAccount()
    {
        return view('auth.activate');
    }

    public function activateAccount(\Illuminate\Http\Request $request)
    {
        //Log::info($request);

        $inputs = Request::all();

        foreach($inputs as $input=>$value)
        {
            Log::info($input . ' - ' . $value);
        }

        $this->validate($request, [
            //'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:2',
        ]);

        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $response = \Password::reset($credentials, function ($user, $password) {
            $this->resetPassword($user, $password);
        });

        switch ($response) {
            case \Password::PASSWORD_RESET:
                return redirect($this->redirectPath())->with('status', trans($response));

            default:
                return redirect()->back()
                            ->withInput($request->only('email'))
                            ->withErrors(['email' => trans($response)]);
        }
    }
}
