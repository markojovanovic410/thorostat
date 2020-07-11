<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horses', function (Blueprint $table) {
            $table->id();
            $table->integer('race_id');
            $table->string('entry', 1);
            $table->string('trainer', 40);
            $table->string('trainer_sts', 4);
            $table->string('trainer_wins', 3);
            $table->string('trainer_places', 3);
            $table->string('trainer_shows', 3);
            $table->string('jockey', 40);
            $table->string('jockey_sts', 4);
            $table->string('jockey_wins', 3);
            $table->string('jockey_places', 3);
            $table->string('jockey_shows', 3);
            $table->string('owner', 40);
            $table->string('owner_silk', 100);
            $table->string('program_number', 3);
            $table->string('morning_line_odds', 6);
            $table->string('horse_name', 40);
            $table->string('year_of_birth', 2);
            $table->string('foaling_month', 2);
            $table->string('horse_gender', 1);
            $table->string('horse_color', 5);
            $table->string('horse_weight', 3);
            $table->string('sire', 25);
            $table->string('sire_sire', 25);
            $table->string('dam', 25);
            $table->string('dam_sire', 25);
            $table->string('breeder', 67);
            $table->string('where_bred', 5);

            $table->string('tdy_dist_sts', 3);
            $table->string('tdy_dist_wins', 2);
            $table->string('tdy_dist_places', 2);
            $table->string('tdy_dist_shows', 2);
            $table->string('tdy_dist_earnings', 8);

            $table->string('tdy_track_sts', 3);
            $table->string('tdy_track_wins', 2);
            $table->string('tdy_track_places', 2);
            $table->string('tdy_track_shows', 2);
            $table->string('tdy_track_earnings', 8);

            $table->string('lifetime_turf_sts', 3);
            $table->string('lifetime_turf_wins', 2);
            $table->string('lifetime_turf_places', 2);
            $table->string('lifetime_turf_shows', 2);
            $table->string('lifetime_turf_earnings', 8);

            $table->string('lifetime_wet_sts', 3);
            $table->string('lifetime_wet_wins', 2);
            $table->string('lifetime_wet_places', 2);
            $table->string('lifetime_wet_shows', 2);
            $table->string('lifetime_wet_earnings', 8);

            $table->string('cur_year', 4);
            $table->string('cur_year_sts', 3);
            $table->string('cur_year_wins', 2);
            $table->string('cur_year_places', 2);
            $table->string('cur_year_shows', 2);
            $table->string('cur_year_earnings', 8);

            $table->string('prev_year', 4);
            $table->string('prev_year_sts', 3);
            $table->string('prev_year_wins', 2);
            $table->string('prev_year_places', 2);
            $table->string('prev_year_shows', 2);
            $table->string('prev_year_earnings', 8);

            $table->string('lifetime_sts', 3);
            $table->string('lifetime_wins', 2);
            $table->string('lifetime_places', 2);
            $table->string('lifetime_shows', 2);
            $table->string('lifetime_earnings', 8);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horses');
    }
}
