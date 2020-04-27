import { Component, OnInit, Output, EventEmitter, Input } from '@angular/core';
import {Observable, of} from 'rxjs';
import {debounceTime, distinctUntilChanged, map,tap, switchMap, catchError, filter} from 'rxjs/operators';
import { HttpClient } from '@angular/common/http';
//import { FormsModule } from '@angular/forms';
const states = ['Alabama', 'Alaska', 'American Samoa', 'Arizona', 'Arkansas', 'California', 'Colorado',
  'Connecticut', 'Delaware', 'District Of Columbia', 'Federated States Of Micronesia', 'Florida', 'Georgia',
  'Guam', 'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine',
  'Marshall Islands', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana',
  'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
  'Northern Mariana Islands', 'Ohio', 'Oklahoma', 'Oregon', 'Palau', 'Pennsylvania', 'Puerto Rico', 'Rhode Island',
  'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virgin Islands', 'Virginia',
  'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'];

@Component({
  selector: 'app-autocomplete',
  templateUrl: './autocomplete.component.html',
  styleUrls: ['./autocomplete.component.css']
})
export class AutocompleteComponent implements OnInit {
  public modeloBusqueda: any;
  @Output() seleccionado :EventEmitter<Object>;
  @Input() url: string;
  searching = false;
  searchFailed = false;
  constructor(private _HttpClient:HttpClient) {
    this.seleccionado = new EventEmitter();
   }

  ngOnInit(): void {
  }
  resultFormatBandListValue(value: any) {            
    return value.nombre;
  } 
  inputFormatBandListValue(value: any)   {
    if(value.nombre)
      return value.nombre
    return value;
  }   
  buscarData(term: string){
    if (term === '') {
      return of([]);
    }
    return this._HttpClient
      .post<any>(this.url,{globalsearch:term}).pipe(
        map(response => {
          console.log(response.data);
          return response.data;
          }
          )
      );    
  }

  search = (text$: Observable<string>) =>
    text$.pipe(
      filter(res => res.length > 3 || res.length == 0 ),
      debounceTime(200),
      distinctUntilChanged(),
      tap(() => this.searching = true),
      switchMap(term =>
        this.buscarData(term).pipe(
          tap(() => this.searchFailed = false),
          catchError(() => {
            this.searchFailed = true;
            return of([]);
          }))        
      ),
      tap(() => this.searching = false)
    )  

    selected(evento:any){
      console.log("algo seleccionado", evento.item)
      this.seleccionado.emit(evento.item);
    }
}
