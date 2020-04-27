<?php
namespace App\Http\Controllers\pos\administracion;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\pos\administracion\Impuesto;
use Yajra\Datatables\Datatables;
//use Validator;
use App\Http\Controllers\Controller;
use App\Models\Lista;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
    }
	public function inventariodata(){
		$razones = Lista::withoutTrashed()->where('clase_lista_id','=','1')->get();
		$almacenes = Lista::withoutTrashed()->where('clase_lista_id','=','2')->get();
		
		$response = array(
						"razones" => $razones,
						"almacenes" => $almacenes
		);
		return response()->json($response);
	}		
    public function store(Request $request)
    {

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
		//return response()->json($response);
    }
    public function destroy($id)
    {

    }    
}
