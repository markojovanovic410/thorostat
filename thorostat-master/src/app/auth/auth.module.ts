import { NgModule } from '@angular/core';
import { AuthRoutingModule } from './auth-routing.module';
import { NbAlertModule, NbInputModule, NbButtonModule, NbCheckboxModule, NbLayoutModule, NbIconModule } from '@nebular/theme';
import { LayoutComponent } from './layout/layout.component';
import { LoginComponent } from './login/login.component';
import { LogoutComponent } from './logout/logout.component';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { RouterModule } from '@angular/router';
import { NbAuthModule } from '@nebular/auth';
import { RegisterComponent } from './register/register.component';

@NgModule({
  declarations: [
    LayoutComponent,
    LoginComponent,
    LogoutComponent,
    RegisterComponent
  ],
  imports: [
    CommonModule,
    FormsModule,
    RouterModule,
    
    NbAlertModule,
    NbInputModule,
    NbButtonModule,
    NbCheckboxModule,
    NbLayoutModule,
    NbIconModule,
    
    AuthRoutingModule,
    NbAuthModule,
  ]
})
export class AuthModule { }
