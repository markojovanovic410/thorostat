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
                            "track" => trim($row[0]),
                            "date" => trim($row[1]),
                            "race_no" => intval($row[2])
                        ));

                        $race->entry = $row[4];
                        $race->distance = intval($row[5]);
                        $race->surface = $row[6];
                        $race->reserved_0008 = $row[7];
                        $race->race_type = $row[8];
                        $race->age_sex_restrictions = $row[9];
                        $race->today_race_classification = $row[10];
                        $race->purse = intval($row[11]);
                        $race->claiming_price = intval($row[12]);
                        $race->track_record = floatval($row[14]);
                        $race->race_conditions = $row[15];
                        $race->today_lasix_list = $row[16];
                        $race->today_bute_list = $row[17];
                        $race->today_coupled_list = $row[18];
                        $race->today_mutuel_list = $row[19];
                        $race->simulcast_host_track_code = $row[20];
                        $race->simulcast_host_track_race_no = $row[21];
                        $race->breed_type = $row[22];
                        $race->today_nasal_strip_change = $row[23];
                        $race->today_all_weather_surface_flag = $row[24];
                        $race->reserved_0026 = $row[25];
                        $race->reserved_0027 = $row[26];
                        $race->save();

                        // Store/update HORSE
                        $horse = Horse::firstOrNew(array(
                            "race_id" => $race->id,
                            "post_position" => intval($row[3])
                        ));

                        $horse->claiming_price_horse = intval($row[13]);
                        $horse->today_trainer = $row[27];
                        $horse->today_trainer_sts = intval($row[28]);
                        $horse->today_trainer_wins = intval($row[29]);
                        $horse->today_trainer_places = intval($row[30]);
                        $horse->today_trainer_shows = intval($row[31]);
                        $horse->today_jockey = $row[32];
                        $horse->apprentice_wgt_allow = intval($row[33]);
                        $horse->today_jockey_sts = intval($row[34]);
                        $horse->today_jockey_wins = intval($row[35]);
                        $horse->today_jockey_places = intval($row[36]);
                        $horse->today_jockey_shows = intval($row[37]);
                        $horse->today_owner = $row[38];
                        $horse->owner_silks = $row[39];
                        $horse->main_track_only = $row[40];
                        $horse->reserved_0042 = $row[41];
                        $horse->program_number = $row[42];
                        $horse->line_odds = floatval($row[43]);
                        $horse->horse_name = $row[44];
                        $horse->horse_birth_year = intval($row[45]);
                        $horse->horse_foaling_month = intval($row[46]);
                        $horse->reserved_0048 = $row[47];
                        $horse->horse_sex = $row[48];
                        $horse->horse_color = $row[49];
                        $horse->horse_weight = intval($row[50]);
                        $horse->horse_sire = $row[51];
                        $horse->horse_sire_sire = $row[52];
                        $horse->horse_dam = $row[53];
                        $horse->horse_dam_sire = $row[54];
                        $horse->horse_breeder = $row[55];
                        $horse->horse_state_country = $row[56];
                        $horse->program_post_position = $row[57];
                        $horse->reserved_0059 = $row[58];
                        $horse->reserved_0060 = $row[59];
                        $horse->reserved_0061 = $row[60];
                        $horse->today_medication_new = intval($row[61]);
                        $horse->today_medication_old = intval($row[62]);
                        $horse->equipment_change = intval($row[63]);
                        $horse->horse_lifetime_distance_record_starts = intval($row[64]);
                        $horse->horse_lifetime_distance_record_wins = intval($row[65]);
                        $horse->horse_lifetime_distance_record_places = intval($row[66]);
                        $horse->horse_lifetime_distance_record_shows = intval($row[67]);
                        $horse->horse_lifetime_distance_record_earnings = intval($row[68]);
                        $horse->horse_lifetime_track_record_starts = intval($row[69]);
                        $horse->horse_lifetime_track_record_wins = intval($row[70]);
                        $horse->horse_lifetime_track_record_places = intval($row[71]);
                        $horse->horse_lifetime_track_record_shows = intval($row[72]);
                        $horse->horse_lifetime_track_record_earnings = intval($row[73]);
                        $horse->horse_lifetime_turf_record_starts = intval($row[74]);
                        $horse->horse_lifetime_turf_record_wins = intval($row[75]);
                        $horse->horse_lifetime_turf_record_places = intval($row[76]);
                        $horse->horse_lifetime_turf_record_shows = intval($row[77]);
                        $horse->horse_lifetime_turf_record_earnings = intval($row[78]);
                        $horse->horse_lifetime_wet_record_starts = intval($row[79]);
                        $horse->horse_lifetime_wet_record_wins = intval($row[80]);
                        $horse->horse_lifetime_wet_record_places = intval($row[81]);
                        $horse->horse_lifetime_wet_record_shows = intval($row[82]);
                        $horse->horse_lifetime_wet_record_earnings = intval($row[83]);
                        $horse->horse_current_year_record_year = intval($row[84]);
                        $horse->horse_current_year_record_starts = intval($row[85]);
                        $horse->horse_current_year_record_wins = intval($row[86]);
                        $horse->horse_current_year_record_places = intval($row[87]);
                        $horse->horse_current_year_record_shows = intval($row[88]);
                        $horse->horse_current_year_record_earnings = intval($row[89]);
                        $horse->horse_previous_year_record_year = intval($row[90]);
                        $horse->horse_previous_year_record_starts = intval($row[91]);
                        $horse->horse_previous_year_record_wins = intval($row[92]);
                        $horse->horse_previous_year_record_places = intval($row[93]);
                        $horse->horse_previous_year_record_shows = intval($row[94]);
                        $horse->horse_previous_year_record_earnings = intval($row[95]);
                        $horse->horse_lifetime_record_starts = intval($row[96]);
                        $horse->horse_lifetime_record_wins = intval($row[97]);
                        $horse->horse_lifetime_record_places = intval($row[98]);
                        $horse->horse_lifetime_record_shows = intval($row[99]);
                        $horse->horse_lifetime_record_earnings = intval($row[100]);
                        $horse->bris_run_style_designation = $row[209];
                        $horse->quirin_style_speed_points = intval($row[210]);
                        $horse->reserved_0212 = $row[211];
                        $horse->reserved_0213 = $row[212];
                        $horse->two_f_bris_pace_par_for_level = intval($row[213]);
                        $horse->four_f_bris_pace_par_for_level = intval($row[214]);
                        $horse->six_f_bris_pace_par_for_level = intval($row[215]);
                        $horse->bris_speed_par_for_class_level = intval($row[216]);
                        $horse->bris_late_pace_par_for_level = intval($row[217]);
                        $horse->tj_combo_starts = intval($row[218]);
                        $horse->tj_combo_wins = intval($row[219]);
                        $horse->tj_combo_places = intval($row[220]);
                        $horse->tj_combo_shows = intval($row[221]);
                        $horse->tj_combo_roi = intval($row[222]);
                        $horse->days_since_last_race = intval($row[223]);
                        $horse->complete_race_condition_lines_1 = $row[224];
                        $horse->complete_race_condition_lines_2 = $row[225];
                        $horse->complete_race_condition_lines_3 = $row[226];
                        $horse->complete_race_condition_lines_4 = $row[227];
                        $horse->complete_race_condition_lines_5 = $row[228];
                        $horse->complete_race_condition_lines_6 = $row[229];
                        $horse->lifetime_starts = intval($row[230]);
                        $horse->lifetime_wins = intval($row[231]);
                        $horse->lifetime_places = intval($row[232]);
                        $horse->lifetime_shows = intval($row[233]);
                        $horse->lifetime_earnings = intval($row[234]);
                        $horse->best_bris_speed = intval($row[235]);
                        $horse->reserved_0237 = $row[236];
                        $horse->low_claiming_price = intval($row[237]);
                        $horse->statebred_flag_s = $row[238];
                        $horse->wager_types_this_race_1 = $row[239];
                        $horse->wager_types_this_race_2 = $row[240];
                        $horse->wager_types_this_race_3 = $row[241];
                        $horse->wager_types_this_race_4 = $row[242];
                        $horse->wager_types_this_race_5 = $row[243];
                        $horse->wager_types_this_race_6 = $row[244];
                        $horse->wager_types_this_race_7 = $row[245];
                        $horse->wager_types_this_race_8 = $row[246];
                        $horse->wager_types_this_race_9 = $row[247];
                        $horse->reserved_0249 = $row[248];
                        $horse->reserved_0250 = $row[249];
                        $horse->bris_prime_power_rating = floatval($row[250]);
                        $horse->reserved_0252 = $row[251];
                        $horse->reserved_0253 = $row[252];
                        $horse->reserved_0254 = $row[253];
                        $horse->reserved_0255 = $row[254];
                        $horse->reserved_1146 = $row[1145];
                        $horse->trainer_sts_current_year = intval($row[1146]);
                        $horse->trainer_wins_current_year = intval($row[1147]);
                        $horse->trainer_places_current_year = intval($row[1148]);
                        $horse->trainer_shows_current_year = intval($row[1149]);
                        $horse->trainer_roi_current_year = floatval($row[1150]);
                        $horse->trainer_sts_previous_year = intval($row[1151]);
                        $horse->trainer_wins_previous_year = intval($row[1152]);
                        $horse->trainer_places_previous_year = intval($row[1153]);
                        $horse->trainer_shows_previous_year = intval($row[1154]);
                        $horse->trainer_roi_previous_year = floatval($row[1155]);
                        $horse->jockey_sts_current_year = intval($row[1156]);
                        $horse->jockey_wins_current_year = intval($row[1157]);
                        $horse->jockey_places_current_year = intval($row[1158]);
                        $horse->jockey_shows_current_year = intval($row[1159]);
                        $horse->jockey_roi_current_year = floatval($row[1160]);
                        $horse->jockey_sts_previous_year = intval($row[1161]);
                        $horse->jockey_wins_previous_year = intval($row[1162]);
                        $horse->jockey_places_previous_year = intval($row[1163]);
                        $horse->jockey_shows_previous_year = intval($row[1164]);
                        $horse->jockey_roi_previous_year = floatval($row[1165]);
                        $horse->bris_speed_par_for_class_level_last_races_0 = intval($row[1166]);
                        $horse->bris_speed_par_for_class_level_last_races_1 = intval($row[1167]);
                        $horse->bris_speed_par_for_class_level_last_races_2 = intval($row[1168]);
                        $horse->bris_speed_par_for_class_level_last_races_3 = intval($row[1169]);
                        $horse->bris_speed_par_for_class_level_last_races_4 = intval($row[1170]);
                        $horse->bris_speed_par_for_class_level_last_races_5 = intval($row[1171]);
                        $horse->bris_speed_par_for_class_level_last_races_6 = intval($row[1172]);
                        $horse->bris_speed_par_for_class_level_last_races_7 = intval($row[1173]);
                        $horse->bris_speed_par_for_class_level_last_races_8 = intval($row[1174]);
                        $horse->bris_speed_par_for_class_level_last_races_9 = intval($row[1175]);
                        $horse->sire_stud_fee = intval($row[1176]);
                        $horse->best_bris_speed_fast_track = intval($row[1177]);
                        $horse->best_bris_speed_turf = intval($row[1178]);
                        $horse->best_bris_speed_off_track = intval($row[1179]);
                        $horse->best_bris_speed_distance = intval($row[1180]);
                        $horse->bar_shoe_0 = $row[1181];
                        $horse->bar_shoe_1 = $row[1182];
                        $horse->bar_shoe_2 = $row[1183];
                        $horse->bar_shoe_3 = $row[1184];
                        $horse->bar_shoe_4 = $row[1185];
                        $horse->bar_shoe_5 = $row[1186];
                        $horse->bar_shoe_6 = $row[1187];
                        $horse->bar_shoe_7 = $row[1188];
                        $horse->bar_shoe_8 = $row[1189];
                        $horse->bar_shoe_9 = $row[1190];
                        $horse->company_line_codes_0 = $row[1191];
                        $horse->company_line_codes_1 = $row[1192];
                        $horse->company_line_codes_2 = $row[1193];
                        $horse->company_line_codes_3 = $row[1194];
                        $horse->company_line_codes_4 = $row[1195];
                        $horse->company_line_codes_5 = $row[1196];
                        $horse->company_line_codes_6 = $row[1197];
                        $horse->company_line_codes_7 = $row[1198];
                        $horse->company_line_codes_8 = $row[1199];
                        $horse->company_line_codes_9 = $row[1200];
                        $horse->low_claiming_price_race_0 = intval($row[1201]);
                        $horse->low_claiming_price_race_1 = intval($row[1202]);
                        $horse->low_claiming_price_race_2 = intval($row[1203]);
                        $horse->low_claiming_price_race_3 = intval($row[1204]);
                        $horse->low_claiming_price_race_4 = intval($row[1205]);
                        $horse->low_claiming_price_race_5 = intval($row[1206]);
                        $horse->low_claiming_price_race_6 = intval($row[1207]);
                        $horse->low_claiming_price_race_7 = intval($row[1208]);
                        $horse->low_claiming_price_race_8 = intval($row[1209]);
                        $horse->low_claiming_price_race_9 = intval($row[1210]);
                        $horse->high_claiming_price_race_0 = intval($row[1211]);
                        $horse->high_claiming_price_race_1 = intval($row[1212]);
                        $horse->high_claiming_price_race_2 = intval($row[1213]);
                        $horse->high_claiming_price_race_3 = intval($row[1214]);
                        $horse->high_claiming_price_race_4 = intval($row[1215]);
                        $horse->high_claiming_price_race_5 = intval($row[1216]);
                        $horse->high_claiming_price_race_6 = intval($row[1217]);
                        $horse->high_claiming_price_race_7 = intval($row[1218]);
                        $horse->high_claiming_price_race_8 = intval($row[1219]);
                        $horse->high_claiming_price_race_9 = intval($row[1220]);
                        $horse->auction_price = intval($row[1221]);
                        $horse->sold_at_auction = $row[1222];
                        $horse->reserved_1224 = $row[1223];
                        $horse->reserved_1225 = $row[1224];
                        $horse->reserved_1226 = $row[1225];
                        $horse->reserved_1227 = $row[1226];
                        $horse->reserved_1228 = $row[1227];
                        $horse->reserved_1229 = $row[1228];
                        $horse->reserved_1230 = $row[1229];
                        $horse->reserved_1231 = $row[1230];
                        $horse->reserved_1232 = $row[1231];
                        $horse->reserved_1233 = $row[1232];
                        $horse->reserved_1234 = $row[1233];
                        $horse->reserved_1235 = $row[1234];
                        $horse->reserved_1236 = $row[1235];
                        $horse->reserved_1237 = $row[1236];
                        $horse->reserved_1238 = $row[1237];
                        $horse->reserved_1239 = $row[1238];
                        $horse->reserved_1240 = $row[1239];
                        $horse->reserved_1241 = $row[1240];
                        $horse->reserved_1242 = $row[1241];
                        $horse->reserved_1243 = $row[1242];
                        $horse->reserved_1244 = $row[1243];
                        $horse->reserved_1245 = $row[1244];
                        $horse->reserved_1246 = $row[1245];
                        $horse->reserved_1247 = $row[1246];
                        $horse->reserved_1248 = $row[1247];
                        $horse->reserved_1249 = $row[1248];
                        $horse->reserved_1250 = $row[1249];
                        $horse->reserved_1251 = $row[1250];
                        $horse->reserved_1252 = $row[1251];
                        $horse->reserved_1253 = $row[1252];
                        $horse->code_for_prior_10_starts_0 = $row[1253];
                        $horse->code_for_prior_10_starts_1 = $row[1254];
                        $horse->code_for_prior_10_starts_2 = $row[1255];
                        $horse->code_for_prior_10_starts_3 = $row[1256];
                        $horse->code_for_prior_10_starts_4 = $row[1257];
                        $horse->code_for_prior_10_starts_5 = $row[1258];
                        $horse->code_for_prior_10_starts_6 = $row[1259];
                        $horse->code_for_prior_10_starts_7 = $row[1260];
                        $horse->code_for_prior_10_starts_8 = $row[1261];
                        $horse->code_for_prior_10_starts_9 = $row[1262];
                        $horse->bris_dirt_pedigree_rating = $row[1263];
                        $horse->bris_mud_pedigree_rating = $row[1264];
                        $horse->bris_turf_pedigree_rating = $row[1265];
                        $horse->bris_dist_pedigree_rating = $row[1266];
                        $horse->claimed_from_trainer_switches_1_0 = intval($row[1267]);
                        $horse->claimed_from_trainer_switches_1_1 = intval($row[1268]);
                        $horse->claimed_from_trainer_switches_1_2 = intval($row[1269]);
                        $horse->claimed_from_trainer_switches_1_3 = intval($row[1270]);
                        $horse->claimed_from_trainer_switches_1_4 = intval($row[1271]);
                        $horse->claimed_from_trainer_switches_1_5 = intval($row[1272]);
                        $horse->claimed_from_trainer_switches_1_6 = intval($row[1273]);
                        $horse->claimed_from_trainer_switches_1_7 = intval($row[1274]);
                        $horse->claimed_from_trainer_switches_1_8 = intval($row[1275]);
                        $horse->claimed_from_trainer_switches_1_9 = intval($row[1276]);
                        $horse->claimed_from_trainer_switches_2_0 = intval($row[1277]);
                        $horse->claimed_from_trainer_switches_2_1 = intval($row[1278]);
                        $horse->claimed_from_trainer_switches_2_2 = intval($row[1279]);
                        $horse->claimed_from_trainer_switches_2_3 = intval($row[1280]);
                        $horse->claimed_from_trainer_switches_2_4 = intval($row[1281]);
                        $horse->claimed_from_trainer_switches_2_5 = intval($row[1282]);
                        $horse->claimed_from_trainer_switches_2_6 = intval($row[1283]);
                        $horse->claimed_from_trainer_switches_2_7 = intval($row[1284]);
                        $horse->claimed_from_trainer_switches_2_8 = intval($row[1285]);
                        $horse->claimed_from_trainer_switches_2_9 = intval($row[1286]);
                        $horse->claimed_from_trainer_switches_3_0 = intval($row[1287]);
                        $horse->claimed_from_trainer_switches_3_1 = intval($row[1288]);
                        $horse->claimed_from_trainer_switches_3_2 = intval($row[1289]);
                        $horse->claimed_from_trainer_switches_3_3 = intval($row[1290]);
                        $horse->claimed_from_trainer_switches_3_4 = intval($row[1291]);
                        $horse->claimed_from_trainer_switches_3_5 = intval($row[1292]);
                        $horse->claimed_from_trainer_switches_3_6 = intval($row[1293]);
                        $horse->claimed_from_trainer_switches_3_7 = intval($row[1294]);
                        $horse->claimed_from_trainer_switches_3_8 = intval($row[1295]);
                        $horse->claimed_from_trainer_switches_3_9 = intval($row[1296]);
                        $horse->claimed_from_trainer_switches_4_0 = intval($row[1297]);
                        $horse->claimed_from_trainer_switches_4_1 = intval($row[1298]);
                        $horse->claimed_from_trainer_switches_4_2 = intval($row[1299]);
                        $horse->claimed_from_trainer_switches_4_3 = intval($row[1300]);
                        $horse->claimed_from_trainer_switches_4_4 = intval($row[1301]);
                        $horse->claimed_from_trainer_switches_4_5 = intval($row[1302]);
                        $horse->claimed_from_trainer_switches_4_6 = intval($row[1303]);
                        $horse->claimed_from_trainer_switches_4_7 = intval($row[1304]);
                        $horse->claimed_from_trainer_switches_4_8 = intval($row[1305]);
                        $horse->claimed_from_trainer_switches_4_9 = intval($row[1306]);
                        $horse->claimed_from_trainer_switches_5_0 = intval($row[1307]);
                        $horse->claimed_from_trainer_switches_5_1 = intval($row[1308]);
                        $horse->claimed_from_trainer_switches_5_2 = intval($row[1309]);
                        $horse->claimed_from_trainer_switches_5_3 = intval($row[1310]);
                        $horse->claimed_from_trainer_switches_5_4 = intval($row[1311]);
                        $horse->claimed_from_trainer_switches_5_5 = intval($row[1312]);
                        $horse->claimed_from_trainer_switches_5_6 = intval($row[1313]);
                        $horse->claimed_from_trainer_switches_5_7 = intval($row[1314]);
                        $horse->claimed_from_trainer_switches_5_8 = intval($row[1315]);
                        $horse->claimed_from_trainer_switches_5_9 = intval($row[1316]);
                        $horse->claimed_from_trainer_switches_6_0 = intval($row[1317]);
                        $horse->claimed_from_trainer_switches_6_1 = intval($row[1318]);
                        $horse->claimed_from_trainer_switches_6_2 = intval($row[1319]);
                        $horse->claimed_from_trainer_switches_6_3 = intval($row[1320]);
                        $horse->claimed_from_trainer_switches_6_4 = intval($row[1321]);
                        $horse->claimed_from_trainer_switches_6_5 = intval($row[1322]);
                        $horse->claimed_from_trainer_switches_6_6 = intval($row[1323]);
                        $horse->claimed_from_trainer_switches_6_7 = intval($row[1324]);
                        $horse->claimed_from_trainer_switches_6_8 = intval($row[1325]);
                        $horse->claimed_from_trainer_switches_6_9 = intval($row[1326]);
                        $horse->best_bris_speed_life = intval($row[1327]);
                        $horse->best_bris_speed_most_recent_yr_horse_ran = intval($row[1328]);
                        $horse->best_bris_speed_2nd_most_recent_yr_horse_ran = intval($row[1329]);
                        $horse->best_bris_speed_today_track = intval($row[1330]);
                        $horse->starts_fast_dirt = intval($row[1331]);
                        $horse->wins_fast_dirt = intval($row[1332]);
                        $horse->places_fast_dirt = intval($row[1333]);
                        $horse->shows_fast_dirt = intval($row[1334]);
                        $horse->earnings_fast_dirt = intval($row[1335]);
                        $horse->key_trnr_stat_category_1 = $row[1336];
                        $horse->of_starts_1 = intval($row[1337]);
                        $horse->win_percent_1 = floatval($row[1338]);
                        $horse->in_the_money_percent_1 = floatval($row[1339]);
                        $horse->return_on_investment_1 = floatval($row[1340]);
                        $horse->key_trnr_stat_category_2 = $row[1341];
                        $horse->of_starts_2 = intval($row[1342]);
                        $horse->win_percent_2 = floatval($row[1343]);
                        $horse->in_the_money_percent_2 = floatval($row[1344]);
                        $horse->return_on_investment_2 = floatval($row[1345]);
                        $horse->key_trnr_stat_category_3 = $row[1346];
                        $horse->of_starts_3 = intval($row[1347]);
                        $horse->win_percent_3 = floatval($row[1348]);
                        $horse->in_the_money_percent_3 = floatval($row[1349]);
                        $horse->return_on_investment_3 = floatval($row[1350]);
                        $horse->key_trnr_stat_category_4 = $row[1351];
                        $horse->of_starts_4 = intval($row[1352]);
                        $horse->win_percent_4 = floatval($row[1353]);
                        $horse->in_the_money_percent_4 = floatval($row[1354]);
                        $horse->return_on_investment_4 = floatval($row[1355]);
                        $horse->key_trnr_stat_category_5 = $row[1356];
                        $horse->of_starts_5 = intval($row[1357]);
                        $horse->win_percent_5 = floatval($row[1358]);
                        $horse->in_the_money_percent_5 = floatval($row[1359]);
                        $horse->return_on_investment_5 = floatval($row[1360]);
                        $horse->key_trnr_stat_category_6 = $row[1361];
                        $horse->of_starts_6 = intval($row[1362]);
                        $horse->win_percent_6 = floatval($row[1363]);
                        $horse->in_the_money_percent_6 = floatval($row[1364]);
                        $horse->return_on_investment_6 = floatval($row[1365]);
                        $horse->jky_dis_jky_on_turf_label = $row[1366];
                        $horse->jky_dis_jky_on_turf_starts = intval($row[1367]);
                        $horse->jky_dis_jky_on_turf_wins = intval($row[1368]);
                        $horse->jky_dis_jky_on_turf_places = intval($row[1369]);
                        $horse->jky_dis_jky_on_turf_shows = intval($row[1370]);
                        $horse->jky_dis_jky_on_turf_roi = intval($row[1371]);
                        $horse->jky_dis_jky_on_turf_earnings = intval($row[1372]);
                        $horse->post_times_by_region = $row[1373];
                        $horse->reserved_1375 = $row[1374];
                        $horse->reserved_1376 = $row[1375];
                        $horse->reserved_1377 = $row[1376];
                        $horse->reserved_1378 = $row[1377];
                        $horse->reserved_1379 = $row[1378];
                        $horse->reserved_1380 = $row[1379];
                        $horse->reserved_1381 = $row[1380];
                        $horse->reserved_1382 = $row[1381];
                        $horse->extended_start_comment_0 = $row[1382];
                        $horse->extended_start_comment_1 = $row[1383];
                        $horse->extended_start_comment_2 = $row[1384];
                        $horse->extended_start_comment_3 = $row[1385];
                        $horse->extended_start_comment_4 = $row[1386];
                        $horse->extended_start_comment_5 = $row[1387];
                        $horse->extended_start_comment_6 = $row[1388];
                        $horse->extended_start_comment_7 = $row[1389];
                        $horse->extended_start_comment_8 = $row[1390];
                        $horse->extended_start_comment_9 = $row[1391];
                        $horse->sealed_track_indicator_0 = $row[1392];
                        $horse->sealed_track_indicator_1 = $row[1393];
                        $horse->sealed_track_indicator_2 = $row[1394];
                        $horse->sealed_track_indicator_3 = $row[1395];
                        $horse->sealed_track_indicator_4 = $row[1396];
                        $horse->sealed_track_indicator_5 = $row[1397];
                        $horse->sealed_track_indicator_6 = $row[1398];
                        $horse->sealed_track_indicator_7 = $row[1399];
                        $horse->sealed_track_indicator_8 = $row[1400];
                        $horse->sealed_track_indicator_9 = $row[1401];
                        $horse->prev_all_weather_surface_flag_0 = $row[1402];
                        $horse->prev_all_weather_surface_flag_1 = $row[1403];
                        $horse->prev_all_weather_surface_flag_2 = $row[1404];
                        $horse->prev_all_weather_surface_flag_3 = $row[1405];
                        $horse->prev_all_weather_surface_flag_4 = $row[1406];
                        $horse->prev_all_weather_surface_flag_5 = $row[1407];
                        $horse->prev_all_weather_surface_flag_6 = $row[1408];
                        $horse->prev_all_weather_surface_flag_7 = $row[1409];
                        $horse->prev_all_weather_surface_flag_8 = $row[1410];
                        $horse->prev_all_weather_surface_flag_9 = $row[1411];
                        $horse->tj_combo_starts_meet = intval($row[1412]);
                        $horse->tj_combo_winss_meet = intval($row[1413]);
                        $horse->tj_combo_places_meet = intval($row[1414]);
                        $horse->tj_combo_shows_meet = intval($row[1415]);
                        $horse->tj_combo_roi_meet = intval($row[1416]);
                        $horse->post_time_pacific_military_time = $row[1417];
                        $horse->equibase_abbrev_race_conditions_0 = $row[1418];
                        $horse->equibase_abbrev_race_conditions_1 = $row[1419];
                        $horse->equibase_abbrev_race_conditions_2 = $row[1420];
                        $horse->equibase_abbrev_race_conditions_3 = $row[1421];
                        $horse->equibase_abbrev_race_conditions_4 = $row[1422];
                        $horse->equibase_abbrev_race_conditions_5 = $row[1423];
                        $horse->equibase_abbrev_race_conditions_6 = $row[1424];
                        $horse->equibase_abbrev_race_conditions_7 = $row[1425];
                        $horse->equibase_abbrev_race_conditions_8 = $row[1426];
                        $horse->equibase_abbrev_race_conditions_9 = $row[1427];
                        $horse->today_eqb_abbrev_race_conditions = $row[1428];
                        $horse->save();

                        // Store/update HORSE WORKOUT
                        for($idx = 0; $idx < 12; $idx++)
                        {
                            if ($row[101 + $idx] == '')
                                break;
                            
                            $workout = Workout::firstOrNew(array(
                                "race_id" => $race->id,
                                "horse_id" => $horse->id,
                                "date" => trim($row[101 + $idx]),
                                "track" => trim($row[125 + $idx])
                            ));

                            $workout->time = floatval($row[113 + $idx]);
                            $workout->distance = intval($row[137 + $idx]);
                            $workout->track_condition = $row[149 + $idx];
                            $workout->description = $row[161 + $idx];
                            $workout->main_inner_track_indicator = $row[173 + $idx];
                            $workout->works_day_distance = intval($row[185 + $idx]);
                            $workout->other_works_day_distance = intval($row[197 + $idx]);
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
                                "race_date" => trim($row[255 + $idx]),
                                "track_code" => trim($row[275 + $idx]),
                                "race_no" => intval($row[295 + $idx])
                            ));

                            $performance->days_since_previous_race = intval($row[265 + $idx]);
                            $performance->bris_track_code = $row[285 + $idx];
                            $performance->track_condition = $row[305 + $idx];
                            $performance->distance = intval($row[315 + $idx]);
                            $performance->surface = $row[325 + $idx];
                            $performance->special_chute_indicator = $row[335 + $idx];
                            $performance->entrants = intval($row[345 + $idx]);
                            $performance->post_position = intval($row[355 + $idx]);
                            $performance->equipment = $row[365 + $idx];
                            $performance->race_name_previous_races = $row[375 + $idx];
                            $performance->medication = intval($row[385 + $idx]);
                            $performance->trip_comment = $row[395 + $idx];
                            $performance->winner_name = $row[405 + $idx];
                            $performance->second_place_finishers_name = $row[415 + $idx];
                            $performance->third_place_finishers_name = $row[425 + $idx];
                            $performance->winner_weight_carried = intval($row[435 + $idx]);
                            $performance->second_place_weight_carried = intval($row[445 + $idx]);
                            $performance->third_place_weight_carried = intval($row[455 + $idx]);
                            $performance->winner_margin = floatval($row[465 + $idx]);
                            $performance->second_place_margin = floatval($row[475 + $idx]);
                            $performance->third_place_margin = floatval($row[485 + $idx]);
                            $performance->alternate_extra_comment_line = $row[495 + $idx];
                            $performance->weight = intval($row[505 + $idx]);
                            $performance->odds = floatval($row[515 + $idx]);
                            $performance->entry = $row[525 + $idx];
                            $performance->race_classification = $row[535 + $idx];
                            $performance->claiming_price = intval($row[545 + $idx]);
                            $performance->purse = intval($row[555 + $idx]);
                            $performance->start_call_position = intval($row[565 + $idx]);
                            $performance->first_call_position = intval($row[575 + $idx]);
                            $performance->second_call_position = intval($row[585 + $idx]);
                            $performance->gate_call_position = intval($row[595 + $idx]);
                            $performance->stretch_position = intval($row[605 + $idx]);
                            $performance->finish_position = intval($row[615 + $idx]);
                            $performance->money_position = intval($row[625 + $idx]);
                            $performance->start_call_btnlngths_ldr_margin = floatval($row[635 + $idx]);
                            $performance->start_call_btnlngths_only = floatval($row[645 + $idx]);
                            $performance->first_call_btnlngths_ldr_margin = floatval($row[655 + $idx]);
                            $performance->first_call_btnlngths_only = floatval($row[665 + $idx]);
                            $performance->second_call_btnlngths_ldr_margin = floatval($row[675 + $idx]);
                            $performance->second_call_btnlngths_only = floatval($row[685 + $idx]);
                            $performance->bris_race_shape_1st_call = intval($row[695 + $idx]);
                            $performance->reserved_0706_0715 = $row[705 + $idx];
                            $performance->stretch_btnlngths_ldr_margin = floatval($row[715 + $idx]);
                            $performance->stretch_btnlngths_only = floatval($row[725 + $idx]);
                            $performance->finish_btnlngths_wnrs_margin = floatval($row[735 + $idx]);
                            $performance->finish_btnlngths_only = floatval($row[745 + $idx]);
                            $performance->bris_race_shape_2nd_call = intval($row[755 + $idx]);
                            $performance->bris_2f_pace_fig = intval($row[765 + $idx]);
                            $performance->bris_4f_pace_fig = intval($row[775 + $idx]);
                            $performance->bris_6f_pace_fig = intval($row[785 + $idx]);
                            $performance->bris_8f_pace_fig = intval($row[795 + $idx]);
                            $performance->bris_10f_pace_fig = intval($row[805 + $idx]);
                            $performance->bris_last_pace_fig = intval($row[815 + $idx]);
                            $performance->reserved_0826_0835 = $row[825 + $idx];
                            $performance->reserved_0836_0845 = $row[835 + $idx];
                            $performance->bris_speed_rating = intval($row[845 + $idx]);
                            $performance->speed_rating = intval($row[855 + $idx]);
                            $performance->track_variant = intval($row[865 + $idx]);
                            $performance->one_f_fraction = floatval($row[875 + $idx]);
                            $performance->three_f_fraction = floatval($row[885 + $idx]);
                            $performance->four_f_fraction = floatval($row[895 + $idx]);
                            $performance->five_f_fraction = floatval($row[905 + $idx]);
                            $performance->six_f_fraction = floatval($row[915 + $idx]);
                            $performance->seven_f_fraction = floatval($row[925 + $idx]);
                            $performance->eight_f_fraction = floatval($row[935 + $idx]);
                            $performance->ten_f_fraction = floatval($row[945 + $idx]);
                            $performance->twelve_f_fraction = floatval($row[955 + $idx]);
                            $performance->fourteen_f_fraction = floatval($row[965 + $idx]);
                            $performance->sixteen_f_fraction_1 = floatval($row[975 + $idx]);
                            $performance->fraction_1 = floatval($row[985 + $idx]);
                            $performance->fraction_2 = floatval($row[995 + $idx]);
                            $performance->fraction_3 = floatval($row[1005 + $idx]);
                            $performance->reserved_1016_1025 = $row[1015 + $idx];
                            $performance->reserved_1026_1035 = $row[1025 + $idx];
                            $performance->final_time = floatval($row[1035 + $idx]);
                            $performance->claimed_code = $row[1045 + $idx];
                            $performance->trainer = $row[1055 + $idx];
                            $performance->jockey = $row[1065 + $idx];
                            $performance->apprentice_wt_allow = intval($row[1075 + $idx]);
                            $performance->race_type = $row[1085 + $idx];
                            $performance->age_sex_restrictions = $row[1095 + $idx];
                            $performance->statebred_flag = $row[1105 + $idx];
                            $performance->restricted_qualifier_flag = $row[1115 + $idx];
                            $performance->favorite_indicator = intval($row[1125 + $idx]);
                            $performance->front_bandages_indicator = intval($row[1135 + $idx]);
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
