import { Component, OnInit } from '@angular/core';
import { UserService } from '../../../_service/user.service';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { AppData } from '../../../_config/appdata';
import { Router, ActivatedRoute } from '@angular/router';
import { Configuration } from '../../../_config/_conf';

@Component({
  selector: 'ngx-user',
  templateUrl: './user.component.html',
  styleUrls: ['./user.component.scss'],
})
export class UserComponent implements OnInit {

  objectKeys = Object.keys;
  avatar_base_url = "";
  avatar = "";

  user_id: number;
  user_types = AppData.user_type;
  user_form: FormGroup;

  loadingUser = false;
  uploadingAvatar = false;

  errors: any;

  constructor(
    private _userService: UserService,
    private _formBuilder: FormBuilder,
    private _router: Router,
    private _route: ActivatedRoute,
    private _conf: Configuration
  ) {
    this.user_form = this._formBuilder.group({
      user_type: [this.user_types.user.value, Validators.required],
      first_name: ["", Validators.required],
      last_name: ["", Validators.required],
      email: ["", Validators.required],
      password: ["", Validators.required],
      password_confirmation: ["", Validators.required],
      phone: [""],
    });
    this.avatar_base_url = _conf.STORAGE_BASE_URL + "storage/avatar/";
  }

  ngOnInit() {
    this.user_id = parseInt(this._route.snapshot.paramMap.get("id"));
    if (this.user_id) {
      this.loadingUser = true;
      this._userService.getByParams<any>({id: this.user_id}).subscribe(
        res => {
          if (res.success) {
            let userInfo = res.users[0];
            if (userInfo) {
              this.avatar = userInfo.avatar;
              this.user_form = this._formBuilder.group({
                  user_type: [userInfo.user_type, Validators.required],
                  first_name: [userInfo.first_name, Validators.required],
                  last_name: [userInfo.last_name, Validators.required],
                  email: [userInfo.email, Validators.required],
                  phone: [userInfo.phone],
                });
            }
          }
          this.loadingUser = false;
        }, err => {
          console.log(err);
          this.loadingUser = false;
        }
      )
    }

  }

  // create new user
  saveUser() {
    if (this.user_id) {
      this._userService.update<any>({
        id: this.user_id,
        user_type: this.user_form.value.user_type,
        first_name: this.user_form.value.first_name,
        last_name: this.user_form.value.last_name,
        avatar: this.avatar,
        email: this.user_form.value.email,
        phone: this.user_form.value.phone,
      }).subscribe(res => {
        if (res.success)
          this._router.navigate(['/admin/users']);
        else
          this.errors = res.message;
      })
    }
    // add
    else {
      this._userService.add<any>({
        user_type: this.user_form.value.user_type,
        first_name: this.user_form.value.first_name,
        last_name: this.user_form.value.last_name,
        avatar: this.avatar,
        email: this.user_form.value.email,
        password: this.user_form.value.password,
        password_confirmation: this.user_form.value.password_confirmation,
        phone: this.user_form.value.phone,
      }).subscribe(res => {
        if (res.success)
          this._router.navigate(['/admin/users']);
        else
          this.errors = res.message;
      }, err => {
        console.log(err);
      })
    }
  }

  back() {
    this._router.navigate(['/admin/users']);
  }

  // upload avatar image
  onAvatarChange(evt) {
    this.uploadingAvatar = true;
    const formData = new FormData();
    formData.append("avatar", evt.target.files[0]);

    this._userService.uploadAvatar<any>(formData).subscribe(res => {
      console.log(res);
      if (res.success)
        this.avatar = res.avatar;
      this.uploadingAvatar = false;
    }, err => {
      console.log(err);
      this.uploadingAvatar = false;
    })
  }

  

}
