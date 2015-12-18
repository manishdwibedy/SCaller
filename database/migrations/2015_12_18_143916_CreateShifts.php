<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShifts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // This would be holding the shift defination
        Schema::create('shift_defination', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->dateTime('shift_start');
          $table->smallInteger('duration');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // This would drop the table, when needed.
        Schema::dropIfExists('shift_defination');
    }
}
