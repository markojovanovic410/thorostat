import { Component, OnInit } from '@angular/core';
import { NbAuthComponent } from '@nebular/auth';

@Component({
  selector: 'layout',
  templateUrl: './layout.component.html',
  styleUrls: ['./layout.component.scss']
})
export class LayoutComponent extends NbAuthComponent {
}
