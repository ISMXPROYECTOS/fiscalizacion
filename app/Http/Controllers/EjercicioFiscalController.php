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
			'anio' => 'required|string|min:4|max:4|unique:ejerciciofiscal',
	    ]);

		$datos = [
			'anio' => $request->input('anio'),
			'activo' => 1
		];

		// Retornamos los datos a la peticion Ajax, al mismo tiempo en se almacena en la BD
	    return EjercicioFiscal::create($datos);
	}

	public function editarEjercicioFiscal($id){
    	$ejercicioFiscal = EjercicioFiscal::find($id);
    	return $ejercicioFiscal;
    }

    public function update(Request $request){
		// Se reciben la id del ejercicioFiscal que se esta modificando
		$id = $request->input('id');

		// Se selecciona el ejercicioFiscal para ser modificado
		$ejercicioFiscal = EjercicioFiscal::find($id);

		// Validará los campos para evitar problemas
		$validate = $this->validate($request,[
            'anio' => 'required|string|min:4|max:4|unique:ejerciciofiscal,anio,' . $id
		]);

		// Se reciben los datos del formulario y se crean variables
		$anio = $request->input('anio');

        // Una ves verificados los datos y creados las variables se actualiza en la BD
		$ejercicioFiscal->anio = $anio;
		$ejercicioFiscal->update();

        // Indica que fue correcta la modificación
    	return $ejercicioFiscal;
	}

	public function updateEstatus(Request $request){
		// Se reciben la id del ejercicioFiscal que se esta modificando
		$id = $request->input('id');

		// Se selecciona el ejercicioFiscal para ser modificado
		$ejercicioFiscal = EjercicioFiscal::find($id);

		// Validara los campos para evitar problemas
		$validate = $this->validate($request,[
       		'activo' => 'required|string',
		]);

		// Se reciben los datos del formulario y se crean variables
		$activo = $request->input('activo');

        // Una ves verificados los datos y creados las variables se actualiza en la BD
		$ejercicioFiscal->activo = $activo;
		$ejercicioFiscal->update();

        // Indica que fue correcta la modificación
    	return $ejercicioFiscal;

	}
	
}
