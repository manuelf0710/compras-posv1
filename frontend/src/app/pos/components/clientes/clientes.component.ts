import { Component, OnInit } from '@angular/core';
import { environment } from './../../../../environments/environment';

@Component({
  selector: 'app-clientes',
  templateUrl: './clientes.component.html',
  styleUrls: ['./clientes.component.css']
})
export class ClientesComponent implements OnInit {
  public formSearch : Array<object> = [];
  buttons =  {
    acciones: {
      'edit': true,
      'delete': true,
      'copy': true,
      },
    exports: ['excel', 'csv', 'pdf',],
    listado_seleccion : false
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
      title : 'Fecha nacimiento',
      data:'fecha_nacimiento',
      orderable: false,
      searchable:true,
      type:'date'
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
    {
      title : 'Ingreso al Sistema',
      data:'fecha_ingreso',
      orderable: false,
      searchable:true,
      type:'date'
    },              
  ];

  tableConfig = {
    buttons: this.buttons,
    columns : this.columns,
    url     : environment.apiUrl+'/pos/clienteslist',
    allSearch: true,
    paginatorPosition: 'top'
  }  
  constructor() { }

  ngOnInit() {
  }

  editar(data){
    console.log(data);
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
