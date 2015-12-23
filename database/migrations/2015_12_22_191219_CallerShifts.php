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

        Schema::dropIfExists('caller_shifts');


        Schema::create('caller_shifts', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->unsigned();
          $table->integer('shift_id')->unsigned();

          $table->foreign('user_id')
              ->references('id')->on('users')
              ->onDelete('cascade');
          $table->foreign('shift_id')
                  ->references('id')->on('shift_defination')
                  ->onDelete('cascade');
          $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
          $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

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
        Schema::dropIfExists('caller_shifts');
    }
}
