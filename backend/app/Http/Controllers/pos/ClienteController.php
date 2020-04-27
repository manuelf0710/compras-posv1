<?php

namespace App\Http\Controllers\pos;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\pos\Cliente;
use Yajra\Datatables\Datatables;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function buscarcliente(Request $request)
    {
		
	}
	public function listado(Request $request)
    {
        $pageSize = $request->get('pageSize');
		$pageSize == '' ? $pageSize = 20 : $pageSize;
		
        $nombre = $request->get('nombre');
        $documento = $request->get('documento');
        $email = $request->get('email');
        $globalSearch = $request->get('globalsearch');		
		if($globalSearch != ''){
			$response = Cliente::withoutTrashed()->orderBy('id', 'desc')
			->globalSearch($globalSearch)
			->paginate($pageSize);		
		}else{
			$response = Cliente::withoutTrashed()->orderBy('id', 'desc')
			->nombre($nombre)
			->documento($documento)
			->email($email)
			->paginate($pageSize);
		}
						
		return response()->json($response); 
    }   
	public function index(Request $request)
    {
		/*$response = Cliente::withoutTrashed()->orderBy('id', 'desc');
		return datatables()->eloquent($response)
            ->toJson();*/
        $nombre = $request->get('nombre');
        $documento = $request->get('documento');
        $email = $request->get('email');
        $fecha = $request->get('fecha_nacimiento');
        $globalSearch = $request->get('globalSearch');
		//return $fecha;
		/*return $request->get('globalSearch');
		if($globalSearch != ''){
			$nombre = $request->get('globalSearch');
        	$documento = $request->get('globalSearch');
        	$email = $request->get('globalSearch');			
		} */
		
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
		//$validator = $request->validate(Cliente::$rules);
		
		$validator = Validator::make( $request->all() , Cliente::$rules, Cliente::$customMessages );	
		//exit("aqui entro");
		$modelo = new Cliente();
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
			  'code' => 200,
			  'data'   => $modelo,
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
			  'code' => 200,
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
        $find = Cliente::find($id);
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
