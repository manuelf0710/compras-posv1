<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\pos\Cliente;
use Yajra\Datatables\Datatables;
use Barryvdh\DomPDF\Facade as PDF;

class ClienteWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function listado(Request $request){
        $clientes = Cliente::withoutTrashed()->get();
		$pdf = PDF::loadView('pdf.clientes', compact('clientes'));		
		return $pdf->stream();
	}
	
    public function listado2(Request $request)
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
        //
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
        //
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
