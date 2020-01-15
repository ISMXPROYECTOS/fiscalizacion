<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Encargado;

class EncargadoController extends Controller
{
	public function listadoEncargados(){
		return view('encargado.listado-encargados');
	}

	public function tbody(){
		return Datatables::of(Encargado::query()->select([
			'id',
			'nombre',
			'apellidopaterno',
			'apellidomaterno',
			'puesto',
			'activo'
		]))
		->addColumn('editar', 'encargado/boton-editar')
		->addColumn('cambiarestatus', 'encargado/boton-estatus')
		->rawColumns(['editar', 'cambiarestatus'])
		->make(true);
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
	    return Encargado::create($datos);
	}

	public function editarEncargado($id){
    	$encargado = Encargado::find($id);
    	return $encargado;
    }

    public function update(Request $request){

		/* Se selecciona el gestor para ser modificado */
		$id = $request->input('id');
		$encargado = Encargado::find($id);

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
		$encargado = Encargado::find($id);

		$validate = $this->validate($request,[
       		'activo' => 'required|max:1',
		]);

		$activo = $request->input('activo');

		$encargado->activo = $activo;
		$encargado->update();

    	return $encargado;

	}
}
