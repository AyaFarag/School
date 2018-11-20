<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("teachers", function (Blueprint $table) {
            $table -> increments("id");
            $table -> integer("branch_id") -> unsigned();
            $table -> string("name");
            $table -> string("email") -> unique();
            $table -> string("password");
            $table -> string("phone") -> unique();
            $table -> text("description");
            $table -> string("address");
            $table -> date("birth_date");
            $table -> string("nationality");
            $table -> enum("gender", ["male", "female", "other"]);
            $table -> string("api_token") -> nullable();
            $table -> string("device_token") -> nullable();
            $table -> timestamps();


            $table
                -> foreign("branch_id")
                -> references("id")
                -> on("branches")
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
        Schema::dropIfExists("teachers");
    }
}
