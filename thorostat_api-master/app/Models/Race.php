<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    protected $table = 'races';

    protected $fillable = [
        "track",
        "date",
        "race_no",
        "entry",
        "distance",
        "surface",
        "reserved_0008",
        "race_type",
        "age_sex_restrictions",
        "today_race_classification",
        "purse",
        "claiming_price",
        "track_record",
        "race_conditions",
        "today_lasix_list",
        "today_bute_list",
        "today_coupled_list",
        "today_mutuel_list",
        "simulcast_host_track_code",
        "simulcast_host_track_race_no",
        "breed_type",
        "today_nasal_strip_change",
        "today_all_weather_surface_flag",
        "reserved_0026",
        "reserved_0027",
    ];

    public function horses()
    {
        return $this->hasMany(Horse::class, 'race_id');
    }

    public function track()
    {
        return $this->belongsTo(TrackCode::class, 'track', "track");
    }
}
