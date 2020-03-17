<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requerimiento extends Model
{
    public function detalles(){
		return $this->hasMany('App\Detalle_req');
	}
}
