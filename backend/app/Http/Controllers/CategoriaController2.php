<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Collection;
use Illuminate\Http\Request;
//use App\Categoria; /* entitie model */
use App\Models\pos\Categoria;
use Yajra\Datatables\Datatables;

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
        //
    }
}
