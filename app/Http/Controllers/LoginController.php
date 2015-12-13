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

    /**
     * Trying to authenticate the user
     */
    public function authenticate() {
      Log::info('Showing user profile for user:111');
/*
        if (Auth::attempt(['email' => Request::get('form-username'), 'password' => Request::get('form-password')]))
        {
            Log::info('Showing user profile for user: ');

          //return 'Done';
      //      return redirect()->intended('checkout');
        } else
        {
            //return 'Error';
        //    return view('login', array('title' => 'Welcome', 'description' => '', 'page' => 'home'));
      }*/
        return 'hhi';
    }

    public function login(){
      return view('login');
    }

    public function login1(){
      if (Auth::attempt(array('email' => Request::get('email'),'password' => Request::get('password'))))
      {
          Log::info('Showing user profile for user: ' );
          return redirect()->intended('home');
      }
      else {
        return 'dummy' . Request::get('email') . '   --- '  . Request::get('password');
      }
      return 'login';
    }

    public function home(){
        return view('home');
    }
    /**
     * Logging out the current user
     */
    public function logout() {
        Auth::logout();

        return Redirect::away('/');
    }
}
