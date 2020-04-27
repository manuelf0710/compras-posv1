import { Component, OnInit, ViewChild } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { BgtableComponent } from './../../../../shared/components/bgtable/bgtable.component';
import { ProveedorService } from './proveedor.service';
import { environment } from './../../../../../environments/environment';

@Component({
  selector: 'app-proveedor',
  templateUrl: './proveedor.component.html',
  styleUrls: ['./proveedor.component.css']
})
export class ProveedorComponent implements OnInit {
  @ViewChild(BgtableComponent) dataTableReload: BgtableComponent;  
  public loading: boolean = false;
  buttons =  {
    acciones: {
      'new' : true,
      'edit':true,
      'delete':true,
      },
    exports: [],
  };
  columns = [
      {
        title : 'Identificación',
        data:'registro',
        orderable: false,
        searchable:true,
        type:'text',
      },
      {
        title : 'Nombre',
        data:'nombre',
        orderable: false,
        searchable:true,
        type:'text',
      },      
  ];
  tableConfig = {
    buttons: this.buttons,
    listado_seleccion : true,
    columns : this.columns,
    url     : environment.apiUrl+'/pos/proveedoreslist',
    globalSearch: true,
    rowSearch:false,
    advancedSearch: false,
    paginatorPosition: 'both',
    customFilters: [
    ]
  } 
  constructor() { }

  ngOnInit(): void {
  }

}
