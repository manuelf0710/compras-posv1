import { Component, OnInit, ViewChild } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { BgtableComponent } from './../../../../shared/components/bgtable/bgtable.component';

import { InventarioService } from './inventario.service';
import { delay } from 'rxjs/operators';
import { Observable } from 'rxjs';
import { environment } from './../../../../../environments/environment';

@Component({
  selector: 'app-inventario',
  templateUrl: './inventario.component.html',
  styleUrls: ['./inventario.component.css']
})
export class InventarioComponent implements OnInit {
  @ViewChild(BgtableComponent) dataTableReload: BgtableComponent;
  active = 1;
  formulario: FormGroup;
  public loading: boolean = false;
  public loadinginicio: boolean = true;
  //public razones:Array<object> = [];
  public allrazones = [];
  public almacenes = [];
  //razones$: Observable<[]>;
  public razones= null;

  buttons =  {
    acciones: {
      'copy': true
      },
    exports: [],
  };
  columns = [
    /*{
      title : 'Imagen',
      data:'imagen',
      type:'imagen',
      width_img:'60',
      orderable: false,
      searchable:false
    },*/
    {
      title : 'Código',
      data:'codigo',
      orderable: false,
      searchable:true,
      type:'text',
    },
    {
      title : 'Descripción',
      data:'descripcion',
      orderable: true,
      searchable:true,
      type:'text',
    },
    {
      title : 'Precio Venta',
      data  : 'precio_venta',
      pipe : 'currency',
      orderable: true,
      searchable:false,
      type:'text',
    },     
    {
      title : 'Stock',
      data  : 'stock',
      orderable: true,
      searchable:false,
      type:'text',
    }

  ]; 
  
  tableConfig = {
    buttons: this.buttons,
    listado_seleccion : true,
    columns : this.columns,
    url     : environment.apiUrl+'/pos/productoslist',
    globalSearch: true,
    rowSearch:false,
    advancedSearch: false,
    paginatorPosition: 'bottom',
    customFilters: [
    ]
  }
  ventaDetalles = this.initVentaDetalles()

  constructor(private FormBuilder: FormBuilder, 
              private _InventarioService : InventarioService
              ) {

   }

  ngOnInit(): void {
    this.buildForm();
  }


  buildForm(){

    this.loadData();
    let id = null
    let fecha = null
    let razon_id = null
    let almacen_id = null
    let proveedor_id = null

    this.formulario = this.FormBuilder.group({
      id:[id],
      fecha:[fecha, [Validators.required]],
      razon_id: [razon_id, [Validators.required]],
      almacen_id:[almacen_id, [Validators.required]],
      proveedor_id:[proveedor_id, [Validators.required]],
    });
  }
  initVentaDetalles(){
    let ventaDetalles = {
      productosVenta : [],
      total : 0,
      subtotal: 0,
      impuesto: 0,
      totalItems:0,
      posicion:0,
      tiempo:'',
      metodo_pago:''
    } 
    return ventaDetalles
  }
  getCurrentTime(){
    let today = new Date();
    let time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();  
    return time;  
  }  
  insertFirstProduct(data){
    data.cantidad = 1;
    data.tiempo = this.getCurrentTime()
    this.ventaDetalles.productosVenta.unshift(data);
  }
  findItemInArray(data){
    let search = this.ventaDetalles.productosVenta.findIndex(item=> item.id === data.id);
    return search;
  } 
  updateQuantityProduct(data, index){
    let cantidadActual = this.ventaDetalles.productosVenta[index].cantidad;
    let nuevaCantidad  = this.ventaDetalles.productosVenta[index].cantidad + 1
    
    let cantidadInsertar = nuevaCantidad > data.stock ? data.stock : nuevaCantidad;
    this.ventaDetalles.productosVenta[index].cantidad = cantidadInsertar;
  }
  insertNewProduct(data){
    data.cantidad = 1;
    this.ventaDetalles.productosVenta.unshift(data); 
  }  
  addProducto(data){
    let getIndexProducto = this.findItemInArray(data);
    getIndexProducto >= 0 ? this.updateQuantityProduct(data, getIndexProducto): this.insertNewProduct(data)  
  }  
  copiar(data){
    this.ventaDetalles.productosVenta.length ? this.addProducto(data) : this.insertFirstProduct(data);
 }

  guardar(evento){

  } 
  loadData(){
    this._InventarioService.getData().pipe(delay(500)).subscribe(data => {
      this.razones = data.razones;
      this.almacenes = data.almacenes;
      this.loadinginicio = false;
  });    
  }
}
