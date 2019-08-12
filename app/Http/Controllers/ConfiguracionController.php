<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Configuracion;

class ConfiguracionController extends Controller
{
	public function listadoEncargados(){
		return view('configuracion.listado-encargados');
	}

	public function tbody(){
		return datatables()
			->eloquent(Configuracion::query())
			->addColumn('editar', 'configuracion/boton-editar')
			->addColumn('cambiarestatus', 'configuracion/boton-estatus')
			->rawColumns(['editar', 'cambiarestatus'])->toJson();
	}

	public function create(Request $request){

		// Validara los campos para evitar problemas 
		$validate = $request->validate([
			'nombre' => 'required|string|max:50',
            'apellidopaterno' => 'required|string|max:30',
            'apellidomaterno' => 'required|string|max:30',
            'puesto' => 'required|string'
	    ]);

	    // Se reciben los datos del formulario creando un Array de datos 
		$datos = [
			'nombre' => $request->input('nombre'),
            'apellidopaterno' => $request->input('apellidopaterno'),
            'apellidomaterno' => $request->input('apellidomaterno'),
            'puesto' => $request->input('puesto'),
            'activo' => 1
		];

		// Retornamos los datos a la peticion Ajax al mismo tiempo en que se almacena en la BD
	    return Configuracion::create($datos);
	}

	public function editarEncargado($id){
    	$encargado = Configuracion::find($id);
    	return $encargado;
    }

    public function update(Request $request){

		/* Se selecciona el gestor para ser modificado */
		$id = $request->input('id');
		$encargado = Configuracion::find($id);

		/* Validara los campos para evitar problemas */
		$validate = $this->validate($request,[
            'nombre' => 'required|string|max:50',
            'apellidopaterno' => 'required|string|max:30',
            'apellidomaterno' => 'required|string|max:30',
            'puesto' => 'required|string'
		]);

		$nombre = $request->input('nombre');
		$apellidopaterno = $request->input('apellidopaterno');
		$apellidomaterno = $request->input('apellidomaterno');
		$puesto = $request->input('puesto');

        /* Una ves verificados los datos y creados las variables se actualiza en la BD */
		$encargado->nombre = $nombre;
		$encargado->apellidopaterno = $apellidopaterno;
		$encargado->apellidomaterno = $apellidomaterno;
		$encargado->puesto = $puesto;
		$encargado->update();

        return $encargado;

	}

	public function updateEstatus(Request $request){

		$id = $request->input('id');
		$encargado = Configuracion::find($id);

		$validate = $this->validate($request,[
       		'activo' => 'required|max:1',
		]);

		$activo = $request->input('activo');

		$encargado->activo = $activo;
		$encargado->update();

    	return $encargado;

	}

}
