<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horse extends Model
{
    protected $table = 'horses';

    protected $fillable = [
        "race_id",
        "entry",
        "trainer",
        "trainer_sts",
        "trainer_wins",
        "trainer_places",
        "trainer_shows",
        "jockey",
        "jockey_sts",
        "jockey_wins",
        "jockey_places",
        "jockey_shows",
        "owner",
        "owner_silk",
        "program_number",
        "morning_line_odds",
        "horse_name",
        "year_of_birth",
        "foaling_month",
        "horse_gender",
        "horse_color",
        "horse_weight",
        "sire",
        "sire_sire",
        "dam",
        "dam_sire",
        "breeder",
        "where_bred",

        "tdy_dist_sts",
        "tdy_dist_wins",
        "tdy_dist_places",
        "tdy_dist_shows",
        "tdy_dist_earnings",

        "tdy_track_sts",
        "tdy_track_wins",
        "tdy_track_places",
        "tdy_track_shows",
        "tdy_track_earnings",

        "lifetime_turf_sts",
        "lifetime_turf_wins",
        "lifetime_turf_places",
        "lifetime_turf_shows",
        "lifetime_turf_earnings",

        "lifetime_wet_sts",
        "lifetime_wet_wins",
        "lifetime_wet_places",
        "lifetime_wet_shows",
        "lifetime_wet_earnings",

        "cur_year",
        "cur_year_sts",
        "cur_year_wins",
        "cur_year_places",
        "cur_year_shows",
        "cur_year_earnings",

        "prev_year",
        "prev_year_sts",
        "prev_year_wins",
        "prev_year_places",
        "prev_year_shows",
        "prev_year_earnings",

        "lifetime_sts",
        "lifetime_wins",
        "lifetime_places",
        "lifetime_shows",
        "lifetime_earnings",
    ];

    public function track_color()
    {
        return $this->belongsTo(TrackColor::class, 'program_number', "track_number");
    }

    public function workouts()
    {
        return $this->hasMany(Workout::class, 'horse_id');
    }

    public function past_performances()
    {
        return $this->hasMany(PastPerformance::class, 'horse_id');
    }

}
