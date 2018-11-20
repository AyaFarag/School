<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/* AKA Junction */
class CreateSemesterSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("semester_sessions", function (Blueprint $table) {
            $table -> increments("id");
            $table -> integer("class_id") -> unsigned();
            $table -> integer("teacher_id") -> unsigned();
            $table -> integer("subject_id") -> unsigned();
            $table -> integer("year_id") -> unsigned();
            $table -> timestamps();

            $table
                -> foreign("class_id")
                -> references("id")
                -> on("classes")
                -> onDelete("cascade");
            $table
                -> foreign("teacher_id")
                -> references("id")
                -> on("teachers")
                -> onDelete("cascade");
            $table
                -> foreign("subject_id")
                -> references("id")
                -> on("subjects")
                -> onDelete("cascade");
            $table
                -> foreign("year_id")
                -> references("id")
                -> on("years")
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
        Schema::dropIfExists("semester_sessions");
    }
}
