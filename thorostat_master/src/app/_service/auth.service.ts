import { Injectable } from '@angular/core';
import { NbAuthService, NbAuthJWTToken } from '@nebular/auth';
import { BehaviorSubject, Observable } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class AuthService {

  protected user$: BehaviorSubject<any> = new BehaviorSubject(null);

  constructor(
    private _authService: NbAuthService,
  ) {
    this._authService.onTokenChange()
      .subscribe((token: NbAuthJWTToken) => {
        if (token.isValid()) {
          this.publishUser(token.getPayload()); // receive payload from token and assign it to our `user` variable
        }
    });
  }

  private publishUser(user: any) {
    this.user$.next(user);
  }

  onUserChange(): Observable<any> {
    return this.user$;
  }

}
