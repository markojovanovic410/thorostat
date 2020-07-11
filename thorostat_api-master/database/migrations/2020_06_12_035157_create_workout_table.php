<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkoutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workout', function (Blueprint $table) {
            $table->id();
            $table->integer('race_id');
            $table->integer("horse_id");
            $table->string("date", 8);
            $table->string("time", 7);
            $table->string("track_code", 10);
            $table->string("distance", 5);
            $table->string("condition", 2);
            $table->string("description", 3);
            $table->string("indicator", 2);
            $table->string("number_of_workout", 4);
            $table->string("rank_among_others", 4);
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
        Schema::dropIfExists('workout');
    }
}
