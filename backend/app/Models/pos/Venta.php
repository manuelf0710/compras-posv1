<?php

namespace App\Models\pos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venta extends Model
{
	use Notifiable;
    public $timestamps = true;
    use SoftDeletes;
    protected $fillable = [
        'cliente_id', 'vendedor_id', 'comision_id', 'impuesto', 'neto', 'total', 'metodo_pago'
    ];
    protected $dates = ['deleted_at'];
    protected $hidden = ['updated_at','deleted_at'];
	
    public static $rules = [
        'cliente_id' => 'required',
        'vendedor_id' => 'required',
        'comision_id' => 'required',
        'impuesto' => 'required',
        'neto' => 'required',
        'total' => 'required',
        'metodo_pago' => 'required',
    ];
		public static $customMessages = [
    	'required' => 'Cuidado!! el campo :attribute no puede ser vacío',
    	'unique' => 'Error! el número de :attribute ya se encuentra registrado',
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
	
  public function cliente()
  {
	return $this->belongsTo('App\Models\pos\Cliente', 'cliente_id', 'id');
  }
  public function vendedor()
  {
	return $this->belongsTo('App\User', 'vendedor_id', 'id' );
  }
  public function comision()
  {
	return $this->belongsTo('App\User', 'comision_id', 'id');
  }
    public function scopeCliente($query, $term)
    {	
		if($term){
        return $query->join('clientes', function($join) use ($term)
            {
                $join->on('ventas.cliente_id', '=', 'clientes.id')
					//->whereNull('clientes.deleted_at')
                    ->where('clientes.nombre', 'like', "%$term%");
            });
		}
		
    }
	public	function scopeVendedor($query, $term){
		if($term){
        return $query->join('users', function($join) use ($term)
            {
                $join->on('ventas.vendedor_id', '=', 'users.id')
					//->where('users.perfil', '=', '2')
                    ->where('users.name', 'like', "%$term%");
            });
		}		
	}
	public function scopeFactura($query, $cat){
		if($cat)
			return $query->where('codigo_factura', '=', "$cat");
	}
	public function scopeFacturaDesde($query, $cat){
		if($cat)
			return $query->where('ventas.created_at', '>=', "$cat");
	}		
	public function scopeFacturaHasta($query, $cat){
		if($cat)
			return $query->whereDate('ventas.created_at', '<=', "$cat");
	}	
	
}
