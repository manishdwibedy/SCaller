<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ShiftController extends Controller
{
    // Get all shifts
    public function ModifyShifts(){

        //$name = Request::input('checkbox_0');
        $shifts = DB::table('shift_defination')->get();

        return view('manage-schedule' , ['page' => 'manage-schedule', 'shifts' => $shifts, 'saved' => true]);
    }
}
