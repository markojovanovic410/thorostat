<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    protected $table = 'races';

    protected $fillable = [
        "race_date",
        "track_code",
        "race_num",
        "distance",
        "surface",
        "race_type",
        "restriction",
        "classification",
        "purse",
        "claiming_price",
        "track_record",
        "race_condition",
    ];

    public function entries()
    {
        return $this->hasMany(Horse::class, 'race_id');
    }

    public function track()
    {
        return $this->belongsTo(TrackCode::class, 'track_code', "track_code");
    }
}
