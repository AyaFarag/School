<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("sessions", function (Blueprint $table) {
            $table -> increments("id");
            $table -> integer("teacher_id") -> unsigned();
            $table -> integer("semester_session_id") -> unsigned();
            $table -> timestamps();

            $table
                -> foreign("teacher_id")
                -> references("id")
                -> on("teachers")
                -> onDelete("cascade");
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
        Schema::dropIfExists("sessions");
    }
}
