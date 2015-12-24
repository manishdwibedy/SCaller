<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CreateUsers extends Controller
{
    //
    public function createUsers()
    {
        return view('create-users', ['page' => 'create-users']);
    }
}
