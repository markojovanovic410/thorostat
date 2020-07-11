import { RouterModule, Routes } from '@angular/router';
import { NgModule } from '@angular/core';

import { RacesListComponent } from './races-list/races-list.component';
import { SingleRaceComponent } from './single-race/single-race.component';

const routes: Routes = [
  {
    path: '',
    component: RacesListComponent,
  },
  {
    path: 'add',
    component: SingleRaceComponent,
  },
  {
    path: 'edit',
    component: SingleRaceComponent,
    children: [
      {
        path: ':id',
        component: SingleRaceComponent,
      },
    ],
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class RacesRoutingModule {
}
