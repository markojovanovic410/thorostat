import { NgModule } from '@angular/core';
import {
  NbCardModule,
  NbButtonModule,
  NbInputModule,
  NbIconModule,
  NbTabsetModule,
} from '@nebular/theme';
import { UiSwitchModule } from 'ngx-ui-switch';

import { ThemeModule } from '../../@theme/theme.module';
import { ProfileComponent } from './profile.component';

@NgModule({
  imports: [
    NbCardModule,
    ThemeModule,

    NbButtonModule,
    NbInputModule,
    NbIconModule,
    NbTabsetModule,

    UiSwitchModule,
  ],
  declarations: [
    ProfileComponent,
  ],
})
export class ProfileModule { }
