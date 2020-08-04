import { Component, OnInit, TemplateRef } from '@angular/core';
import { Router } from '@angular/router';
import { UserService } from '../../_service/user.service';
import { AppData } from '../../_config/appdata';
import { Configuration } from '../../_config/_conf';
import { NbDialogService } from '@nebular/theme';

@Component({
  selector: 'ngx-users',
  templateUrl: './users.component.html',
  styleUrls: ['./users.component.scss']
})
export class UsersComponent implements OnInit {

  toggleFilters: boolean;
  avatar_base_url = "";
  loadingUsers = false;

  users: any = [];
  app_data = AppData.user_type;

  activeModal: any;

  constructor(
    private _router: Router,
    private _userService: UserService,
    private _conf: Configuration,
    private _modalService: NbDialogService,
  ) {
    this.toggleFilters = false;
    this.avatar_base_url = _conf.STORAGE_BASE_URL + "storage/avatar/";
  }

  ngOnInit() {
    // let params = {user_type: AppData.user_type.user.value};
    this.loadingUsers = true;

    let params = {};
    this._userService.getByParams<any>(params).subscribe(
      res => {
        if (res.success) 
          this.users = res.users;
        this.loadingUsers = false;
      }, err => {
        console.log(err);
        this.loadingUsers = false;
      }
    )
  }

  // navigate to add new
  addNew() {
    this._router.navigate(['/admin/users/add']);
  }

  // toggle details info
  toggleDetails(event, user_id) {
    this._router.navigate(['/admin/users/edit/' + user_id]);
  }

  deleteUser(confirm: TemplateRef<any>, user_id) {
    this.activeModal = this._modalService.open(confirm, { context: user_id });
  }

  confirmDelete(user_id) {
    console.log(user_id);
    this.loadingUsers = true;
    this._userService.deleteUser<any>({user_id: user_id}).subscribe(
      res => {
        if (res.success) {
          this._userService.getByParams<any>({}).subscribe(
            res => {
              if (res.success)
                this.users = res.users;
              this.loadingUsers = false;
            }, err => {
              console.log(err);
              this.loadingUsers = false;
            }
          )
          this.activeModal.close();
        }
      }, err => {
        console.log(err);
        this.loadingUsers = false;
      }
    )
  }
  
}
