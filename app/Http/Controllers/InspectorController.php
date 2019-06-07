<?php

namespace App\Http\Controllers;

use App\Inspector;
use Illuminate\Http\Request;

class InspectorController extends Controller
{
	public function listadoInspectores(){
		$inspectores = Inspector::all();
		return view('inspector.listado-inspectores', [
    		'inspectores' => $inspectores
    	]);
	}

	public function tbody(){
		$inspectores = Inspector::all();
		return view('inspector.tbody-inspectores',[
			'inspectores' => $inspectores
		]);
	}


	public function registroInspector(){
		return view('inspector.registro-inspector');
	}

	public function create(Request $request){

		// Validara los campos para evitar problemas 
		$validate = $request->validate([
			'nombre' => 'required|string|max:50',
            'apellidopaterno' => 'required|string|max:30',
            'apellidomaterno' => 'required|string|max:30',
            'clave' => 'required|string|max:50',
            'estatus' => 'required|string|max:1'
	    ]);

	    // Se reciben los datos del formulario creando un Array de datos 
		$datos = [
			'idusuario' => \Auth::user()->id,
			'nombre' => $request->input('nombre'),
            'apellidopaterno' => $request->input('apellidopaterno'),
            'apellidomaterno' => $request->input('apellidomaterno'),
            'clave' => $request->input('clave'),
            'estatus' => $request->input('estatus')
		];

		// Retornamos los datos a la peticion Ajax al mismo tiempo en que se almacena en la BD
	    return Inspector::create($datos);
	}

	public function editarInspector($id){

    	$inspector = Inspector::where('id', $id)->first();

    	return view('inspector.registro-inspector', [
    		'inspector' => $inspector
    	]);
    }

	public function update(Request $request){

		/* Se reciben la id del inspector que se esta modificando */
		$id = $request->input('id');

		/* Se selecciona el inspector para ser modificado */
		$inspector = Inspector::where('id', $id)->first();

		/* Validara los campos para evitar problemas */
		$validate = $this->validate($request,[
			'nombre' => 'required|string|max:50',
            'apellidopaterno' => 'required|string|max:30',
            'apellidomaterno' => 'required|string|max:30',
            'clave' => 'required|string|max:10|unique:inspector,clave,' . $id,
            'estatus' => 'required|string|max:1'
		]);

		/* Optiene la id del usuario administrador que modifica los inspectores */
		$idUser = \Auth::user()->id;
		/* Se reciben los datos del formulario y se crean variables */
		$nombre = $request->input('nombre');
		$apellidopaterno = $request->input('apellidopaterno');
		$apellidomaterno = $request->input('apellidomaterno');
		$clave = $request->input('clave');
		$estatus = $request->input('estatus');

        /* Una ves verificados los datos y creados las variables se actualiza en la BD */
		$inspector->idusuario = $idUser;
		$inspector->nombre = $nombre;
		$inspector->apellidopaterno = $apellidopaterno;
		$inspector->apellidomaterno = $apellidomaterno;
		$inspector->clave = $clave;
		$inspector->estatus = $estatus;
		$inspector->update();

        /* Una vez actualizado el inspector redirige e indica que fue correcta la modificación del inspector */
    	return redirect()->route('listado-inspectores')->with('status', 'Inspector Modificado');

	}

	public function delete($id){

		$inspector = Inspector::where('id', $id)->delete();

    	return redirect()->route('listado-inspectores')->with('status', 'Inspector Eliminado');
	}

}
