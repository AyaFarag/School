<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("settings", function (Blueprint $table) {
            $table -> increments("id");
            $table -> text("social_networks");
            $table -> text("phone_numbers");
            $table -> text("websites");
            $table -> text("emails");
            $table -> text("addresses");
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
        Schema::dropIfExists("settings");
    }
}
