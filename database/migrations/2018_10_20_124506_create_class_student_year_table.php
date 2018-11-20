<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassStudentYearTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("class_student_year", function (Blueprint $table) {
            $table -> increments("id");
            $table -> integer("student_id") -> unsigned();
            $table -> integer("year_id") -> unsigned();
            $table -> integer("class_id") -> unsigned();
            $table -> boolean("paid_expenses") -> default(0);
            $table -> boolean("joined_bus") -> default(0);
            $table -> string("seat_number");

            $table
                -> foreign("student_id")
                -> references("id")
                -> on("students")
                -> onDelete("cascade");

            $table
                -> foreign("year_id")
                -> references("id")
                -> on("years")
                -> onDelete("cascade");
            $table
                -> foreign("class_id")
                -> references("id")
                -> on("classes")
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
        Schema::dropIfExists("class_student_year");
    }
}
