<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('races', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            
            $table->id();
            $table->string("track", 6);
            $table->string("date", 16);
            $table->integer("race_no");
            $table->string("entry", 2);
            $table->integer("distance");
            $table->string("surface", 2);
            $table->string("reserved_0008", 2);
            $table->string("race_type", 4);
            $table->string("age_sex_restrictions", 6);
            $table->string("today_race_classification", 28);
            $table->integer("purse");
            $table->integer("claiming_price");
            $table->float("track_record", 8, 2);
            $table->string("race_conditions", 1000);
            $table->string("today_lasix_list", 800);
            $table->string("today_bute_list", 800);
            $table->string("today_coupled_list", 400);
            $table->string("today_mutuel_list", 400);
            $table->string("simulcast_host_track_code", 6);
            $table->string("simulcast_host_track_race_no", 4);
            $table->string("breed_type", 4);
            $table->string("today_nasal_strip_change", 2);
            $table->string("today_all_weather_surface_flag", 2);
            $table->string("reserved_0026", 2);
            $table->string("reserved_0027", 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('races');
    }
}
