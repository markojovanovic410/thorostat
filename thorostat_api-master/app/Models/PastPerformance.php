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
        "days_since_last_match",
        "track_code",
        "race_num",
        "condition",
        "distance",
        "surface",
        "num_of_entrants",
        "post_position",
        "trip_comment",
        "winner_name",
        "second_place_name",
        "third_place_name",
        "winner_weight_carried",
        "second_place_weight_carried",
        "third_place_weight_carried",
        "winner_margin",
        "second_place_margin",
        "third_place_margin",
        "weight",
        "odds",
        "entry",
        "classification",
        "claiming_price",
        "purse",
        "bris_speed_rating",
        "speed_rating",
        "track_variant",
        "trainer",
        "jockey",
        "race_type",
        "restriction",
    ];
}
