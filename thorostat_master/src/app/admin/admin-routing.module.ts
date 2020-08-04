import { RouterModule, Routes } from '@angular/router';
import { NgModule } from '@angular/core';

import { AdminComponent } from './admin.component';
import { DashboardComponent } from './dashboard/dashboard.component';
import { ProfileComponent } from './profile/profile.component';
import { SettingsComponent } from './settings/settings.component';
import { AuthGuard } from '../_helper/auth.guard';
import { AppData } from '../_config/appdata';

const routes: Routes = [{
  path: '',
  component: AdminComponent,
  canActivate: [AuthGuard],
  data: {redirectTo: "/auth/login"},
  children: [
    {
      path: 'profile',
      component: ProfileComponent,
    },
    {
      path: 'dashboard',
      component: DashboardComponent,
    },
    {
      path: 'races',
      loadChildren: () => import('./races/races.module')
        .then(m => m.RacesModule),
    },
    {
      path: 'import_csv',
      loadChildren: () => import('./import-csv/import-csv.module')
      .then(m => m.ImportCSVModule),
    },
    {
      path: 'settings',
      component: SettingsComponent,
    },
    {
      path: 'users',
      loadChildren: () => import('./users/users.module')
        .then(m => m.UsersModule),
    },
    {
      path: 'logs',
      loadChildren: () => import('./logs/logs.module')
        .then(m => m.LogsModule),
    },
    // {
    //   path: '',
    //   redirectTo: 'races',
    //   pathMatch: 'full',
    // },
    // {
    //   path: '**',
    //   redirectTo: 'races'
    // }
  ],
}];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class AdminRoutingModule {
}
