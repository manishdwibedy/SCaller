<?php

use Illuminate\Database\Seeder;

class ShiftPreferences extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('preferences')->truncate();

        // create max shift setting user
        DB::table('preferences')->insert([
            'name' => 'callerMinShifts',
            'value' => '5'
        ]);

        // getting the maximum callers per shifts
        DB::table('preferences')->insert([
            'name' => 'maxCaller',
            'value' => '28'
        ]);

        // getting the manager's email
        DB::table('preferences')->insert([
            'name' => 'managerEmail',
            'value' => 'manish.dwibedy@gmail.com'
        ]);
    }
}
