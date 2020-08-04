<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    protected $table = 'workout';

    protected $fillable = [
        "race_id",
        "horse_id",
        "date",
        "time",
        "track",
        "distance",
        "track_condition",
        "description",
        "main_inner_track_indicator",
        "works_day_distance",
        "other_works_day_distance",
    ];
}
