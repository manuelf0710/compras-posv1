import { Component, OnInit, CUSTOM_ELEMENTS_SCHEMA, ViewEncapsulation } from '@angular/core';
import { HttpClient, HttpErrorResponse } from '@angular/common/http';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
//import { map } from 'rxjs/operators';
//import {Observable} from 'rxjs';
//import { environment } from './../../../../environments/environment';
import { Categoria } from './modelcategoria';

import { CategoriasService } from './categorias.service';
import { NewcategoriaComponent } from './crear/newcategoria.component';

//services
//import { UtilService } from './../../../global/services/util.service';


@Component({
  selector: 'app-categorias',
  templateUrl: './categorias.component.html',
  styleUrls: ['./categorias.component.css'],
  encapsulation: ViewEncapsulation.None,
})
export class CategoriasComponent implements OnInit {
  //public categorias : Observable<Categoria[]>;
  public categorias :Categoria[] = [];
  //public categorias:[];
  public loading: boolean;
  public categoriasearch: string = '';
  

  constructor(private _http: HttpClient,
             private _categoriaService: CategoriasService,
             private modalService: NgbModal,
             //private _UtilService: UtilService
             
             ) { 
              this.loading = true;  
  }

  ngOnInit() {
    /*this._categoriaService.getCategorias()
    .subscribe(
      res => {
        this.categorias = res;
        console.log("la data en componjente ", res);
      }
    );
    */
   this.loadCategorias();
  }
  loadCategorias(){
    this.loading = true;
    this._categoriaService.getCategorias()
     .subscribe(
       (res: Categoria[])=>{
         this.categorias = res;
       },
       (error:HttpErrorResponse) => {
             console.log("ha ocurrido un error ");
             console.log("error ",error);
       },
       () => { 
         this.loading = false 
        }
     )
  }
  
  public agregarCategoria(){
    const modalRef = this.modalService.open(NewcategoriaComponent,{
      backdrop: 'static',
      size: 'lg',
      keyboard: false
    });
  
    modalRef.result.then((result) => {
      if(result.status == 'ok'){
        this.loadCategorias();
      }
    }).catch((error) => {
    });   
  }

  public editarCategoria(categoria){
    const modalRef = this.modalService.open(NewcategoriaComponent,{
      backdrop: 'static',
      size: 'lg',
      keyboard: false
  });
  
  modalRef.componentInstance.data = categoria; 
  
  modalRef.result.then((result) => {
    if(result.status == 'ok'){
      this.loadCategorias();
    }
  }).catch((error) => {
  });  
  }

}
