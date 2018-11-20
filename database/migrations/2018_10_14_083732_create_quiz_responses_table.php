<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("quiz_responses", function (Blueprint $table) {
            $table -> increments("id");
            $table -> integer("quiz_id") -> unsigned();
            $table -> integer("student_id") -> unsigned();
            $table -> integer("points") -> unsigned() -> nullable();
            $table -> text("content");
            $table -> timestamps();

            $table
                -> foreign("quiz_id")
                -> references("id")
                -> on("quizzes")
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
        Schema::dropIfExists("quiz_responses");
    }
}
