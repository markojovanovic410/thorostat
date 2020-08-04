<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackColor extends Model
{
    protected $table = 'track_colors';

    protected $fillable = [
        'track_number', 
        'towel_color',
        'number_color'
    ];

}
