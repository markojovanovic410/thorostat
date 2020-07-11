<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePastPerformanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('past_performance', function($table) {
            $table->string('trip_comment', 100);
            $table->string('winner_weight_carried', 3);
            $table->string('second_place_weight_carried', 3);
            $table->string('third_place_weight_carried', 3);
            $table->string('winner_margin', 5);
            $table->string('second_place_margin', 5);
            $table->string('third_place_margin', 5);
            $table->string('bris_speed_rating', 3);
            $table->string('speed_rating', 3);
            $table->string('track_variant', 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('past_performance', function($table) {
            $table->dropColumn('trip_comment');
            $table->dropColumn('winner_weight_carried');
            $table->dropColumn('second_place_weight_carried');
            $table->dropColumn('third_place_weight_carried');
            $table->dropColumn('winner_margin');
            $table->dropColumn('second_place_margin');
            $table->dropColumn('third_place_margin');
            $table->dropColumn('bris_speed_rating');
            $table->dropColumn('speed_rating');
            $table->dropColumn('track_variant');
        });
    }
}
