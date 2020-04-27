<?php

namespace App\Models\pos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrecioLista extends Model
{
	use Notifiable;
    public $timestamps = true;
    use SoftDeletes;
	protected $primaryKey = 'id';
    protected $fillable = [
        'producto_id','nombre', 'porcentaje','valor','ganancia'
    ];
    protected $dates = ['deleted_at'];
    protected $hidden = ['updated_at','deleted_at'];
		public static $customMessages = [
    	'required' => 'Cuidado!! el campo :attribute no puede ser vacío',
    	'unique' => 'Error! el número de :attribute ya se encuentra registrado',
    	'max' => 'Error! el valor de :attribute supero el tope permitido',
		'integer' => 'Error! el valor de :attribute debe ser un número sin comas ni puntos'
	];

	public static function rules(Request $request, $id = null)
    {
		
     	$rules = [
        	'producto_id' => 'required',
        	'nombre' => 'required|string',
        	'porcentaje' => 'required',
        	'valor' => 'required',
        	'ganancia' => 'required'
    	];		
        switch( $request->method() )
        {
            case 'POST':
            {
 				return $rules;
            }
            case 'PUT':
            {
				return $rules;
            }
            default:break;
        }
    }
  public function producto()
  {
	return $this->belongsTo('App\Models\pos\Producto', 'producto_id', 'id');
  }
}
