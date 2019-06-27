<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inspeccion;
use App\Inspector;
use App\Gestor;
use App\TipoDeInspeccion;

class InspeccionController extends Controller
{
	// Muetra la vista del listado de las inspecciones
	public function listadoInspecciones(){
		$inspectores = Inspector::all();
		return view('inspeccion.listado-inspecciones', [
			'inspectores' => $inspectores
		]);
	}

	public function tbody(){
		return datatables()
			->eloquent(Inspeccion::query())
			->addColumn('btn', 'inspeccion/actions-inspecciones')
			->rawColumns(['btn'])->toJson();
	}

	public function create(Request $request){

		$data = $request->all();
    	$cantidades = array_get($data, 'cantidad');
    	$inspectores = array_get($data, 'inspector');

		// Valida cada array en cada posición con el .*
		$this->validate($request, [
            'cantidad.*' => 'required|string',
            'inspector.*' => 'required|string'
        ]);

    	for ($i = 0; $i < count($cantidades); $i++) {
    		$cantidad = $cantidades[$i];
    		for ($a = 0; $a < $cantidad; $a++) {
    			$datos = [
    				'idinspector' => $inspectores[$i]
    			];
    			Inspeccion::create($datos);
    		}
    	}

    	return $datos;
	}

}
