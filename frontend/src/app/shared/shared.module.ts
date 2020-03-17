import { NgModule, CUSTOM_ELEMENTS_SCHEMA, ModuleWithProviders  } from '@angular/core';
import { CommonModule } from '@angular/common';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';


import { LoadingComponent } from './components/loading/loading.component';
import { BreadcrumbComponent } from './components/breadcrumb/breadcrumb.component';

import { UtilService } from './services/util.service';
import { FilterforPipe } from './pipes/filterfor';

import { FileUploadModule } from 'ng2-file-upload';
import { FileUploadComponent } from './components/file-upload/file-upload.component';
import { DatatablescustomComponent } from './components/datatablescustom/datatablescustom.component';
import { PaginationComponent } from './components/datatablescustom/pagination.component';
import { TablevaluePipe } from './components/datatablescustom/tablevalue.pipe';
import { SelectionlistComponent } from './components/selectionlist/selectionlist.component';
import { BgtableComponent } from './components/bgtable/bgtable.component';

import { CustomAdapter, CustomDateParserFormatter, CustomDatepickerI18n, I18n  } from './services/datepicker.adapter';
import {
  NgbCalendar,
  NgbDateAdapter,
  NgbDateStruct,
  NgbDateParserFormatter,
  NgbDatepickerI18n,
} from '@ng-bootstrap/ng-bootstrap';


@NgModule({
  declarations: [
    LoadingComponent, 
    BreadcrumbComponent, 
    FilterforPipe, 
    FileUploadComponent, 
    DatatablescustomComponent, 
    TablevaluePipe, 
    PaginationComponent, SelectionlistComponent, BgtableComponent
  ],
  imports: [
    CommonModule,
    FormsModule,
	  ReactiveFormsModule,    
    NgbModule,
    FileUploadModule,
  ],
  exports:[
    FilterforPipe,
    TablevaluePipe,
    LoadingComponent,
    FileUploadComponent,
    DatatablescustomComponent,
    PaginationComponent,
    BgtableComponent,

  ],
  providers:[
    //FilterforPipe
  ],
  schemas: [ CUSTOM_ELEMENTS_SCHEMA ],  
})
export class SharedModule { 
  static forRoot(): ModuleWithProviders {
    return {
      ngModule: SharedModule,
      providers: [
         UtilService,
         I18n,
         {provide: NgbDatepickerI18n, useClass: CustomDatepickerI18n},
         {provide: NgbDateAdapter, useClass: CustomAdapter},
         {provide: NgbDateParserFormatter, useClass: CustomDateParserFormatter}
        ]
    };
  }  
}
