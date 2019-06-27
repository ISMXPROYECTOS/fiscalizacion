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

	public function create(Request $request){

		// aqui pienso que debe ir un for que recorra todo lo que estamos enviando y despues validar y toda la wea 

		var_dump($request); // este trae toda la request y el array

		$validate = $request->validate([
			'cantidad' => 'required|string',
            'inspector' => 'required|string'
	    ]);

		$datos = [
			'cantidad' => $request->input('cantidad'),
            'inspector' => $request->input('inspector')
		];

	    $cantidades = $request->input('cantidad');
	    var_dump($cantidades);
	    

	    return $cantidades;
	}

}
