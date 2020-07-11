<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackCode extends Model
{
    protected $table = 'track_codes';

    protected $fillable = [
        'track_code', 'track_name', 'track_location'
    ];
    
}
