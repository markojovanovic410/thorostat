<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePastPerformanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('past_performance', function (Blueprint $table) {
            $table->id();
            $table->integer('race_id');
            $table->integer('horse_id');
            $table->string('race_date', 8);
            $table->string('days_since_last_match', 4);
            $table->string('track_code', 30);
            $table->string('race_num', 2);
            $table->string('condition', 2);
            $table->string('distance', 5);
            $table->string('surface', 1);
            $table->string('num_of_entrants', 2);
            $table->string('post_position', 2);
            $table->string('winner_name', 50);
            $table->string('second_place_name', 50);
            $table->string('third_place_name', 50);
            $table->string('weight', 3);
            $table->string('odds', 7);
            $table->string('entry', 1);
            $table->string('classification', 25);
            $table->string('claiming_price', 7);
            $table->string('purse', 8);
            $table->string("trainer", 31);
            $table->string("jockey", 31);
            $table->string("race_type", 2);
            $table->string("restriction", 3);
            $table->string("bris_speed_rating", 3);
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
        Schema::dropIfExists('past_performance');
    }
}
