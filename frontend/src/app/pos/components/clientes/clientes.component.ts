import { Component, OnInit, ViewChild } from '@angular/core';
import { environment } from './../../../../environments/environment';

import { NgbModal } from '@ng-bootstrap/ng-bootstrap';

import { NewClienteComponent } from './crear/new-cliente.component';

import { BgtableComponent } from './../../../shared/components/bgtable/bgtable.component';


@Component({
  selector: 'app-clientes',
  templateUrl: './clientes.component.html',
  styleUrls: ['./clientes.component.css']
})
export class ClientesComponent implements OnInit {
  @ViewChild(BgtableComponent) dataTableReload: BgtableComponent;
  public formSearch : Array<object> = [];
  buttons =  {
    acciones: {
      'edit': true,
      'delete': true,
      'copy': true,
      },
    exports: ['excel', 'csv', 'pdf',],
  };
  columns=[
    {
      title : 'Nombre',
      data:'nombre',
      orderable: true,
      searchable:true,
      type:'text'
    },    
    {
      title : 'Documento',
      data:'documento',
      orderable: false,
      searchable:true,
      type:'number'
    },
    {
      title : 'Email',
      data:'email',
      orderable: false,
      searchable:true,
      type:'text'
    },        
    {
      title : 'Telefono',
      data:'telefono',
      orderable: false,
      searchable:false,
      type:'text'
    }, 
    {
      title : 'Dirección',
      data:'direccion',
      orderable: false,
      searchable:false,
      type:'text'
    },          
    {
      title : 'compras',
      data:'compras',
      orderable: false,
      searchable:true,
      type:'number'
    },              
    {
      title : 'Ultima Compra',
      data:'ultima_compra',
      orderable: false,
      searchable:true,
      type:'date'
    },
  ];

  tableConfig = {
    buttons: this.buttons,
    listado_seleccion : false,
    columns : this.columns,
    url     : environment.apiUrl+'/pos/clienteslist',
    allSearch: true,
    paginatorPosition: 'bottom',
  }  
  constructor(private modalService: NgbModal) {
   }

  ngOnInit() {
  }
  redrawTable(redraw, data){
    this.dataTableReload.reload(redraw, data);
  }

  agregar(){
    const modalRef = this.modalService.open(NewClienteComponent,{
      backdrop: 'static',
      size: 'xs',
      keyboard: false
    });
  
    modalRef.result.then((result) => {
      if(result.status == 'ok'){
        this.redrawTable(true, result.data.data);
      }
    }).catch((error) => {
      console.log("error en agregarcliente component ",error)
    });
  }

  public editar(cliente: any){
    const modalRef = this.modalService.open(NewClienteComponent,{
      backdrop: 'static',
      size: 'lg',
      keyboard: false
    });
    modalRef.componentInstance.data = cliente; 
    modalRef.result.then((result) => {
      console.log("el resultado fue  ",result);
     
      if(result.status == 'ok'){
        //this.loadProductos();
        this.redrawTable(false, result.data.data);
      }
    }).catch((error) => {
    });    

  }

  copiar(data){
    console.log(data);
  }
  eliminar(data){
    console.log(data);
  }
  exportar(data){
    console.log('exportar ',data);
  }

}
