import { Component, OnInit } from '@angular/core';
import { NbAuthService } from '@nebular/auth';

@Component({
  selector: 'ngx-profile',
  templateUrl: './profile.component.html',
})
export class ProfileComponent implements OnInit {

  user = {};

  constructor(
    private _auth: NbAuthService
  ) {
    
  }

  ngOnInit() {
    // this._auth.onUserChange()
  }

}
