
import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';
import { FormsModule,FormBuilder, FormGroup, FormArray } from '@angular/forms';
import { BgtableService } from './bgtable.service';

import { BgTable } from './modeltable';
import { environment } from './../../../../environments/environment';

@Component({
  selector: 'app-bgtable',
  templateUrl: './bgtable.component.html',
  styleUrls: ['./bgtable.component.css']
})
export class BgtableComponent implements OnInit { 
  public api_url = environment.server_root;
  public dataSource : any[]; 
  public isSearching: boolean;
  public pageSize : number;
  public currentPage : number;
  public totalRecords : number;
  public from : number;
  public to:number;
  public formSearch : Array<object> = []; /*array objetos searchable in tableConfig */
  public paramSearch: any[] = []; /* array properties searchables in tableConfig ["nombre", "documento"] */
  public paramSearchToObject: object = {}; /*variables de array pasados a objeto, para enviar en la petición httpparams del servicio */
  public pageLength = [
    5,10,20,50,100
  ];
  public formHttpParams: object; 
  public model;

  @Input() tableConfig : BgTable;
  @Output() editarAction :EventEmitter<Object>;
  @Output() eliminarAction :EventEmitter<Object>;
  @Output() copiarAction :EventEmitter<Object>;  
  @Output() exportarAction :EventEmitter<Object>;  

  constructor(private _BgtableService : BgtableService) {
    this.isSearching = true;
    this.pageSize = 5;
    this.currentPage = 1;
    this.editarAction = new EventEmitter();
    this.eliminarAction = new EventEmitter();
    this.copiarAction = new EventEmitter();    
    this.exportarAction = new EventEmitter();    
    console.log("los httpparams ",this.formHttpParams);
   }

  ngOnInit(): void {
    this.tableConfig.columns.forEach(element => {
      //console.log(element)
        if(element['searchable']){
        this.formSearch.push({title: element['title'], key:element['data'], value:'', type:element['type']});
      }
    });

    console.log('formulario search',this.formSearch);
    for(let i=0; i < this.formSearch.length; i++){
        this.paramSearch.push(this.formSearch[i]['key'])     
      }
     // paramSearchToObject
    for(let i = 0; i < this.paramSearch.length; i++){
      this.paramSearchToObject[this.paramSearch[i]] = '';
    }
    console.log("elobjetosearch",this.paramSearchToObject);
/*
      for(let i = 0; i < fields.length; i++){
        if(fields[i]==columna.data){ 
         obj[fields[i]] = valor;
       }else{
        obj[fields[i]] = '';
      }
    } */     


    this.loadTableData(this.tableConfig.url+'?pageSize='+this.pageSize);
  }
  pageChange(pag){
    this.loadTableData(this.tableConfig.url+'?page='+pag+'&pageSize='+this.pageSize);
  }
  public onChangePaginationSize(){
    this.currentPage = 1;
    this.loadTableData(this.tableConfig.url+'?page=1&pageSize='+this.pageSize);
  }
  SearchForRowFilter(evento, columna){
    /*console.log("el evento ",evento.target.value);
    console.log("la columna ",columna);
    console.log("el formsearch ",this.formSearch);*/
    this.paramSearchToObject[columna.data] = evento.target.value;

    console.log("la columna",columna);
    console.log("el objeto a enviar",this.paramSearchToObject);
    if(evento.target.value == '') return;
    
  }

  public editarRow(evento:any){
    this.editarAction.emit(evento);
  }
  public copiarRow(evento:any){
    this.copiarAction.emit(evento);
  }
  public eliminarRow(evento:any){
    this.eliminarAction.emit(evento);
  }
  public verFormulario(){
    console.log(this.formSearch);
  }
  public exportar(evento:any){
    let data = {url:'la url', export:evento }
    this.exportarAction.emit(data);
  }
      

  public advancedSearch(){
    
  }
  searchForRow(){
    //this.paramSearchToObject['fecha_nacimiento']='14/03/2020';
    console.log(this.paramSearchToObject);
    this.onChangePaginationSize();
  }
  dateSeleccionado(dato){
    console.log("el dateseleccionado es ",dato);
  }

  loadTableData(url){
    console.log("el objeto a enviar en loadtabledata",this.paramSearchToObject);
    //this.paramSearchToObject['fecha_nacimiento']='13/03/2020';
    this.isSearching = true;
    this._BgtableService.getLista(url, this.paramSearchToObject)
     .subscribe(
       (res: any)=>{
         this.dataSource = res.data;
         this.totalRecords = res.total;
         this.from = res.from;
         this.to = res.to;
       },
       (error:any) => {
             console.log("ha ocurrido un error en bgtable component ");
             console.log("error ",error);
       },
       () => this.isSearching = false
     )
  }

}
