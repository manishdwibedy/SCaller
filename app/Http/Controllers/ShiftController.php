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
        $nextSunday = date("Y-m-d", strtotime('next sunday'));
        $date = new \DateTime($nextSunday);
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

            Log::info('shift is ' . substr($key,6));
            $shiftPresent = \App\CallerShift::withTrashed()
                            ->where('user_id', Auth::user()->id)
                            ->where('shift_id', substr($key,6))
                            ->where('weekNumber', $week)
                            ->where('year', $year)
                            ->get();

            // Saving only if the shift not present
            if($shiftPresent->count() == 0)
            {
                Log::info('need to save the shift');
                $shiftPresent[0]->save();
            }
            else
            {
                Log::info('need to restore the shift');
                $shiftPresent[0]->restore();
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
              $shiftPresent[0]->delete();
            }
          }
        }

        $currentShifts = DB::table('caller_shifts')
                                ->select('shift_id', DB::raw('count(*) as total'))
                                ->where('weeknumber', $week)
                                ->whereNull('deleted_at')
                                ->groupBy('shift_id')
                                ->get();
        $shiftAvailability = array();
        foreach($currentShifts as $shift)
        {
            $shiftInfo = new \stdClass();
            $shiftInfo->total = $shift->total;
            $shiftInfo->text =  'Planned';
            $shiftAvailability[$shift->shift_id] = $shiftInfo;
        }

        $caller_shifts = \App\CallerShift::where('user_id', Auth::user()->id)
                            ->where('weeknumber', $week)
                            ->whereNull('deleted_at')
                            ->get();

        Log::info('no. of shifts - '.$caller_shifts->count());
        $shifts = DB::table('shift_defination')->get();

        $confirmationEmail = Request::input('confirmationEmail');
        $mailed = false;
        if($confirmationEmail == 'on')
        {
            $mailed = true;
            $managerEmail = DB::table('preferences')
                            ->where('name','managerEmail')
                            ->get()[0]
                            ->value;
            Log::info($managerEmail);
            $data = array(
                        'name' => Auth::user()->name,
                        'shifts' => $caller_shifts,
                        'managerEmail' => $managerEmail
                    );

            \Mail::send('mail.shiftConfirmation', $data, function ($message) use ($data) {
              $message->subject('Shift Confirmation - ' . Auth::user()->name)
                      ->to($data['managerEmail']);
            });
            Log::info('Sending an email to the manager');
        }
        return view('schedule' , ['page' => 'manage-schedule',
                                  'shifts' => $shifts,
                                  'saved' => true,
                                  'mailed' => $mailed,
                                  'caller_shifts' => $caller_shifts,
                                  'shiftAvailability' => $shiftAvailability
                                ]);
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
          if(array_key_exists('caller', $callerData))
          {
            $caller = $callerData['caller'];
            $caller->shiftCount = $caller->shiftCount + 1;

            $callerShifts = $caller->shifts;

            $callerShift = new \stdClass();
            $callerShift->start = date("l d F Y h:i A", strtotime($shift->shift_start));
            $callerShift->duration = $shift->duration;

            array_push($callerShifts, $callerShift);

            $caller->shifts = $callerShifts;

            $callerShifts = array($callerShift);

            unset($callerData[$caller->name]);

            $callerData['caller'] = $caller;

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
            $callerData['caller'] = $caller;
          }
        }
        return Response::json($callerData);
    }

    private function getData()
    {
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
          if(array_key_exists(date("d F Y", strtotime($shift->shift_start)), $callerData))
          {
            $caller = $callerData[date("d F Y", strtotime($shift->shift_start))];
            $caller->shiftCount = $caller->shiftCount + 1;

            $callerShifts = $caller->shifts;

            $callerDetail = new \stdClass();
            $callerDetail->start = date("h:i A", strtotime($shift->shift_start));
            $callerDetail->duration = $shift->duration;
            $callerDetail->callerName = $shift->name;

            array_push($callerShifts, $callerDetail);

            $caller->shifts = $callerShifts;

            $callerShifts = array($callerShifts);

            unset($callerData[date("d F Y", strtotime($shift->shift_start))]);

            $callerData[date("d F Y", strtotime($shift->shift_start))] = $caller;

          }
          else {
            // Creating a new entry
            $caller = new \stdClass();
            $caller->id = $shift->id;
            $caller->shiftCount = 1;

            $date = new \DateTime();

            $caller->weekNumber = $date->format("W");

            //Inserting the shift data of the current user
            $callerDetail = new \stdClass();
            $callerDetail->start = date("h:i A", strtotime($shift->shift_start));
            $callerDetail->duration = $shift->duration;
            $callerDetail->callerName = $shift->name;

            $callerShifts = array($callerDetail);
            $caller->shifts = $callerShifts;

            //Finally insert the data
            $callerData[date("d F Y", strtotime($shift->shift_start))] = $caller;
          }
        }

        $dayWiseData = array();
        foreach($callerData as $day=>$shifts)
        {
          $shifts = $shifts->shifts;

          $dayShiftData = array();

          //Loop through the day's shifts
          foreach($shifts as $shift)
          {
            $shiftDetail = new \stdClass();
            $shiftDetail->start = $shift->start;
            $shiftDetail->duration = $shift->duration;
            $shiftDetail->caller = $shift->callerName;
            if(array_key_exists($shift->start, $dayShiftData))
            {
              $shiftPresent = $dayShiftData[$shift->start];

              array_push($shiftPresent, $shiftDetail);
              $dayShiftData[$shift->start] = $shiftPresent;
            }
            else
            {
              $dayShiftData[$shift->start] = array($shiftDetail);
            }
          }
          $dayWiseData[$day] = $dayShiftData;
        }

        $excelData = array();
        foreach($dayWiseData as $day=>$shiftData)
        {
            $dayData = array();
            foreach($shiftData as $time=>$data)
            {
                $timeData = array($time);
                foreach($data as $shift)
                {
                  array_push($timeData, $shift->caller);
                }
                array_push($dayData, $timeData);
            }
            $excelData[$day] = $dayData;
        }
        return $excelData;
    }

    public function exportToExcel(){

      $excelData = $this->getData();

      \Excel::create('users', function($excel) use($excelData) {
          foreach($excelData as $day=>$data)
          {
              $excel->sheet($day, function($sheet) use($data) {
                  //$sheet->fromArray($data);
                  $sheet->fromArray($data, null, 'A1', false, false);

              });
          }

      })->export('xls');

    }

    public function exportToPDF(){

      $excelData = $this->getData();

      \Excel::create('users', function($excel) use($excelData) {
          foreach($excelData as $day=>$data)
          {
              $excel->sheet($day, function($sheet) use($data) {
                  //$sheet->fromArray($data);
                  $sheet->fromArray($data, null, 'A1', false, false);

              });
          }

      })->export('pdf');

    }
}
