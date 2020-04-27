<?php

namespace App\Http\Controllers\pos;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\pos\Venta;
use App\Models\pos\ProductoVenta;
use Yajra\Datatables\Datatables;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listado(Request $request)
    {
        $pageSize = $request->get('pageSize');
		$pageSize == '' ? $pageSize = 20 : $pageSize;
		
        $nombre = $request->get('nombre');
        $documento = $request->get('documento');
        $email = $request->get('email');
        $cliente = $request->get('cliente');
        $vendedor = $request->get('vendedor');
        $codigo_factura = $request->get('codigo_factura');
        $factura_desde = $request->get('factura_desde');
        $factura_hasta = $request->get('factura_hasta');
		
		
        $globalSearch = $request->get('globalsearch');
		
		
		if($globalSearch != ''){
			$response = Venta::with('cliente','vendedor','comision')->withoutTrashed()->orderBy('ventas.id', 'desc')
			->globalSearch($globalSearch)
			->paginate($pageSize);		
		}else{
			$response = Venta::with('cliente','vendedor','comision')->withoutTrashed()->orderBy('ventas.id', 'desc')
			 ->cliente($cliente)
			 ->vendedor($vendedor)
			 ->factura($codigo_factura)
			 ->facturaDesde($factura_desde)
			 ->facturaHasta($factura_hasta)
			->paginate($pageSize);
		}
						
		return response()->json($response); 
    }   
	public function index(Request $request)
    {
        $nombre = $request->get('nombre');
        $documento = $request->get('documento');
        $email = $request->get('email');
        $fecha = $request->get('fecha_nacimiento');
        $globalSearch = $request->get('globalSearch');
		
        $pageSize = $request->get('pageSize');
		$pageSize == '' ? $pageSize = 20 : $pageSize;	
		$response = Cliente::withoutTrashed()->orderBy('id', 'desc')
					->nombre($nombre)
					->documento($documento)
					->email($email)
					->paginate($pageSize);
		return response()->json($response); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
		
		//$validator = Validator::make( $request->all() , Cliente::$rules, Cliente::$customMessages );	
		$modelo = new Venta();
		$modelo->codigo_factura = 3;
		$modelo->cliente_id = 3;
		$modelo->vendedor_id = 2;
		$modelo->comision_id = 2;
		$modelo->porcentaje_comision = 2;
		$modelo->impuesto = $request->get('impuesto');
		$modelo->neto = $request->get('total');
		$modelo->total = $request->get('total');
		$modelo->metodo_pago = 'Efectivo';
		$modelo->save();
		
		 foreach ( $request->get('productosVenta') as $producto) {
    		$productos[] = [
        		'producto_id' => $producto['id'],
        		'venta_id'    => $modelo['id'],
        		'cantidad'    => $producto['cantidad'],
        		'precio_unitario' => $producto['precio_venta'],
        		'precio_total' => $producto['cantidad'] * $producto['precio_venta'],
				'created_at' => date('Y-m-d H:i:s')
    			];
			}
			
			ProductoVenta::insert($productos);
		  	$response = array(
			  'status' => 'ok',
			  'data'   => $modelo,
			  'msg'    => 'Guardado'
			);
		 return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		//$validator = $request->validate(Producto::$rules);
		$rules = Cliente::rules($request, $request->documento);
		$validator = Validator::make( $request->all() , $rules , Cliente::$customMessages );
		
		$modelo = Cliente::find( $id );
		 if(!($validator -> fails())){
			$modelo->nombre = $request->nombre;
			$modelo->documento = $request->documento;
			$modelo->email = $request->email;
			$modelo->telefono = $request->telefono;
			$modelo->direccion = $request->direccion;
			$modelo->fecha_nacimiento = $request->fecha_nacimiento;
			$modelo->save();
		  	$response = array(
			  'status' => 'ok',
			  'data'   => $modelo,
			  'msg'    => 'Actualizado',
			);
		 }else{
			 $response = array(
			 	'status' => 'error',
				'msg' => $validator->errors(),
				'validator'=> $validator 
			 );
		 }
		 return response()->json($response);         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $find = Venta::find($id);
		if (! empty($find)) {
            $find->delete();
            $response = [
                'status' => 'success',
                'code' => 200,
                'data' => $find,
				'msg'  => 'Registro eliminado'
            ];			
		}else{
		    $response = [
                'status' => 'error',
                'msg' => "Se ha presentado un error",
            ];
		}
		return response()->json($response);	
    }
}
