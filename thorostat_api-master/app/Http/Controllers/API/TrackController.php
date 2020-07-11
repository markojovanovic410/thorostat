<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrackCode;
use App\Models\TrackColor;

class TrackController extends Controller
{
    public function track_colors(Request $request)
    {
        $colors = TrackColor::select("id", "track_number", "towel_color", "number_color")->get()->all();
        return response(['success' => true, 'track_colors' => $colors]);
    }

    public function track_codes(Request $request)
    {
        $codes = TrackCode::select("id", "track_code", "track_name", "track_location")->get()->all();
        return response(['success' => true, 'track_codes' => $codes]);
    }

}
