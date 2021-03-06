<?php

use Illuminate\Database\Seeder;

class CreatePermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // truncating the permissions table
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $scheduleShifts = new App\Permission();
        $scheduleShifts->name         = 'schedule-shifts';
        $scheduleShifts->display_name = 'Schedule Shifts'; // optional
        // Allow a user to...
        $scheduleShifts->description  = 'can schedule shifts'; // optional
        $scheduleShifts->save();

        $makeShifts = new App\Permission();
        $makeShifts->name         = 'make-shifts';
        $makeShifts->display_name = 'Make Shifts'; // optional
        // Allow a user to...
        $makeShifts->description  = 'can create shifts'; // optional
        $makeShifts->save();
    }
}
