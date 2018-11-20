<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTotalPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("students_total_points", function (Blueprint $table) {
            $table -> increments("id");
            $table -> integer("semester_session_id") -> unsigned();
            $table -> integer("student_id") -> unsigned();
            $table -> integer("points") -> unsigned();
            $table
                -> foreign("student_id")
                -> references("id")
                -> on("students")
                -> onDelete("cascade");
            $table
                -> foreign("semester_session_id")
                -> references("id")
                -> on("semester_sessions")
                -> onDelete("cascade");
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("students_total_points");
    }
}
