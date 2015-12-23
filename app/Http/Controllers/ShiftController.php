<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Log;
use Auth;

class ShiftController extends Controller
{
    // Get all shifts
    public function ModifyShifts(){
        $shiftDefinations = array();

        for($day=0;$day<6;$day++)
        {
          for($shift=0;$shift<3;$shift++)
          {
              $selectShift = Request::input('checkbox_' . $day . '_' . $shift);
              Log::info('checkbox_' . $day . '_' . $shift . ' : '. $selectShift);

              $shiftDefinations[3*$day + $shift + 1] = $selectShift == 'on' ? 1 : 0;

          }
        }
        $shifts = \App\Shift_Defination::all();
        foreach ($shiftDefinations as $key => $value) {
          Log::info($key . '-' . $value);
        }

        foreach ($shifts as $shift) {
          if($shift->active != $shiftDefinations[$shift->id])
          {
            Log::info('change active of ID -' . $shift->id . ' to '. $shiftDefinations[$shift->id]);
            $shift->active = $shiftDefinations[$shift->id];
            $shift->save();
          }
        }

        $shifts = DB::table('shift_defination')->get();

        return view('manage-schedule' , ['page' => 'manage-schedule', 'shifts' => $shifts, 'saved' => true]);
    }



    // Get all shifts
    public function scheduleShifts(){

        // Get the current user
        $user = Auth::user();
        Log::info($user->id);

        // Get all the selected shifts
        $inputs = Request::all();
        Log::info($inputs);

        foreach ($inputs as $key=>$shift)
        {
          if($key=='_token')
          {
            continue;
          }

          $CallerShift = new \App\CallerShift;
          $CallerShift->user_id = $user->id;
          Log::info($key . '->' . $shift);
          if($shift == 1)
          {
            $CallerShift->shift_id = 1;
            $CallerShift->save();

          }

        }


        $shifts = DB::table('shift_defination')->get();

        return view('schedule' , ['page' => 'manage-schedule', 'shifts' => $shifts, 'saved' => true]);
    }
}
