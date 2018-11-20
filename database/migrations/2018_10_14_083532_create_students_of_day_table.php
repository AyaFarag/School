<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsOfDayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("students_of_day", function (Blueprint $table) {
            $table -> increments("id");
            $table -> integer("session_id") -> unsigned();
            $table -> integer("student_id") -> unsigned();
            $table -> timestamps();

            $table
                -> foreign("session_id")
                -> references("id")
                -> on("sessions")
                -> onDelete("cascade");
            $table
                -> foreign("student_id")
                -> references("id")
                -> on("students")
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
        Schema::dropIfExists("students_of_day");
    }
}
