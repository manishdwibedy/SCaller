<?php

use Illuminate\Database\Seeder;

class LoadShiftDefination extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('shift_defination')->truncate();

        $days = array(
            'Mon',
            'Tue',
            'Wed',
            'Thur',
            'Fri',
            'Sat',
            'Sun',
        );
        $date = new \DateTime();

        for ($index = 0; $index < 7; $index++) {

          $date->setDate(2016, 1, 2 + $index);

          DB::table('shift_defination')->insert([
              'name' => $days[$index] . '_2_30PM',
              'shift_start' => $date->setTime(14,30),
              'duration' => 2
          ]);

          DB::table('shift_defination')->insert([
              'name' => $days[$index] . '_5PM',
              'shift_start' => $date->setTime(17,0),
              'duration' => 2
          ]);

          DB::table('shift_defination')->insert([
              'name' => $days[$index] . '_7PM',
              'shift_start' => $date->setTime(21,0),
              'duration' => 2
          ]);
        }

    }
}
