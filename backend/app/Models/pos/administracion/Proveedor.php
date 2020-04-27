<?php

namespace App\Models\pos\administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Proveedor extends Model
{
	use Notifiable;
	protected $table = "proveedores";
    public $timestamps = true;
    use SoftDeletes;
	
    protected $fillable = [
        'nombre', 'valor'
    ];	

    protected $dates = ['deleted_at'];
    protected $hidden = ['updated_at','deleted_at'];
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
        	'nombre' => 'required',
			'tipo_identidad'=>'required',
			'tipo_persona'=>'required',
    	];		
        switch( $request->method() )
        {
            case 'POST':
            {
 				return array_merge( $rules, ['registro' => 'required|unique:proveedores', ] );
            }
            case 'PUT':
            {
				return array_merge( $rules, ['registro' => 'required|unique:proveedores,id,'. $id, ] );
            }
            default:break;
        }
    }	
	
	public function scopeNombre($query, $cod){
		if($cod)
			return $query->where('nombre', 'like', "%$cod%");
	}	
	public function scopeRegistro($query, $cod){
		if($cod)
			return $query->where('registro', 'like', "%$cod%");
	}	
	
	public function scopeGlobalSearch($query, $term){
		if($term){
			return $query->Where('nombre', 'like', "%$term%")
						 ->orWhere('registro', 'like', "%$term%");
		}			
		
	}
}
