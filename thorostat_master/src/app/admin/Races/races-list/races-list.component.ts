import { Component, OnInit } from '@angular/core';
import { RaceService } from '../../../_service/race.service';
import { AppData } from '../../../_config/appdata';
import { TrackColorsService } from '../../../_service/track-colors.service';
import { WorkoutService } from '../../../_service/workout.service';
import { HorseService } from '../../../_service/horse.service';

@Component({
  selector: 'races-list',
  templateUrl: './races-list.component.html',
  styleUrls: ['./races-list.component.scss'],
})
export class RacesListComponent implements OnInit {

  math = Math;
  json = JSON;

  // spinners
  loadingTracks = false;
  loadingRaces = false;
  loadingRaceDetails = false;
  loadingEntryDetails = false;

  // filters
  race_date: string;
  track_code: string;
  race_num: string;

  // filter options
  track_codes: any = [];
  race_nums: any = [];
  race_details: any;
  entry_details: any;

  // recommendation
  recommendation: any;

  // Track Basic data
  track_colors: any = [];

  // voided races
  voided_entries: any = [];

  // AppData
  APP_DATA = AppData;

  constructor(
    private _raceService: RaceService,
    private _trackColorsService: TrackColorsService,
    // private _workoutService: WorkoutService,
    private _entryService: HorseService
  ) {
  }

  ngOnInit() {
    this.voided_entries = [];
    this._trackColorsService.getAll<any>().subscribe(
      res => {
        if (res.success) {
          res.track_colors.forEach(el => {
            this.track_colors["c_" + el.track_number] = {
              towel_color: el.towel_color,
              number_color: el.number_color
            };
          });
        }
        console.log(this.track_colors);
      }, err => {
        console.log(false);
      }
    )
  }

  // toggle details info of clicked entry
  toggleEntryDetails(event: any, toggleClass: string, race_id: number, entry_id: number) {
    this.entry_details = {};

    const parent = event.target.closest('.list-item');
    const hasClass = parent.classList.contains(toggleClass);
    if (hasClass) {
      parent.classList.remove(toggleClass);
    } else {
      parent.closest('.list-items').querySelectorAll('.' + toggleClass + '.list-item').forEach(el => 
        el.classList.remove(toggleClass)
      );
      parent.classList.add(toggleClass);

      
      // load entry's details (past performance & workout etc)
      this.loadingEntryDetails = true;
      this._entryService.getDetails<any>({race_id: race_id, horse_id: entry_id}).subscribe(
        res => {
          if (res.success) 
            this.entry_details = res.entry[0];
          console.log(this.entry_details);
          this.loadingEntryDetails = false;
        }, err => {
          console.log(err);
          this.loadingEntryDetails = false;
        }
      );
    }

  }

  /**
   * Event for picking race date
   *  * loading track_codes array
   * 
   * @param evt : selected date
   */
  pickRaceDate(evt) {
    let date = new Date(evt);
    this.race_date = date.getFullYear().toString() + 
                    ('0' + (date.getMonth()+1)).slice(-2) + 
                    ('0' + date.getDate()).slice(-2);
    // console.log(this.race_date);

    this.loadingTracks = true;
    this._raceService.getByParams<any>({race_date: this.race_date, track_code_only: true}).subscribe(
      res => {
        if (res.success) {
          this.track_codes = res.races;
          console.log(this.track_codes);
          this.race_nums = [];
        }
        this.loadingTracks = false;
      }, err => {
        console.log(err);
        this.loadingTracks = false;
      });
  }

  /**
   * Event for Track Code changes
   *  * loading race numbers for chosen track
   * 
   * @param evt : track code
   */
  loadRaces(evt) {
    this.track_code = evt;

    this.loadingRaces = true;
    this._raceService.getByParams<any>({race_date: this.race_date, track_code: this.track_code, race_no_only: true}).subscribe(
      res => {
        if (res.success)
          this.race_nums = res.races;
        this.loadingRaces = false;
      }, err => {
        console.log(err);
        this.loadingRaces = false;
      }
    )
  }

  /**
   * Event for race number changes
   *  * loading race info & race entries
   * 
   * @param evt : race number
   */
  loadRaceHorses(evt) {
    this.race_num = evt;
    this.voided_entries = [];

    this.loadingRaceDetails = true;
    this._raceService.getByParams<any>({race_date: this.race_date, track_code: this.track_code, race_no: this.race_num}).subscribe(
      res => {
        if (res.success) {
          this.race_details = res.races[0];
        }
        this.loadingRaceDetails = false;
      }, err => {
        console.log(err);
        this.loadingRaceDetails = false;
      }
    )
  }

  /**
   * Event for race entry/horse changes
   *  * loading hose details (workout & past-performance)
   * @param evt : chosen horse
   */
  loadHorseDetails(evt) {

  }

  isVoided(program_number) {
    if (this.voided_entries.includes(program_number))
      return true;
    else
      return false;
  }

  voidEntry(program_number) {
    if (this.voided_entries.includes(program_number))
      return;
    this.voided_entries.push(program_number);
  }
  validEntry(program_number) {
    if (this.voided_entries.includes(program_number))
      this.voided_entries = this.voided_entries.filter(function(num) {
        return num !== program_number
    })
  }

  gcd2(a, b) {
    // Greatest common divisor of 2 integers
    if(!b) return b===0 ? a : NaN;
    return this.gcd2(b, a%b);
  }

  // least common multiple
  lcm2(a, b) {
    // Least common multiple of 2 integers
    return a*b / this.gcd2(a, b);
  }

  win_rate(a, b) {
    var rate =  0;
    if (b != 0)
      rate = a * 100 / b;
    return rate;
  }

  formatWorkout(workout) {
    var date = workout.date.slice(4,6) + "-" + workout.date.slice(6,8) + "-" + workout.date.slice(2,4);
    var distance = workout.distance/220 + "f";
    //var time = workout.time.slice(0, 1) == '-' ? workout.time.replace("-", "") + "(*)" : workout.time;
    return date + " " + workout.track + " " + distance + " " + workout.track_condition + " " + workout.time + " " + workout.description + " (" + workout.other_works_day_distance + " / " + workout.works_day_distance + ")";
  }

}
