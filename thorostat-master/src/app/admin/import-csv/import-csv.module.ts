import { NgModule } from '@angular/core';
import { ImportCSVComponent } from './import-csv.component';
import { ThemeModule } from '../../@theme/theme.module';
import { NbCardModule, NbButtonModule, NbInputModule, NbIconModule, NbTabsetModule, NbSelectModule, NbDatepickerModule, NbSpinnerModule, NbProgressBarModule } from '@nebular/theme';

import { ImportCSVRoutingModule } from './import-csv-routing.module';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { BrowserModule } from '@angular/platform-browser';
import { FileUploadsService } from '../../_service/file-uploads.service';
import { Configuration } from '../../_config/_conf';

@NgModule({
  declarations: [
    ImportCSVComponent
  ],
  imports: [
    ImportCSVRoutingModule,
    ThemeModule,
    FormsModule,
    ReactiveFormsModule,

    NbCardModule,
    NbButtonModule,
    NbInputModule,
    NbIconModule,
    NbTabsetModule,
    NbSelectModule,
    NbDatepickerModule,
    NbSpinnerModule,
    NbProgressBarModule,
  ],
  providers: [
    Configuration,
    FileUploadsService
  ]
})
export class ImportCSVModule { }
