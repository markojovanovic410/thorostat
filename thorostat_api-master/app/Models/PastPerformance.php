<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PastPerformance extends Model
{
    protected $table = 'past_performance';

    protected $fillable = [
        "race_id",
        "horse_id",
        "race_date",
        "days_since_previous_race",
        "track_code",
        "bris_track_code",
        "race_no",
        "track_condition",
        "distance",
        "surface",
        "special_chute_indicator",
        "entrants",
        "post_position",
        "equipment",
        "race_name_previous_races",
        "medication",
        "trip_comment",
        "winner_name",
        "second_place_finishers_name",
        "third_place_finishers_name",
        "winner_weight_carried",
        "second_place_weight_carried",
        "third_place_weight_carried",
        "winner_margin",
        "second_place_margin",
        "third_place_margin",
        "alternate_extra_comment_line",
        "weight",
        "odds",
        "entry",
        "race_classification",
        "claiming_price",
        "purse",
        "start_call_position",
        "first_call_position",
        "second_call_position",
        "gate_call_position",
        "stretch_position",
        "finish_position",
        "money_position",
        "start_call_btnlngths_ldr_margin",
        "start_call_btnlngths_only",
        "first_call_btnlngths_ldr_margin",
        "first_call_btnlngths_only",
        "second_call_btnlngths_ldr_margin",
        "second_call_btnlngths_only",
        "bris_race_shape_1st_call",
        "reserved_0706_0715",
        "stretch_btnlngths_ldr_margin",
        "stretch_btnlngths_only",
        "finish_btnlngths_wnrs_margin",
        "finish_btnlngths_only",
        "bris_race_shape_2nd_call",
        "bris_2f_pace_fig",
        "bris_4f_pace_fig",
        "bris_6f_pace_fig",
        "bris_8f_pace_fig",
        "bris_10f_pace_fig",
        "bris_last_pace_fig",
        "reserved_0826_0835",
        "reserved_0836_0845",
        "bris_speed_rating",
        "speed_rating",
        "track_variant",
        "one_f_fraction",
        "three_f_fraction",
        "four_f_fraction",
        "five_f_fraction",
        "six_f_fraction",
        "seven_f_fraction",
        "eight_f_fraction",
        "ten_f_fraction",
        "twelve_f_fraction",
        "fourteen_f_fraction",
        "sixteen_f_fraction_1",
        "fraction_1",
        "fraction_2",
        "fraction_3",
        "reserved_1016_1025",
        "reserved_1026_1035",
        "final_time",
        "claimed_code",
        "trainer",
        "jockey",
        "apprentice_wt_allow",
        "race_type",
        "age_sex_restrictions",
        "statebred_flag",
        "restricted_qualifier_flag",
        "favorite_indicator",
        "front_bandages_indicator",
    ];
}
