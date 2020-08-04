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
            $query->where("date", $request->race_date);
        })
        ->when($request->track_code, function($query) use ($request) {
            $query->where("track", $request->track_code);
        })
        ->when($request->race_no, function($query) use ($request) {
            $query->where("race_no", $request->race_no)
                ->with(['horses' => function($query) {
                    $query->with(['track_color']);
                }, 'track']);
        })
        ->when($request->track_code_only, function($query) {
            $query->select("track")
                ->groupBy("track");
        })
        ->when($request->race_no_only, function($query) {
            $query->select("race_no");
        })
        ->get();

        return response(['success' => true, 'races' => $races]);
    }


}
