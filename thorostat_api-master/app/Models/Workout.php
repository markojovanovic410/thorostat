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
        "track_code",
        "distance",
        "condition",
        "description",
        "indicator",
        "number_of_workout",
        "rank_among_others",
    ];
}
