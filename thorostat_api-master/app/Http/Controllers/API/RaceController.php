<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Race;

class RaceController extends Controller
{
    public function getByParams(Request $request)
    {
        $races = Race::when($request->race_date, function($query) use ($request) {
            $query->where("race_date", $request->race_date);
        })
        ->when($request->track_code, function($query) use ($request) {
            $query->where("track_code", $request->track_code);
        })
        ->when($request->race_num, function($query) use ($request) {
            $query->where("race_num", $request->race_num)
                ->with(['entries' => function($query) {
                    $query->with(['track_color']);
                }, 'track']);
        })
        ->when($request->track_code_only, function($query) {
            $query->select("track_code")
                ->groupBy("track_code")
                ->with(['track']);
        })
        ->when($request->race_num_only, function($query) {
            $query->select("race_num");
        })
        ->get();

        return response([ 'success' => true, 'races' => $races]);
    }


}
