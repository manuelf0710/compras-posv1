<?php

namespace App\Models\pos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Cliente extends Model
{
	use Notifiable;
    public $timestamps = true;
    use SoftDeletes;
	
    protected $fillable = [
        'nombre', 'documento',
    ];
	protected $dates = ['deleted_at'];
    protected $hidden = ['updated_at','deleted_at'];
	
    public static $rules = [
        'nombre' => 'required|string',
        'documento' => 'required|integer|unique:clientes'
    ];
	public static function rules(Request $request, $id = null)
    {
        switch( $request->method() )
        {
            case 'POST':
            {
                return [
                    'nombre' => 'required|string',
                    'nombre' => 'required|string|max:80'
                ];
            }
            case 'PUT':
            {
                return [
                    'nombre' => 'required|string',
                    'documento' => 'required|integer|unique:clientes,id,'. $id,
                ];
            }
            default:break;
        }
    }	
	
	
	public static $customMessages = [
    	'required' => 'Cuidado!! el campo :attribute no puede ser vacío',
    	'unique' => 'Error! el número de :attribute ya se encuentra registrado',
    	'max' => 'Error! el valor de :attribute supero el tope permitido',
		'integer' => 'Error! el valor de :attribute debe ser un número sin comas ni puntos'
	];	
	public function scopeNombre($query, $name){
		if($name)
			return $query->where('nombre', 'like', "%$name%");
	}
	public function scopeDocumento($query, $documento){
		if($documento)
			return $query->where('documento', 'like', "%$documento%");
	}	
	public function scopeEmail($query, $email){
		if($email)
			return $query->where('email', 'like', "%$email%");
	}
	public function scopeGlobalSearch($query, $s){
		if($s)
			return $query->where('nombre', 'like', "%$s%")
					->orwhere('documento', 'like', "%$s%");
	}
	
}
