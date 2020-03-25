import { Component, OnInit, Input} from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';

import { CategoriasService } from './../../categorias/categorias.service';
import { ProductosService } from './../productos.service';
import { Producto } from './../modelproducto';
import { environment } from './../../../../../environments/environment';

@Component({
  selector: 'app-newproducto',
  templateUrl: './newproducto.component.html',
  styles: []
})
export class NewproductoComponent implements OnInit {
  public archivoscargados: any[] = [];
  formulario: FormGroup;
  @Input() data: Producto;
  public api_url = environment.server_root;
  respuesta = {
    status: 'close',
    data  : []
  }
  public loading: boolean = false;
  categorias = [];
  arraytest = [
    {item:1},
    {item:2},
    {item:3},
    {item:4},
    {item:5},
  ];

  constructor(private FormBuilder: FormBuilder, 
    public _activeModal: NgbActiveModal,
    public _CategoriasService:CategoriasService,
    public _ProductosService: ProductosService
    ) {
//this.buildForm();
}

  ngOnInit(): void {
    this.buildForm();
     this._CategoriasService.getCategorias().subscribe(
      (res: any) => {
        this.categorias = res
      }
    )
  }

  getArchivos(archivos_upload){ /*archivos subidos, desde fileuploadcomponent */
    console.log(archivos_upload);
    console.log("closeup");
    this.archivoscargados = archivos_upload;
  }

  private buildForm() {
    let id     = null;
    let categoria_id = null;
    let codigo = null;
    let descripcion = null;
    let imagen = null;
    let stock = 1;
    let precio_compra = null;
    let precio_venta = null;

    if(this.data){
      id = this.data.id;
      categoria_id = this.data.categoria_id;
      codigo       = this.data.codigo;
      descripcion  = this.data.descripcion;
      imagen       = this.data.imagen;
      stock        = this.data.stock;
      precio_compra= this.data.precio_compra;
      precio_venta = this.data.precio_venta;

    }
    this.formulario = this.FormBuilder.group({
      id:[id],
      categoria_id : [categoria_id, [Validators.required]],
      codigo       : [codigo],
      descripcion  : [descripcion, [Validators.required]],
      imagen       : [imagen],
      stock        : [stock,[Validators.required]],
      precio_compra: [precio_compra,[Validators.required]],
      precio_venta : [precio_venta,[Validators.required]],
    });
  }  

  guardar(event: Event){
    event.preventDefault();
    if(this.archivoscargados.length){
      this.formulario.value.imagen = this.archivoscargados[0].path;
    }
    if (this.formulario.valid) {
      const value = this.formulario.value;
      this.loading = true;
      this._ProductosService.guardar(value)
      .subscribe(
        (res: any)=>{
          this.respuesta = {status: 'ok', data: res};
          this._activeModal.close(this.respuesta);
        },
        (error: any)=>{ console.log("error "+error)},
        ()=> this.loading = false

      )

    } else {
      this.formulario.markAllAsTouched();
    }
    if(this.formulario.valid){
      
    }
  }  

  closeModal() {
    this._activeModal.close(this.respuesta);
  }  

}
