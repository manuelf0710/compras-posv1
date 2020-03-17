import { Injectable } from '@angular/core';
import { Router } from '@angular/router';
//import { NgbModal, NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';


@Injectable({ providedIn: 'root' })
export class UtilService {
    constructor(private router: Router,
        //private modalService: NgbModal,
        //public activeModal: NgbActiveModal,
        ) { }

    goTo(url) {
        this.router.navigate([url]);
    }
}