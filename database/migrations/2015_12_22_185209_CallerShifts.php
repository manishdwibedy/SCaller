<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CallerShifts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('caller_shifts', function (Blueprint $table) {
          $table->increments('id');
          $table->foreign('user_id')
              ->references('id')->on('users')
              ->onDelete('cascade');
            $table->foreign('shift_id')
                  ->references('id')->on('shift_defination')
                  ->onDelete('cascade');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');

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
        Schema::drop('caller_shifts');

    }
}
