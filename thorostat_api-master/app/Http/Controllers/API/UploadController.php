<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Race;
use App\Models\Horse;
use App\Models\Workout;
use App\Models\PastPerformance;
use Validator;

class UploadController extends Controller
{
    public function uploadCSV(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'files' => 'nullable',
        //     'files.*' => 'mimes:csv,txt,drf'
        // ]);
        $validator = Validator::make($request->all(), [
            'file' => 'mimes:csv,txt,drf'
        ]);

        if ($validator->passes())
        {
            // if ($request->has('files') && $request->files != "") {
            if ($request->has('file') && $request->file != "") {
                $file = $request->file('file');

                // foreach($files as $file) {
                    $path = $file->getRealPath();
                    $data = array_map('str_getcsv', file($path));
                    
                    foreach ($data as $row) {
                        // Store/update RACE
                        $race = Race::firstOrNew(array(
                            "track_code" => trim($row[0]),
                            "race_date" => trim($row[1]),
                            "race_num" => trim($row[2])
                        ));

                        $race->distance = $row[5];
                        $race->surface = $row[6];
                        $race->race_type = $row[8];
                        $race->restriction = $row[9];
                        $race->classification = $row[10];
                        $race->purse = $row[11];
                        $race->claiming_price = $row[12];
                        $race->track_record = $row[14];
                        $race->race_condition = $row[15];
                        $race->save();

                        // Store/update HORSE
                        $horse = Horse::firstOrNew(array(
                            "race_id" => $race->id,
                            "program_number" => $row[42]
                        ));

                        $horse->entry = $row[4];
                        $horse->trainer = $row[27];
                        $horse->trainer_sts = $row[28];
                        $horse->trainer_wins = $row[29];
                        $horse->trainer_places = $row[30];
                        $horse->trainer_shows = $row[31];
                        $horse->jockey = $row[32];
                        $horse->jockey_sts = $row[34];
                        $horse->jockey_wins = $row[35];
                        $horse->jockey_places = $row[36];
                        $horse->jockey_shows = $row[37];
                        $horse->owner = $row[38];
                        $horse->owner_silk = $row[39];
                        $horse->morning_line_odds = $row[43];
                        $horse->horse_name = $row[44];
                        $horse->year_of_birth = $row[45];
                        $horse->foaling_month = $row[46];
                        $horse->horse_gender = $row[48];
                        $horse->horse_color = $row[49];
                        $horse->horse_weight = $row[50];
                        $horse->sire = $row[51];
                        $horse->sire_sire = $row[52];
                        $horse->dam = $row[53];
                        $horse->dam_sire = $row[54];
                        $horse->breeder = $row[55];
                        $horse->where_bred = $row[57];

                        $horse->tdy_dist_sts = $row[64];
                        $horse->tdy_dist_wins = $row[65];
                        $horse->tdy_dist_places = $row[66];
                        $horse->tdy_dist_shows = $row[67];
                        $horse->tdy_dist_earnings = $row[68];

                        $horse->tdy_track_sts = $row[69];
                        $horse->tdy_track_wins = $row[70];
                        $horse->tdy_track_places = $row[71];
                        $horse->tdy_track_shows = $row[72];
                        $horse->tdy_track_earnings = $row[73];

                        $horse->lifetime_turf_sts = $row[74];
                        $horse->lifetime_turf_wins = $row[75];
                        $horse->lifetime_turf_places = $row[76];
                        $horse->lifetime_turf_shows = $row[77];
                        $horse->lifetime_turf_earnings = $row[78];

                        $horse->lifetime_wet_sts = $row[79];
                        $horse->lifetime_wet_wins = $row[80];
                        $horse->lifetime_wet_places = $row[81];
                        $horse->lifetime_wet_shows = $row[82];
                        $horse->lifetime_wet_earnings = $row[83];

                        $horse->cur_year = $row[84];
                        $horse->cur_year_sts = $row[85];
                        $horse->cur_year_wins = $row[86];
                        $horse->cur_year_places = $row[87];
                        $horse->cur_year_shows = $row[88];
                        $horse->cur_year_earnings = $row[89];

                        $horse->prev_year = $row[90];
                        $horse->prev_year_sts = $row[91];
                        $horse->prev_year_wins = $row[92];
                        $horse->prev_year_places = $row[93];
                        $horse->prev_year_shows = $row[94];
                        $horse->prev_year_earnings = $row[95];

                        $horse->lifetime_sts = $row[96];
                        $horse->lifetime_wins = $row[97];
                        $horse->lifetime_places = $row[98];
                        $horse->lifetime_shows = $row[99];
                        $horse->lifetime_earnings = $row[100];
                        $horse->save();

                        // Store/update HORSE WORKOUT
                        for($idx = 0; $idx < 12; $idx++)
                        {
                            if ($row[101 + $idx] == '')
                                break;
                            
                            $workout = Workout::firstOrNew(array(
                                "race_id" => $race->id,
                                "horse_id" => $horse->id,
                                "date" => $row[101 + $idx],
                                "track_code" => $row[125 + $idx]
                            ));

                            $workout->time = $row[113 + $idx];
                            $workout->distance = $row[137 + $idx];
                            $workout->condition = $row[149 + $idx];
                            $workout->description = $row[161 + $idx];
                            $workout->indicator = $row[173 + $idx];
                            $workout->number_of_workout = $row[185 + $idx];
                            $workout->rank_among_others = $row[197 + $idx];
                            $workout->save();
                        }

                        // Store/update HORSE PAST PERFORMANCE
                        for ($idx = 0; $idx < 10; $idx++)
                        {
                            // check if date exist, otherwise ignore
                            if ($row[255 + $idx] == '')
                                break;
                            
                            $performance = PastPerformance::firstOrNew(array(
                                "race_id" => $race->id,
                                "horse_id" => $horse->id,
                                "race_date" => $row[255 + $idx],
                                "track_code" => $row[275 + $idx],
                                "race_num" => $row[295 + $idx]
                            ));

                            $performance->days_since_last_match = $row[265 + $idx];
                            $performance->condition = $row[305 + $idx];
                            $performance->distance = $row[315 + $idx];
                            $performance->surface = $row[325 + $idx];
                            $performance->num_of_entrants = $row[345 + $idx];
                            $performance->post_position = $row[355 + $idx];
                            $performance->trip_comment = $row[395 + $idx];
                            $performance->winner_name = $row[405 + $idx];
                            $performance->second_place_name = $row[415 + $idx];
                            $performance->third_place_name = $row[425 + $idx];
                            $performance->winner_weight_carried = $row[435 + $idx];
                            $performance->second_place_weight_carried = $row[445 + $idx];
                            $performance->third_place_weight_carried = $row[455 + $idx];
                            $performance->winner_margin = $row[465 + $idx];
                            $performance->second_place_margin = $row[475 + $idx];
                            $performance->third_place_margin = $row[485 + $idx];
                            $performance->weight = $row[505 + $idx];
                            $performance->odds = $row[515 + $idx];
                            $performance->entry = $row[525 + $idx];
                            $performance->classification = $row[535 + $idx];
                            $performance->claiming_price = $row[545 + $idx];
                            $performance->purse = $row[555 + $idx];
                            $performance->bris_speed_rating = $row[845 + $idx];
                            $performance->speed_rating = $row[855 + $idx];
                            $performance->track_variant = $row[865 + $idx];
                            $performance->trainer = $row[1055 + $idx];
                            $performance->jockey = $row[1065 + $idx];
                            $performance->race_type = $row[1085 + $idx];
                            $performance->restriction = $row[1095 + $idx];
                            $performance->save();
                        }
                    }
                // }

                return response(['success' => true, 'message' => "Success"]);
            }
        }

        return response(['success' => false, 'message' => "Something went wrong! Try again."]);
    }
}
