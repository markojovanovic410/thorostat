import { Injectable } from '@angular/core';
import { Configuration } from '../_config/_conf';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class UserService {

  private endpoint: string;

  constructor(
    private _conf: Configuration,
    private _http: HttpClient,
  ) {
    this.endpoint = this._conf.baseUrl + 'user/';
  }

  public getByParams<T>(params): Observable<T> {
    return this._http.post<T>(this.endpoint + 'getByParams', params);
  }

  public add<T>(user): Observable<T> {
    return this._http.post<T>(this.endpoint + 'add', user);
  }

  public update<T>(user): Observable<T> {
    return this._http.post<T>(this.endpoint + 'update', user);
  }

  public uploadAvatar<T>(file): Observable<T> {
    return this._http.post<T>(this.endpoint + 'uploadAvatar', file);
  }

  public deleteUser<T>(user_id): Observable<T> {
    return this._http.post<T>(this.endpoint + 'delete', user_id);
  }

}
