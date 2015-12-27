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

        //create max shift setting user
        DB::table('preferences')->insert([
            'name' => 'callerMinShifts',
            'value' => '5'
        ]);

        DB::table('preferences')->insert([
            'name' => 'maxCaller',
            'value' => '28'
        ]);
    }
}
