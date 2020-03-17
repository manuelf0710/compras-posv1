<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle_req extends Model
{
    public function detalles(){
		 return $this->belongsTo('App\Requerimiento');
	}
}
