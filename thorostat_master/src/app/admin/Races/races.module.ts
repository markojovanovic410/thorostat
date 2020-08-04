import { NgModule } from '@angular/core';

import { RacesListComponent } from './races-list/races-list.component';
import { SingleRaceComponent } from './single-race/single-race.component';
import { ThemeModule } from '../../@theme/theme.module';
import { 
  NbCardModule, 
  NbButtonModule, 
  NbInputModule, 
  NbIconModule, 
  NbTabsetModule, 
  NbSelectModule, 
  NbDatepickerModule,
  NbAlertModule,
  NbSpinnerModule
} from '@nebular/theme';
import { UiSwitchModule } from 'ngx-ui-switch';
import { RacesRoutingModule } from './races-routing.module';
import { ReactiveFormsModule } from '@angular/forms';
import { Configuration } from '../../_config/_conf';
import { RaceService } from '../../_service/race.service';
import { TrackColorsService } from '../../_service/track-colors.service';
import { WorkoutService } from '../../_service/workout.service';
import { HorseService } from '../../_service/horse.service';

@NgModule({
  declarations: [
    RacesListComponent,
    SingleRaceComponent
  ],
  imports: [
    RacesRoutingModule,
    ThemeModule,
    ReactiveFormsModule,
    
    NbCardModule,
    NbButtonModule,
    NbInputModule,
    NbIconModule,
    NbTabsetModule,
    NbSelectModule,
    NbDatepickerModule,
    NbAlertModule,
    NbSpinnerModule,

    UiSwitchModule
  ],
  providers: [
    Configuration,
    RaceService,
    TrackColorsService,
    WorkoutService,
    HorseService,
  ]
})
export class RacesModule { }
