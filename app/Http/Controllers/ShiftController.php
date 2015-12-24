<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Log;
use Auth;
use Response;

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
        $date = new \DateTime();
        $week = $date->format("W");
        $year = $date->format("Y");

        // Get all the selected shifts
        $inputs = Request::all();

        foreach ($inputs as $key=>$shift)
        {
          if($key=='_token')
          {
            continue;
          }

          $CallerShift = new \App\CallerShift;
          $CallerShift->user_id = $user->id;
          $CallerShift->shift_id = substr($key,6);
          Log::info($key . '->' . $shift);
          if($shift == 1)
          {
            $CallerShift->weekNumber = $week;
            $CallerShift->year = $year;

            $shiftPresent = \App\CallerShift
                            ::where('user_id', Auth::user()->id)
                            ->where('shift_id', substr($key,6))
                            ->where('weekNumber', $week)
                            ->where('year', $year)
                            ->get();

            // Saving only if the shift not present
            if($shiftPresent->count() == 0)
            {
              $CallerShift->save();
            }
          }
          else
          {
            Log::info('unselected' . substr($key,6));
            Log::info("Weeknummer: $week");
            Log::info("Year: $year");
            Log::info("User: " . Auth::user()->id);
            Log::info("Shift: " . substr($key,6));
            $shiftPresent = \App\CallerShift
                            ::where('user_id', Auth::user()->id)
                            ->where('shift_id', substr($key,6))
                            ->where('weekNumber', $week)
                            ->where('year', $year)
                            ->get();

            Log::info('count ' . $shiftPresent->count());

            // Saving only if the shift not present
            if($shiftPresent->count() != 0)
            {
              Log::info('Trying to delete' . $shiftPresent[0] -> id);
              $shiftPresent[0]->delete();
              dd(DB::getQueryLog());

            }
          }
        }

        $caller_shifts = \App\CallerShift::where('user_id', Auth::user()->id)->get();
        $shifts = DB::table('shift_defination')->get();

        return view('schedule' , ['page' => 'manage-schedule', 'shifts' => $shifts, 'saved' => true, 'caller_shifts' => $caller_shifts]);
    }

    public function getCallerShiftDetails(){

        $userID = $_GET['userID'];
        $weekNumber = $_GET['weekNumber'];

        $shiftSelected = DB::table('users')
                  ->join('caller_shifts', 'users.id', '=', 'caller_shifts.user_id')
                  ->join('shift_defination', 'shift_defination.id', '=', 'caller_shifts.shift_id')
                  ->select('users.id','users.name', 'shift_defination.shift_start', 'shift_defination.duration')
                  ->where('shift_defination.active', 1)
                  ->where('users.id',$userID)
                  ->where('caller_shifts.weekNumber', $weekNumber)
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

            $callerShifts = $caller->shifts;

            $callerShift = new \stdClass();
            $callerShift->start = date("l d F Y h:i A", strtotime($shift->shift_start));
            $callerShift->duration = $shift->duration;

            array_push($callerShifts, $callerShift);

            $caller->shifts = $callerShifts;

            $callerShifts = array($callerShift);

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

            //Inserting the shift data of the current user
            $callerShift = new \stdClass();



            $callerShift->start = date("l d F Y h:i A", strtotime($shift->shift_start));
            $callerShift->duration = $shift->duration;

            $callerShifts = array($callerShift);
            $caller->shifts = $callerShifts;

            //Finally insert the data
            $callerData[$caller->name] = $caller;

          }
        }
        return Response::json($callerData);
        //return view('callerShifts' , ['page' => 'caller-shifts', 'callerData' => $callerData]);
    }

    public function exportShiftDetails(){


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

          $callerShifts = $caller->shifts;

          $callerShift = new \stdClass();
          $callerShift->start = date("l d F Y h:i A", strtotime($shift->shift_start));
          $callerShift->duration = $shift->duration;

          array_push($callerShifts, $callerShift);

          $caller->shifts = $callerShifts;

          $callerShifts = array($callerShift);

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

          //Inserting the shift data of the current user
          $callerShift = new \stdClass();



          $callerShift->start = date("l d F Y h:i A", strtotime($shift->shift_start));
          $callerShift->duration = $shift->duration;

          $callerShifts = array($callerShift);
          $caller->shifts = $callerShifts;

          //Finally insert the data
          $callerData[$caller->name] = $caller;

        }
      }

      $excelData = array();
      for()

      $users = \App\User::select('id', 'name', 'email', 'created_at')->get();
      \Excel::create('users', function($excel) use($callerData) {
          $excel->sheet('Sheet 1', function($sheet) use($callerData) {
              $sheet->fromArray($callerData);
          });
      })->export('xls');

      // \Excel::create('Document', function($excel) use($callerData) {
      //     $excel->sheet('Sheet', function($sheet) use($callerData){
      //         $sheet->fromArray($callerData);
      //     });
      // })->download('xls');
    }
}
