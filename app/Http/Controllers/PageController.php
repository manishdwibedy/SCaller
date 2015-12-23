<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    /**
     * Returns the user to the scheduling page
     */
    public function schedule(){
        $shifts = DB::table('shift_defination')->get();
        return view('schedule' , ['page' => 'schedule', 'shifts' => $shifts]);
    }

    public function manageShifts(){
        $shifts = DB::table('shift_defination')->get();

        return view('manage-schedule' , ['page' => 'manage-schedule', 'shifts' => $shifts]);
    }

}
