<?php
namespace App\Http\Controllers\pos\administracion;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\pos\administracion\Impuesto;
use Yajra\Datatables\Datatables;
//use Validator;
use App\Http\Controllers\Controller;
//use App\Models\pos\administracion\Impuesto;

class ImpuestoController extends Controller
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
	 
    public function listado(Request $request)
    {
        $pageSize = $request->get('pageSize');
		$pageSize == '' ? $pageSize = 20 : $pageSize;
		
        $nombre = $request->get('nombre');
        $globalSearch = $request->get('globalsearch');
		
		if($globalSearch != ''){
			$response = Impuesto::withoutTrashed()->orderBy('id', 'desc')
			->globalSearch($globalSearch)
			->paginate($pageSize);		
		}else{
			$response = Impuesto::withoutTrashed()->orderBy('id', 'desc')
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
        $data = $request->all();
		if( is_null( $data['id'] ) ) {
		    $impuesto_nuevo = new Impuesto();
			$impuesto_nuevo->nombre = $data['nombre'];
			$impuesto_nuevo->valor  = $data['valor'];
			$impuesto_nuevo->save();
		  	$response = array(
			  'status' => 'ok',
			  'data'   => $impuesto_nuevo,
			);
			return response()->json($response);
		}else{
			return "update";
		}
		//return response()->json($categoria);
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
		$modelo = Impuesto::find( $id );
		$modelo->nombre = $request->nombre;
		$modelo->valor  = $request->valor;
			$modelo->save();
		  	$response = array(
			  'status' => 'ok',
			  'data'   => $modelo,
			);
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
