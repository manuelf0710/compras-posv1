<?php

//namespace App\Http\Controllers;
namespace App\Http\Controllers\pos;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
//use App\Producto; /* entitie model */
use App\Models\pos\Producto;
use Yajra\Datatables\Datatables;
//use Validator;
use App\Http\Controllers\Controller;
use App\Models\pos\PrecioLista;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$response = Producto::with('categoria')->withoutTrashed()->orderBy('id', 'desc');
		return datatables()->eloquent($response)
            ->toJson();
    }
	public function storeproductoprecios($productosPreciosLista){
		//$productosPreciosLista = $request->precioslista;
		$producto_id = '';
		 foreach ($productosPreciosLista as $producto) {
			 $producto_id = $producto['producto_id'];
			 if($producto['id'] != ''){ 
					DB::table('precio_listas')
            			->where('id', $producto['id'])
            			->update(
						[
						'producto_id' => $producto['producto_id'],
						'nombre' => $producto['nombre'],
						'porcentaje' => $producto['porcentaje'],
						'valor' => $producto['valor'],
						'ganancia' => $producto['ganancia']],
						);
				}else{
					$modelo = new PrecioLista();
					$modelo->producto_id = $producto['producto_id'];
					$modelo->nombre = $producto['nombre'];
					$modelo->porcentaje = $producto['porcentaje'];
					$modelo->valor = $producto['valor'];
					$modelo->ganancia = $producto['ganancia'];
					$modelo->save();
				}
		 }
		//return $this->getPreciosLista($producto_id);
	}
	public function productoprecios(Request $request, $id){
		return $this->getPreciosLista($id);
	}
	public function getPreciosLista($id){
		$response = precioLista::select('id','producto_id','nombre','porcentaje','valor','ganancia')->withoutTrashed()
						->where('producto_id', '=', $id)
						->orderBy('id', 'desc')->get();
		return response()->json($response); 		
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
    public function listado(Request $request)
    {
        $pageSize = $request->get('pageSize');
		$pageSize == '' ? $pageSize = 20 : $pageSize;
		
        $codigo = $request->get('codigo');
        $descripcion = $request->get('descripcion');
        $categoria = $request->get('categoria');
        $globalSearch = $request->get('globalsearch');
		
		if($globalSearch != ''){
			$response = Producto::with('categoria')->withoutTrashed()->orderBy('productos.id', 'desc')
			->globalSearch($globalSearch)
			->paginate($pageSize);		
		}else{
			$response = Producto::with('categoria')->withoutTrashed()->orderBy('productos.id', 'desc')
			->codigo($codigo)
			->descripcion($descripcion)
			->categoria($categoria)
			->paginate($pageSize);
		}
						
		return response()->json($response); 
	}		
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
		$preciosLista = $request->precioslista;
		$validator = Validator::make( $request->producto , Producto::rules($request) , Producto::$customMessages );		
		 if(!($validator -> fails())){
			$producto = new Producto();
			$producto->categoria_id = $request->producto['categoria_id'];
			$producto->codigo = $request->producto['codigo'];
			$producto->descripcion = $request->producto['descripcion'];
			$producto->stock = $request->producto['stock'];
			$producto->precio_compra = $request->producto['precio_compra'];
			$producto->precio_venta = $request->producto['precio_venta'];
			$producto->precio_ventaimpuesto = $request->producto['precio_ventaimpuesto'];
			$producto->porcentaje = $request->producto['porcentaje'];
			$producto->imagen = $request->producto['imagen'];			
			$producto->save();
			for($i = 0; $i < count($preciosLista); $i++){
				$preciosLista[$i]['producto_id'] = $producto['id'];
			}
			$this->storeproductoprecios($preciosLista);
			
		  	$response = array(
			  'status' => 'ok',
			  'code' => 200,
			  'data'   => Producto::with('categoria','precioLista')->find( $producto['id'] ),
			  'msg'    => 'Guardado'
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
		$rules = Producto::rules($request, $request->producto['codigo']);
		$validator = Validator::make( $request->producto , $rules , Producto::$customMessages );
		
		$producto = Producto::find( $id );
		 if(!($validator -> fails())){
			$producto->categoria_id = $request->producto['categoria_id'];
			$producto->codigo = $request->producto['codigo'];
			$producto->descripcion = $request->producto['descripcion'];
			$producto->stock = $request->producto['stock'];
			$producto->precio_compra = $request->producto['precio_compra'];
			$producto->precio_venta = $request->producto['precio_venta'];
			if($request->producto['precio_venta'] != '' && $request->producto['precio_venta'] != null){
				$producto->imagen = $request->producto['imagen'];
			}
			$this->storeproductoprecios($request->precioslista);
			$producto->save();
		  	$response = array(
			  'status' => 'ok',
			  'code' => 200,
			  'data'   => Producto::with('categoria','precioLista')->find( $id ),
			  'msg'    => 'Actualizado',
			);
		 }else{
			 $response = array(
			 	'status' => 'error',
				'msg' => $validator->errors()
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
        $find = Producto::find($id);
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
	public function destroyprecio($id)
    {
        $find = precioLista::find($id);
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
