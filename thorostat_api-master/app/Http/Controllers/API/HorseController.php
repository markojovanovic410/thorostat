<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Horse;
use App\Models\Workout;
use App\Models\PastPerformance;

class HorseController extends Controller
{
    public function getByParams(Request $request)
    {
        $races = Horse::when($request->race_date, function($query) use ($request) {
            $query->where("race_date", $request->race_date);
        })
        ->when($request->track_code, function($query) use ($request) {
            $query->where("track_code", $request->track_code);
        })
        ->when($request->track_code_only, function($query) {
            $query->select("track_code")
                ->groupBy("track_code");
        })
        ->when($request->race_num_only, function($query) {
            $query->select("race_num");
        })
        ->get();

        return response([ 'success' => true, 'entry' => $races]);
    }

    public function getDetails(Request $request)
    {
        if ($request->horse_id)
        {
            $entry = Horse::when($request->horse_id, function($query) use ($request) {
                    $query->where("id", $request->horse_id);
                })
                ->with(["workouts" => function($query) {
                    $query->limit(6)->get();
                }, "past_performances"])
                ->get();
            // when($request->id, function($query) use ($request) {
            //     $query->where("id", $request->id);
            // })
            // ->when($request->race_id, function($query) use ($request) {
            //     $query->where("id", $request->race_id);
            // })
            // ->when($request->horse_id, function($query) use ($request) {
            //     $query->where("id", $request->horse_id);
            // })
            // ->with(["workouts", "past_performances"])
            // ->get();
            
            return response([ 'success' => true, 'entry' => $entry]);
        }
        return response([ 'success' => false, 'message' => 'Failed to get entry details.'], 400);
    }
}
