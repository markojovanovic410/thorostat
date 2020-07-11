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
            $table->id();
            $table->string("race_date", 8);
            $table->string("track_code", 3);
            $table->string("race_num", 2);
            $table->string("distance", 5);
            $table->string("surface", 1);
            $table->string("race_type", 2);
            $table->string("restriction", 3);
            $table->string("classification", 14);
            $table->string("purse", 8);
            $table->string("claiming_price", 7);
            $table->string("track_record", 6);
            $table->string("race_condition", 500);
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
