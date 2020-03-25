import { Injectable, TemplateRef  } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class ToastService {
  toasts: any[] = [];

  show(textOrTpl: string | TemplateRef<any>, options: any = {}) {
    this.toasts.push({ textOrTpl, ...options });
  }

  remove(toast) {
    this.toasts = this.toasts.filter(t => t !== toast);
  }
  
  errorMessage(errors){
   let message = '';
   let inputsError = Object.keys(errors);
 	 inputsError.forEach(function(item){
		for(let i = 0; i < errors[item].length; i++){
			message = message + errors[item][i] + '</p>';
		}
 	 });
	return message;  
  }
}
