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
     * Returns the caller to the scheduling page, showing current
     */
    public function schedule(){
        $shifts = DB::table('shift_defination')->get();

        $nextSunday = date("Y-m-d", strtotime('next sunday'));

        Log::info('user ID is '. Auth::user()->id);
        $nextSunday = date("Y-m-d", strtotime('next sunday'));
        $date = new \DateTime($nextSunday);
        $weekNumber = $date->format('W');
        Log::info('weekNumber is '. $weekNumber);

        $caller_shifts = \App\CallerShift::
                            where('user_id', Auth::user()->id)
                            ->where('weeknumber', $weekNumber)
                            ->get();
        Log::info('shifts is '. $caller_shifts);


        foreach($caller_shifts as $shift)
          Log::info('shift : ' . $shift->shift_id);
        //return view('schedule' , ['page' => 'schedule', 'shifts' => $shifts ]);
        return view('schedule' , ['page' => 'schedule', 'shifts' => $shifts , 'caller_shifts' => $caller_shifts]);
    }

    public function manageShifts(){
        $shifts = DB::table('shift_defination')->get();

        return view('manage-schedule' , ['page' => 'manage-schedule', 'shifts' => $shifts]);
    }

    public function viewCallerShifts(){
        $shiftSelected = DB::table('users')
                  ->join('caller_shifts', 'users.id', '=', 'caller_shifts.user_id')
                  ->join('shift_defination', 'shift_defination.id', '=', 'caller_shifts.shift_id')
                  ->select('users.id','users.name', 'shift_defination.shift_start', 'shift_defination.duration')
                  ->where('shift_defination.active', 1)
                  ->get();
        Log::info('user id '. Auth::user()->id);
        Log::info('count '. count($shiftSelected) );

        $callerData = array();
        foreach($shiftSelected as $shift)
        {
          if(array_key_exists($shift->name, $callerData))
          {
            $caller = $callerData[$shift->name];
            $caller->shiftCount = $caller->shiftCount + 1;

            // $callerShifts = $caller->shifts;
            //
            // $callerShift = new \stdClass();
            // $callerShift->start = $shift->shift_start;
            // $callerShift->duration = $shift->duration;
            //
            // array_push($callerShifts, $callerShift);
            //
            // $caller->shifts = $callerShifts;
            //
            // $callerShifts = array($callerShift);
            unset($callerData[$caller->name]);

            $callerData[$caller->name] = $caller;

          }
          else {
            // Creating a new entry
            $caller = new \stdClass();
            $caller->id = $shift->id;
            $caller->name = $shift->name;
            $caller->shiftCount = 1;

            $date = new \DateTime();

            $caller->weekNumber = $date->format("W");
            // Inserting the shift data of the current user
            // $callerShift = new \stdClass();
            // $callerShift->start = $shift->shift_start;
            // $callerShift->duration = $shift->duration;
            //
            // $callerShifts = array($callerShift);
            // $caller->shifts = $callerShifts;

            // Finally insert the data
            $callerData[$caller->name] = $caller;

          }
        }
        return view('callerShifts' , ['page' => 'caller-shifts', 'callerData' => $callerData]);
    }

    public function createUsers()
    {
        return view('create-users', ['page' => 'create-users']);
    }
}
