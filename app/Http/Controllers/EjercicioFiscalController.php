<?php

namespace App\Http\Controllers;

use App\EjercicioFiscal;
use Illuminate\Http\Request;

class EjercicioFiscalController extends Controller
{
	// Muetra la vista del listado de los años fiscales
	public function listadoEjerciciosFiscales(){
		return view('ejercicioFiscal.listado-ejercicios-fiscales');
	}

	// Selecciona todos los años fiscales de la base de datos y los regresa a la función
	public function tbody(){
		return datatables()
			->eloquent(EjercicioFiscal::query())
			->addColumn('btn', 'ejercicioFiscal/actions-ejercicios-fiscales')
			->rawColumns(['btn'])->toJson();
	}

	// Valida la información antes de agregarla a la base de datos y despues regresa a la función el registro
	public function create(Request $request){

		$validate = $request->validate([
			'anio' => 'required|string|max:4'
	    ]);

		$datos = [
			'anio' => $request->input('ejercicio-fiscal'),
			'activo' => 1
		];

		// Retornamos los datos a la peticion Ajax, al mismo tiempo en se almacena en la BD
	    return EjercicioFiscal::create($datos);
	}
}
