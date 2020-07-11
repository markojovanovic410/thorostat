import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators, FormBuilder } from '@angular/forms';
import { FileUploadsService } from '../../_service/file-uploads.service';
import { HttpEvent, HttpEventType, HttpErrorResponse, HttpResponse } from '@angular/common/http';
import { map, catchError } from 'rxjs/operators';
import { of } from 'rxjs';
import { type } from 'os';

@Component({
  selector: 'import-csv',
  templateUrl: './import-csv.component.html',
  styleUrls: ['./import-csv.component.scss']
})
export class ImportCSVComponent implements OnInit {

  loading = false;
  progressInfos = [];
  message = ''; // progress status

  uploadForm: FormGroup;
  files: FileList;

  constructor(
    private _importService: FileUploadsService,
    private _formBuilder: FormBuilder,
  ) { }

  ngOnInit() {
    this.uploadForm = this._formBuilder.group({
      files: ['', [Validators.required]]
    });

  }

  uploadSingleFile(idx, file) {
    this.progressInfos[idx] = { value: 0, file_name: file.name, message: '' };

    this._importService.upload(file).subscribe(
      event => {
        if (event.type === HttpEventType.UploadProgress) {
          this.progressInfos[idx].value = Math.round(100 * event.loaded / event.total);
          if (idx + 1 == this.files.length) {
            this.message = "Processing uploaded files..";
          }
        } else if (event instanceof HttpResponse) {
          if (idx + 1 == this.files.length) {
            this.loading = false;
            this.message = "Completed!";
          }
        }
      },
      err => {
        console.log(err);
        this.progressInfos[idx].value = 0;
        this.progressInfos[idx].message = 'Could not upload the file:' + file.name;
      });
  }

  onSubmit() {
    this.loading = true;
    this.progressInfos = [];
    this.message = "Uploading Files..";

    // console.log(this.uploadForm.controls);
    for  (var i = 0; i < this.files.length; i++) {
      // formData.append("files[]",  this.files[i]);
      this.uploadSingleFile(i, this.files[i]);
    }
  }

  onFileChange(evt) {
    this.progressInfos = [];
    this.files = evt.target.files;
    // for  (var i =  0; i <  evt.target.files.length; i++)  {
    //   this.files.push(evt.target.files[i]);
    // }
  }

}
