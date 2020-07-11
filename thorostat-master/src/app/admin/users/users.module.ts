import { NgModule } from '@angular/core';
import {
  NbCardModule,
  NbButtonModule,
  NbInputModule,
  NbIconModule,
  NbTabsetModule,
  NbSelectModule,
  NbSpinnerModule,
  NbDialogService,
  NbDialogModule,
} from '@nebular/theme';
import { UiSwitchModule } from 'ngx-ui-switch';

import { ThemeModule } from '../../@theme/theme.module';
import { UsersComponent } from './users.component';
import { UserComponent } from './user/user.component';
import { UsersRoutingModule } from './users-routing.module';
import { UserService } from '../../_service/user.service';
import { Configuration } from '../../_config/_conf';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

@NgModule({
  imports: [
    UsersRoutingModule,
    ThemeModule,
    ReactiveFormsModule,

    NbCardModule,
    NbButtonModule,
    NbInputModule,
    NbIconModule,
    NbTabsetModule,
    NbSelectModule,
    NbSpinnerModule,
    NbDialogModule,

    UiSwitchModule,
  ],
  declarations: [
    UsersComponent,
    UserComponent,
  ],
  providers: [
    UserService,
    NbDialogService,
    Configuration
  ]
})
export class UsersModule { }
