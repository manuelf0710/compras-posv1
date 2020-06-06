<?php
namespace App\Http\Controllers\pos\administracion;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\pos\administracion\Proveedor;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Models\Lista;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
    public function dataformproveedor(Request $request)
    {
		$regimenes = Lista::withoutTrashed()->where('clase_lista_id','=','3')->get();		
		$response = array(
						"regimenes" => $regimenes
		);
		return response()->json($response);
	}
	public function listado(Request $request)
    {
        $pageSize = $request->get('pageSize');
		$pageSize == '' ? $pageSize = 20 : $pageSize;
		
        $nombre = $request->get('nombre');
        $registro = $request->get('registro');
        $globalSearch = $request->get('globalsearch');
		
		if($globalSearch != ''){
			//$response = Proveedor::select('id','registro','nombre','tipo_persona')->withoutTrashed()->orderBy('id', 'desc')
			$response = Proveedor::withoutTrashed()->orderBy('id', 'desc')
			->globalSearch($globalSearch)
			->paginate($pageSize);		
		}else{
			$response = Proveedor::withoutTrashed()->orderBy('id', 'desc')
			->nombre($nombre)
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
		$validator = Validator::make($request->all() , Proveedor::rules($request) , Proveedor::$customMessages );		
		 if(!($validator -> fails())){
			$modelo = new Proveedor();
			$modelo->registro = $request->registro;
			$modelo->digito   = $request->digito;
			$modelo->nombre   = $request->nombre;
			$modelo->tel      = $request->tel;
			$modelo->web      = $request->web;
			$modelo->direccion= $request->direccion;
			$modelo->cont1    = $request->cont1;
			$modelo->tel1     = $request->tel1;
			$modelo->cargo1   = $request->cargo1;
			$modelo->cont2    = $request->cont2;
			$modelo->tel2     = $request->tel2;
			$modelo->cargo2   = $request->cargo2;
			$modelo->comentario = $request->comentario;
			$modelo->correo   = $request->correo;
			$modelo->tipo_identidad   = $request->tipo_identidad;
			$modelo->tipo_persona   = $request->tipo_persona;
			$modelo->regimen   = $request->regimen == '' ? 14: $request->regimen;
			$modelo->autoretenedor   = $request->autoretenedor == '' ? 2 : $request->autoretenedor;
			$modelo->gcontrib   = $request->gcontrib == '' ? 2 : $request->gcontrib;
			$modelo->ica   = $request->ica == '' ? 2 : $request->ica;
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

    public function show($id)
    {

    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
		$rules = Proveedor::rules($request, $request->registro, $request->nombre);
		$validator = Validator::make( $request->all() , $rules , Proveedor::$customMessages );
		
		$modelo = Proveedor::find( $id );
		 if(!($validator -> fails())){
			$modelo->registro = $request->registro;
			$modelo->digito   = $request->digito;
			$modelo->nombre   = $request->nombre;
			$modelo->tel      = $request->tel;
			$modelo->web      = $request->web;
			$modelo->direccion= $request->direccion;
			$modelo->cont1    = $request->cont1;
			$modelo->tel1     = $request->tel1;
			$modelo->cargo1   = $request->cargo1;
			$modelo->cont2    = $request->cont2;
			$modelo->tel2     = $request->tel2;
			$modelo->cargo2   = $request->cargo2;
			$modelo->comentario = $request->comentario;
			$modelo->correo   = $request->correo;
			$modelo->tipo_identidad   = $request->tipo_identidad;
			$modelo->tipo_persona   = $request->tipo_persona;
			$modelo->regimen   = $request->regimen == '' ? 14: $request->regimen;
			$modelo->autoretenedor   = $request->autoretenedor == '' ? 2 : $request->autoretenedor;
			$modelo->gcontrib   = $request->gcontrib == '' ? 2 : $request->gcontrib;
			$modelo->ica   = $request->ica == '' ? 2 : $request->ica;
			$modelo->save();
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
        $find = Impuesto::find($id);
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
