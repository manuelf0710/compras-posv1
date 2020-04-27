<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lista extends Model
{
	use Notifiable;
	protected $table = 'listas';
    public $timestamps = true;

    use SoftDeletes;
	
    protected $fillable = [
        'nombre', 'clase_lista_id', 'estado', 'extra'
    ];	

    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at','deleted_at'];
    public static $directionOrder = ['ASC','ASC'];
	public static $customMessages = [
    	'required' => 'Cuidado!! el campo :attribute no puede ser vacío',
    	'unique' => 'Error! el valor de :attribute ya se encuentra registrado',
    	'max' => 'Error! el valor de :attribute supero el tope permitido',
		'integer' => 'Error! el valor de :attribute debe ser un número sin comas ni puntos'
	];	
	
	public static function rules(Request $request, $id = null)
    {
		
     	$rules = [
        	'nombre' => 'required|string',
        	'clase_lista_id' => 'required'
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
}