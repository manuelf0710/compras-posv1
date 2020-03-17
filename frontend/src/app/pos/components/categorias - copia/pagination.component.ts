import { Component, OnInit, Output, Input, EventEmitter } from '@angular/core';
import { Paginate } from './modelpaginate';
import { PaginateService } from './paginate.service';

@Component({
  selector: 'app-pagination',
  templateUrl: './pagination.component.html',
  styles: []
})
export class PaginationComponent implements OnInit {
  //@Input() dataPag : Paginate;
  @Input() links : any;
  @Output() goPage: EventEmitter<Object>; /*Evento que emite la pagina a buscar */
  public current: number = 0;
  public totalpage: number = 0;
  public recordsPerPage: number = 0;
  public linksCountLimit: number = 2;
  //public arrlinks: any[] = [];

  constructor(public _PaginateService: PaginateService) { 
    this.goPage = new EventEmitter();
  }

  ngOnInit(): void {
    //this.dataPag = this._PaginateService.paginate(this.dataPag);
  }
  public goToPage(evento:any){
    this.goPage.emit(evento);
  }
/*
  paginate(){
    this.current = this.dataPag.currentpage;
    this.totalpage = this.dataPag.totalpage;
    this.recordsPerPage = this.dataPag.recordsPerPage;    
    if(this.totalpage==0) {this.totalpage =1; }
    let cssclase = 'SBRA2';
    let output = '';
    let fuente = '';
    let count = 1;
    if (this.current > 1) {					
      for(var j = this.current; j >= 1; j-- ) {
        if (count > this.linksCountLimit){
          break;
          
        };						
        if (j == this.current){							
          continue;
        };
        
        output = "<a href='#page/"+j+"' id='"+j+"' class='"+cssclase+"'>"+j+"</a>\r\n" +output;						
        count ++;
        this.arrlinks.unshift({'url': fuente+'/page/'+j, 'id': j, 'clase': cssclase, 'label': j , 'selec': 0});
        
        
      }
      
      //previous page link
      var prevPage = this.current - 1;
      output = "<a href='#page/"+prevPage+"' id='"+prevPage+"' class='"+cssclase + "'>Previous</a>\r\n"  +output;
      this.arrlinks.unshift({'url': fuente+'/page/'+prevPage, 'id': prevPage, 'clase': cssclase, 'label': 'Previous' , 'selec': 0});
      
      if (prevPage > 1){
        // first page link
        output = "<a href='#page/1' id='1' class='" + cssclase + "'>First</a>\r\n" + output;
        this.arrlinks.unshift({'url':fuente+'/page/1', 'id': 1, 'clase': cssclase, 'label': 'First' , 'selec': 0});
      }	
    }

    output += "<span class='current'>"+this.current+"</span>\r\n";
    this.arrlinks.push({'url':'', 'id': '', 'clase': 'current', 'label': this.current , 'selec': 1});
    
					// next pages
					count = 1;
					
				for(var i = this.current; i < this.totalpage; i ++) {
					if (count > this.linksCountLimit){
						break;
					}
					if (i == this.current){
						continue;
					}
					output += "<a href='#page/"+i+"' id='"+i+"' class='"+cssclase+"'>"+i+"</a>\r\n";
					count ++;
					this.arrlinks.push({'url': fuente+'/page/'+i, 'id': i, 'clase': cssclase, 'label': i , 'selec': 0});
        }  
        
				if (this.current < this.totalpage) {
					// next link
					var next = this.current + 1;
					output += "<a href='#page/"+next+"' id='"+next+"' class='"+cssclase+"'>Next</a>\r\n";
					this.arrlinks.push({'url': fuente+'/page/'+next, 'id': next, 'clase': cssclase, 'label': 'Next' , 'selec': 0});
					
					if (this.totalpage != next){
						// last page link
						output += "<a href='#page/"+this.totalpage+"' id='"+this.totalpage+"' class='"+cssclase+"'>Last</a>\r\n";
						this.arrlinks.push({'url': fuente+'/page/'+this.totalpage, 'id': this.totalpage, 'clase': cssclase, 'label': 'Last' , 'selec': 0});						
					}
					
				}        
    console.log("arraylinks", this.arrlinks);
  }*/
}