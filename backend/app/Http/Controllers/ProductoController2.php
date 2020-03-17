<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
//use App\Producto; /* entitie model */
use App\Models\pos\Producto;
use Yajra\Datatables\Datatables;
//use Validator;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		//$response = Categoria::withoutTrashed()->get();
		$response = Producto::with('categoria')->withoutTrashed()->orderBy('id', 'desc');
		return datatables()->eloquent($response)
            //->setTransformer( new ComSedeTransformer() )
            ->toJson();
		//return $response;        
		    /*return datatables()
              ->of($response)
			  ->toJson();*/		
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
		$validator = $request->validate(Producto::$rules);
		$validator = Validator::make( $request->all() , Producto::$rules );	
		$producto = new Producto();
		 if(!($validator -> fails())){
			$producto->categoria_id = $request->categoria_id;
			$producto->codigo = $request->codigo;
			$producto->descripcion = $request->descripcion;
			$producto->stock = $request->stock;
			$producto->precio_compra = $request->precio_compra;
			$producto->precio_venta = $request->precio_venta;
			$producto->save();
		  	$response = array(
			  'status' => 'ok',
			  'data'   => $producto,
			  'msg'    => 'Guardado'
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
		$validator = Validator::make( $request->all() , Producto::$rules );	
		
		$producto = Producto::find( $id );
		 if(!($validator -> fails())){
			$producto->categoria_id = $request->categoria_id;
			$producto->codigo = $request->codigo;
			$producto->descripcion = $request->descripcion;
			$producto->stock = $request->stock;
			$producto->precio_compra = $request->precio_compra;
			$producto->precio_venta = $request->precio_venta;
			$producto->save();
		  	$response = array(
			  'status' => 'ok',
			  'data'   => $producto,
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
        //
    }
}
