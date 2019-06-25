<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inspector;
use App\Gestor;
use App\TipoDeInspeccion;

class InspeccionController extends Controller
{
	// Muetra la vista del listado de las inspecciones
	public function listadoInspecciones(){
		$inspectores = Inspector::all();
		$gestores = Gestor::all();
		$tipoInspecciones = TipoDeInspeccion::all();
		return view('inspeccion.listado-inspecciones', [
			'inspectores' => $inspectores,
			'gestores' => $gestores,
			'tipoInspecciones' => $tipoInspecciones
		]);
	}
}
