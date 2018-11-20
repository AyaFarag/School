<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("classes", function (Blueprint $table) {
            $table -> increments("id");
            $table -> string("name");
            $table -> integer("level_id") -> unsigned();
            $table -> timestamps();

            $table
                -> foreign("level_id")
                -> references("id")
                -> on("levels")
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
        Schema::dropIfExists("classes");
    }
}
