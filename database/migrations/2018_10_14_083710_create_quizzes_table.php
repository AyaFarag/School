<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("quizzes", function (Blueprint $table) {
            $table -> increments("id");
            $table -> string("title");
            $table -> text("content");
            $table -> integer("session_id") -> unsigned();
            $table -> integer("grade") -> unsigned();
            $table -> timestamps();

            $table
                -> foreign("session_id")
                -> references("id")
                -> on("sessions")
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
        Schema::dropIfExists("quizzes");
    }
}
