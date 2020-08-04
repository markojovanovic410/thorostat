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
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            
            $table->id();
            $table->integer("race_id");
            $table->integer("horse_id");
            $table->string("race_date", 16);
            $table->integer("days_since_previous_race");
            $table->string("track_code", 60);
            $table->string("bris_track_code", 6);
            $table->integer("race_no");
            $table->string("track_condition", 4);
            $table->integer("distance");
            $table->string("surface", 2);
            $table->string("special_chute_indicator", 2);
            $table->integer("entrants");
            $table->integer("post_position");
            $table->string("equipment", 2);
            $table->string("race_name_previous_races", 1000);
            $table->integer("medication");
            $table->string("trip_comment", 200);
            $table->string("winner_name", 60);
            $table->string("second_place_finishers_name", 60);
            $table->string("third_place_finishers_name", 60);
            $table->integer("winner_weight_carried");
            $table->integer("second_place_weight_carried");
            $table->integer("third_place_weight_carried");
            $table->float("winner_margin", 8, 2);
            $table->float("second_place_margin", 8, 2);
            $table->float("third_place_margin", 8, 2);
            $table->string("alternate_extra_comment_line", 400);
            $table->integer("weight");
            $table->float("odds", 8, 2);
            $table->string("entry", 2);
            $table->string("race_classification", 50);
            $table->integer("claiming_price");
            $table->integer("purse");
            $table->integer("start_call_position");
            $table->integer("first_call_position");
            $table->integer("second_call_position");
            $table->integer("gate_call_position");
            $table->integer("stretch_position");
            $table->integer("finish_position");
            $table->integer("money_position");
            $table->float("start_call_btnlngths_ldr_margin", 8, 2);
            $table->float("start_call_btnlngths_only", 8, 2);
            $table->float("first_call_btnlngths_ldr_margin", 8, 2);
            $table->float("first_call_btnlngths_only", 8, 2);
            $table->float("second_call_btnlngths_ldr_margin", 8, 2);
            $table->float("second_call_btnlngths_only", 8, 2);
            $table->integer("bris_race_shape_1st_call");
            $table->string("reserved_0706_0715", 2);
            $table->float("stretch_btnlngths_ldr_margin", 8, 2);
            $table->float("stretch_btnlngths_only", 8, 2);
            $table->float("finish_btnlngths_wnrs_margin", 8, 2);
            $table->float("finish_btnlngths_only", 8, 2);
            $table->integer("bris_race_shape_2nd_call");
            $table->integer("bris_2f_pace_fig");
            $table->integer("bris_4f_pace_fig");
            $table->integer("bris_6f_pace_fig");
            $table->integer("bris_8f_pace_fig");
            $table->integer("bris_10f_pace_fig");
            $table->integer("bris_last_pace_fig");
            $table->string("reserved_0826_0835", 2);
            $table->string("reserved_0836_0845", 2);
            $table->integer("bris_speed_rating");
            $table->integer("speed_rating");
            $table->integer("track_variant");
            $table->float("one_f_fraction", 8, 2);
            $table->float("three_f_fraction", 8, 2);
            $table->float("four_f_fraction", 8, 2);
            $table->float("five_f_fraction", 8, 2);
            $table->float("six_f_fraction", 8, 2);
            $table->float("seven_f_fraction", 8, 2);
            $table->float("eight_f_fraction", 8, 2);
            $table->float("ten_f_fraction", 8, 2);
            $table->float("twelve_f_fraction", 8, 2);
            $table->float("fourteen_f_fraction", 8, 2);
            $table->float("sixteen_f_fraction_1", 8, 2);
            $table->float("fraction_1", 8, 2);
            $table->float("fraction_2", 8, 2);
            $table->float("fraction_3", 8, 2);
            $table->string("reserved_1016_1025", 2);
            $table->string("reserved_1026_1035", 2);
            $table->float("final_time", 8, 2);
            $table->string("claimed_code", 2);
            $table->string("trainer", 60);
            $table->string("jockey", 50);
            $table->integer("apprentice_wt_allow");
            $table->string("race_type", 4);
            $table->string("age_sex_restrictions", 6);
            $table->string("statebred_flag", 2);
            $table->string("restricted_qualifier_flag", 2);
            $table->integer("favorite_indicator");
            $table->integer("front_bandages_indicator");
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
