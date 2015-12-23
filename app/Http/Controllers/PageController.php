<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Log;

class PageController extends Controller
{
    /**
     * Returns the user to the scheduling page
     */
    public function schedule(){
        $shifts = DB::table('shift_defination')->get();

        Log::info('user ID is '. Auth::user()->id);
        $caller_shifts = \App\CallerShift::where('user_id', Auth::user()->id)->get();
        Log::info('shifts is '. $caller_shifts);

        foreach($caller_shifts as $shift)
          Log::info($shift->shift_id);
        //return view('schedule' , ['page' => 'schedule', 'shifts' => $shifts ]);
        return view('schedule' , ['page' => 'schedule', 'shifts' => $shifts , 'caller_shifts' => $caller_shifts]);
    }

    public function manageShifts(){
        $shifts = DB::table('shift_defination')->get();

        return view('manage-schedule' , ['page' => 'manage-schedule', 'shifts' => $shifts]);
    }

}
