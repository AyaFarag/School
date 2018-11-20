<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("schedules", function (Blueprint $table) {
            $table -> increments("id");
            $table -> integer("semester_session_id") -> unsigned();
            $table -> enum("day", ["saturday", "sunday", "monday", "tuesday", "wednesday", "thursday", "friday"]);
            $table -> time("from");
            $table -> time("to");
            $table -> timestamps();

            $table
                -> foreign("semester_session_id")
                -> references("id")
                -> on("semester_sessions")
                -> onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("schedules");
    }
}
