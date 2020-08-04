import { Injectable } from '@angular/core';
import { Configuration } from '../_config/_conf';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class HorseService {

  private endpoint: string;

  constructor(
    private _conf: Configuration,
    private _http: HttpClient,
  ) {
    this.endpoint = this._conf.baseUrl + 'entry/';
  }

  public getByParams<T>(params): Observable<T> {
    return this._http.post<T>(this.endpoint + 'getByParams', params);
  }

  public getDetails<T>(params): Observable<T> {
    return this._http.post<T>(this.endpoint + 'getDetails', params);
  }

}
