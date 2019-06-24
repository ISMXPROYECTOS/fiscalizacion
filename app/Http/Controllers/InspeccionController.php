<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InspeccionController extends Controller
{
	// Muetra la vista del listado de las inspecciones
	public function listadoInspecciones(){
		return view('inspeccion.listado-inspecciones');
	}
}
