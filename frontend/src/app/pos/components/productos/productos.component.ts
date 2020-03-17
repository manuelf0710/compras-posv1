import { Component, OnInit, ViewChild  } from '@angular/core';
import { HttpClient, HttpErrorResponse } from '@angular/common/http';
//services
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { ProductosService } from './productos.service';
//models
import { Producto } from './modelproducto';

import { environment } from './../../../../environments/environment';
import { NewproductoComponent } from './crear/newproducto.component';

//import { Datatable } from './crear/datatable';
import { Datatable } from './../../../shared/components/datatablescustom/datatable';
import { DatatablescustomComponent } from './../../../shared/components/datatablescustom/datatablescustom.component';


@Component({
  selector: 'app-productos',
  templateUrl: './productos.component.html',
  styleUrls: ['./productos.component.css']
})
export class ProductosComponent implements OnInit {
  @ViewChild(DatatablescustomComponent) datatablereload: DatatablescustomComponent;
  acciones =  {
    buttons: {
      'edit': 'editar',
      'delete': 'eliminar',
      'copy': 'copiar',
      },
    listado_seleccion : false
  };
  //columns=['#','acciones','imagen','codigo','descripcion','categoria','stock','precio compra','precio venta','agregado'];
  columns = [
    {
      title : 'Imagen',
      data:'imagen',
      render:'imagen',
      width_img:'60',
      orderable: false,
      searchable:false
    },
    {
      title : 'Código',
      data:'codigo',
      orderable: false,
      searchable:true
    },
    {
      title : 'Descripción',
      data:'descripcion',
      orderable: true,
      searchable:true
    },
    {
      title : 'Categoría',
      data:'categoria.nombre',
      orderable:true,
      searchable:true
    },    
    {
      title : 'Stock',
      data  : 'stock',
      orderable: true,
      searchable:false
    },
    {
      title : 'Precio Venta',
      data  : 'precio_venta',
      pipe : 'currency',
      orderable: true,
      searchable:false
    },     
    {
      title : 'Precio Compra',
      data  : 'precio_compra',
      pipe: 'currency',
      orderable: true,
      searchable:false
    },     

  ];

  datatables_config:Datatable = {
    acciones: this.acciones,
    columns : this.columns,
    urlDatatables: environment.apiUrl+'/pos/productos',
    allSearch: true,
    paginatorPosition: 'top'
  }

  //public categorias : Observable<Categoria[]>;
  public productos :Producto[] = [];
  //public categorias:[];
  public loading: boolean = true;
  public productosearch: string = '';
  public api_url = environment.server_root;

  constructor(
    private _http: HttpClient,
    private _ProductosService:ProductosService,
    private modalService: NgbModal,
    ) { }

  ngOnInit() {
   //this.loadProductos();
  }

  redrawDatatable(reload){
    this.datatablereload.reload(reload);
  }

/*
  loadProductos(){
    this.loading = true;
    this._ProductosService.getLista()
     .subscribe(
       (res: Producto[])=>{
         this.productos = res;
       },
       (error:HttpErrorResponse) => {
             console.log("ha ocurrido un error ");
             console.log("error ",error);
       },
       () => this.loading = false
     )
  }
 */ 
  public agregarProducto(){
    const modalRef = this.modalService.open(NewproductoComponent,{
      backdrop: 'static',
      size: 'lg',
      keyboard: false
    });
  
    modalRef.result.then((result) => {
      if(result.status == 'ok'){
        //this.loadProductos();
        this.redrawDatatable(true);
      }
    }).catch((error) => {
    });
  }

  public editarProducto(producto: any){
    const modalRef = this.modalService.open(NewproductoComponent,{
      backdrop: 'static',
      size: 'lg',
      keyboard: false
    });
    modalRef.componentInstance.data = producto; 
    modalRef.result.then((result) => {
      console.log("el resultado fue  ",result);
     
      if(result.status == 'ok'){
        //this.loadProductos();
        this.redrawDatatable(false);
      }
    }).catch((error) => {
    });    

  }

}
