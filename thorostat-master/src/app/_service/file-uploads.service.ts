import { Injectable } from '@angular/core';
import { Configuration } from '../_config/_conf';
import { HttpClient, HttpRequest } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class FileUploadsService {

  private endpoint: string;

  constructor(
    private _conf: Configuration,
    private _http: HttpClient,
  ) {
    this.endpoint = this._conf.baseUrl + 'upload-csv';
  }

  public upload(file: File): Observable<any> {
    const formData: FormData = new FormData();
    formData.append('file', file);

    const req = new HttpRequest('POST', `${this.endpoint}`, formData, {
      reportProgress: true,
      // responseType: 'json'
    });

    return this._http.request(req);
  }

}
