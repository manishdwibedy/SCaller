<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ReminderController extends Controller
{
    //
    public function showReminder()
    {
        //return view('reminder')->with('page' => 'reminder');
        return view('reminder' , ['page' => 'reminder']);
    }

    public function setReminder()
    {
        //return view('reminder')->with('page' => 'reminder');
        return view('reminder' , ['page' => 'reminder']);
    }
}
