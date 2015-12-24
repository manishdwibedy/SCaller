<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWeekYearCallerShift extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('caller_shifts', function ($table) {
            $table->tinyInteger('weekNumber')->unsigned();
            $table->smallInteger('year')->unsigned();
            $table->unique(['user_id', 'shift_id', 'weekNumber', 'year']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('shift_defination', function ($table) {
            $table->dropColumn('weekNumber');
            $table->dropColumn('year');
            $table->dropUnique('caller_shifts_user_id_shift_id_weeknumber_year_unique');
        });
    }
}
