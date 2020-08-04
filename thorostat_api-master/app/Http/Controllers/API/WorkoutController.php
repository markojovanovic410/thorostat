<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Workout;

class WorkoutController extends Controller
{
    public function getByParams(Request $request)
    {
        $workouts = Workout::when($request->id, function($query) use ($request) {
            $query->where("id", $request->id);
        })
        ->when($request->race_id, function($query) use ($request) {
            $query->where("race_id", $request->race_id);
        })
        ->when($request->horse_id, function($query) use ($request) {
            $query->where("horse_id", $request->horse_id);
        })
        ->limit(6)
        ->get();

        return response([ 'success' => true, 'workouts' => $workouts]);
    }
}
