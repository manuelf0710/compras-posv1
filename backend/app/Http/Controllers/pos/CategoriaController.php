<?php

namespace App\Http\Controllers\pos;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Collection;
use Illuminate\Http\Request;
//use App\Categoria; /* entitie model */
use App\Models\pos\Categoria;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

		//$response = Categoria::withoutTrashed()->get();
		$response = Categoria::withoutTrashed()->orderBy('id', 'desc');
		return Datatables::of(Categoria::query())->make(true);
		return datatables()->eloquent($response)
            ->toJson();       
    }
    public function listado(Request $request)
    {
        $pageSize = $request->get('pageSize');
		$pageSize == '' ? $pageSize = 20 : $pageSize;
		
        $categoria = $request->get('categoria');
        $globalSearch = $request->get('globalsearch');
		
		if($globalSearch != ''){
			$response = Categoria::withoutTrashed()->orderBy('id', 'desc')
			->globalSearch($globalSearch)
			->paginate($pageSize);		
		}else{
			$response = Categoria::withoutTrashed()->orderBy('id', 'desc')
			->categoria($categoria)
			->paginate($pageSize);
		}						
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
        $categoria = $request->all();
		if( is_null( $categoria['id'] ) ) {
		    $categoria_nueva = new Categoria();
			$categoria_nueva->nombre = $categoria['nombre'];
			$categoria_nueva->save();
		  	$response = array(
			  'status' => 'ok',
			  'data'   => $categoria_nueva,
			);
			return response()->json($response);
		}else{
			return "update";
		}
		//return response()->json($categoria);
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
		$categoria = Categoria::find( $id );
		$categoria->nombre = $request->nombre;
			$categoria->save();
		  	$response = array(
			  'status' => 'ok',
			  'data'   => $categoria,
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
        $find = Categoria::find($id);
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
