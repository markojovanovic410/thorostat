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
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            
            $table->id();
            $table->integer('race_id');
            $table->integer("horse_id");
            $table->string("date", 16);
            $table->float("time", 8, 2);
            $table->string("track", 20);
            $table->integer("distance");
            $table->string("track_condition", 4);
            $table->string("description", 6);
            $table->string("main_inner_track_indicator", 4);
            $table->integer("works_day_distance");
            $table->integer("other_works_day_distance");
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
