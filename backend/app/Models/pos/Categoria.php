<?php

namespace App\Models\pos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use app\Models\pos\Producto;

class Categoria extends Model
{
	protected $table = 'categorias';
	use Notifiable;

    public $timestamps = true;

    use SoftDeletes;
	
    protected $fillable = [
        'nombre'
    ];	

    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at','deleted_at'];
    public static $directionOrder = ['ASC','ASC'];

    public static $rules = [
        'nombre' => 'required|string|max:100',
    ];
	
	public function productos(){
		return $this->hasMany(Producto::class);
	}
}