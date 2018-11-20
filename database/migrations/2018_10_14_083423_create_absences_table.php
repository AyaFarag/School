<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("absences", function (Blueprint $table) {
            $table -> increments("id");
            $table -> integer("session_id") -> unsigned();
            $table -> integer("student_id") -> unsigned();
            $table -> boolean("has_permission") -> default(0);
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
        Schema::dropIfExists("absences");
    }
}
