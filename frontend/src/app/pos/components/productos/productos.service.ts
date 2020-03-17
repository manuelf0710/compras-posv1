import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { map } from 'rxjs/operators';

import { environment } from './../../../../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class ProductosService {

  constructor(private _http:HttpClient) { }

  public getLista(){
      return this._http.get<any>(`${environment.apiUrl}/pos/productos`)
      .pipe(map(lista => {
         const retorno = lista.data;
         return retorno;
      }));
    }
    public guardar(data){  
      if(data.id == null){
          return this._http.post<any>(`${environment.apiUrl}/pos/productos`,data);    
        }else{
        return this._http.put<any>(`${environment.apiUrl}/pos/productos/`+data.id, data);
        }     
  }
}  
