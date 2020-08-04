import { NgModule } from '@angular/core';
import {
  NbCardModule,
  NbButtonModule,
  NbInputModule,
  NbIconModule,
  NbTabsetModule,
  NbSelectModule,
  NbDatepickerModule,
} from '@nebular/theme';
import { UiSwitchModule } from 'ngx-ui-switch';

import { ThemeModule } from '../../@theme/theme.module';
import { LogsComponent } from './logs.component';
import { LogComponent } from './log/log.component';
import { LogsRoutingModule } from './logs-routing.module';

@NgModule({
  imports: [
    LogsRoutingModule,
    ThemeModule,

    NbCardModule,
    NbButtonModule,
    NbInputModule,
    NbIconModule,
    NbTabsetModule,
    NbSelectModule,
    NbDatepickerModule,

    UiSwitchModule,
  ],
  declarations: [
    LogsComponent,
    LogComponent,
  ],
})
export class LogsModule { }
