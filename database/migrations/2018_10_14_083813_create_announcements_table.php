<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("announcements", function (Blueprint $table) {
            $table -> increments("id");
            $table -> integer("semester_session_id") -> unsigned();
            $table -> string("title");
            $table -> text("content");
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
        Schema::dropIfExists("announcements");
    }
}
