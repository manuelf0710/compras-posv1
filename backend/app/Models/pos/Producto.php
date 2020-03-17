<?php

namespace App\Models\pos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
	use Notifiable;

    //protected $table = 'productos';
    public $timestamps = true;

    use SoftDeletes;
	
    protected $fillable = [
        'codigo', 'descripcion', 'stock', 'precio_compra', 'precio_venta', 'imagen'
    ];	

    protected $dates = ['deleted_at'];
    protected $hidden = ['updated_at','deleted_at'];
    public static $directionOrder = ['ASC','ASC'];

    public static $rules = [
        'codigo' => 'required',
        'descripcion' => 'required|string',
        'stock' => 'required',
        'precio_compra' => 'required',
        'precio_venta' => 'required',
    ];
  public function categoria()
  {
    //return $this->hasOne(Categoria::class);
	return $this->belongsTo('App\Models\pos\Categoria');
  }
}
