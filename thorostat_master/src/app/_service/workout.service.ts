import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Configuration } from '../_config/_conf';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class WorkoutService {

  private endpoint: string;

  constructor(
    private _conf: Configuration,
    private _http: HttpClient,
  ) {
    this.endpoint = this._conf.baseUrl + 'workout/';
  }

  public getByParams<T>(params): Observable<T> {
    return this._http.post<T>(this.endpoint + 'getByParams', params);
  }

}
