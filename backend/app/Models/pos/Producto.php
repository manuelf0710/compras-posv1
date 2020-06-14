<?php

namespace App\Models\pos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Producto extends Model
{
	use Notifiable;
    public $timestamps = true;
    use SoftDeletes;
	
    protected $fillable = [
        'codigo', 'barras', 'descripcion', 'stock', 'precio_compra', 'precio_venta', 'precio_ventaimpuesto', 'imagen'
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
        	'descripcion' => 'required|string',
        	'stock' => 'required',
        	'precio_compra' => 'required',
        	'precio_venta' => 'required',
        	'precio_ventaimpuesto' => 'required',
    	];		
        switch( $request->method() )
        {
            case 'POST':
            {
 				return array_merge( $rules, ['codigo' => 'required|unique:productos', ] );
            }
            case 'PUT':
            {
				return array_merge( $rules, ['codigo' => 'required|string|unique:productos,id,'. $id, ] );
            }
            default:break;
        }
    }	
	
	public function scopeCodigo($query, $cod){
		if($cod)
			return $query->where('codigo', 'like', "%$cod%");
	}
	public function scopeDescripcion($query, $des){
		if($des)
			return $query->where('descripcion', 'like', "%$des%");
	}	
	public function scopeCategoria($query, $cat){
		if($cat)
			return $query->where('categoria_id', '=', "$cat");
	}
	
	public function scopeGlobalSearch($query, $term){
		if($term){
			return $query->Where('descripcion', 'like', "%$term%")
						 ->orWhere('codigo', 'like', "%$term%");
			
			/*
        return $query->join('categorias', function($join) use ($term)
            {
                $join->on('productos.categoria_id', '=', 'categorias.id')
                    ->where('categorias.nombre', 'like', "%$term%")
					->Where('productos.descripcion', 'like', "%$term%")
					->orWhere('productos.codigo', 'like', "%$term%");
            });*/
		}			
		
	}	
	
  public function categoria()
  {
    //return $this->hasOne(Categoria::class);
	return $this->belongsTo('App\Models\pos\Categoria');
  }  
  public function precioLista()
  {
    //return $this->hasOne(Categoria::class);
	return $this->hasMany('App\Models\pos\PrecioLista');
  }
}
