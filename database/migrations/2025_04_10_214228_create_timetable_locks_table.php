<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimetableLocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timetable_locks', function (Blueprint $table) {
            $table->increments('tt_lock_id');
            $table->date('tt_lock_date');
            $table->time('tt_lock_time_begin')->nullable();
            $table->boolean('tt_lock_allday')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timetable_locks');
    }
}
