import { RouterModule, Routes } from '@angular/router';
import { NgModule } from '@angular/core';
import { ImportCSVComponent } from './import-csv.component';

const routes: Routes = [
  {
    path: '',
    component: ImportCSVComponent,
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class ImportCSVRoutingModule {
}
