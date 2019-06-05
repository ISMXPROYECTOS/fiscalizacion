<?php

namespace App\Http\Controllers;

use App\Gestor;
use Illuminate\Http\Request;

class GestorController extends Controller
{
	public function listadoGestores(){
		/* Se solicita a la bd todos los gestores para listarlos */
		$gestores = Gestor::all();
		return view('gestor.listado-gestores', [
    		'gestores' => $gestores
    	]);
	}

	public function registroGestores(){
		return view('gestor.registro-gestores');
	}

	public function create(Request $request){

		/* Validara los campos para evitar problemas */
		$validate = $this->validate($request,[
			'nombre' => 'required|string|max:50',
            'apellidopaterno' => 'required|string|max:30',
            'apellidomaterno' => 'required|string|max:30',
            'telefono' => 'required|string|max:50',
            'celular' => 'required|string|max:50',
            'correoelectronico' => 'required|string|max:75|unique:gestores',
            'ine' => 'required|string|max:30|unique:gestores',
            'estatus' => 'required|string|max:1'
		]);

		/* Optiene la id del usuario administrador que crea los gestores */
		$id = \Auth::user()->id;
		/* Se reciben los datos del formulario y se crean variables */
		$nombre = $request->input('nombre');
		$apellidopaterno = $request->input('apellidopaterno');
		$apellidomaterno = $request->input('apellidomaterno');
		$telefono = $request->input('telefono');
		$celular = $request->input('celular');
		$correoelectronico = $request->input('correoelectronico');
		$ine = $request->input('ine');
		$estatus = $request->input('estatus');

		/* Una ves verificados los datos y creados las variables se inserta en la BD */
		Gestor::create([
			'idusuario' => $id,
            'nombre' => $nombre,
            'apellidopaterno' => $apellidopaterno,
            'apellidomaterno' => $apellidomaterno,
            'telefono' => $telefono,
            'celular' => $celular,
            'correoelectronico' => $correoelectronico,
            'ine' => $ine,
            'estatus' => $estatus,
        ]);

		/* Una vez agregado el nuevo gestor redirige e indica que fue correcta la creación del gestor */
    	return redirect()->route('listado-gestores')->with('status', 'Gestor Creado');

	}

	public function editarGestor($id){

    	$gestor = Gestor::where('id', $id)->first();

    	return view('gestor.registro-gestores', [
    		'gestor' => $gestor
    	]);
    }

    public function update(Request $request){

		/* Se reciben la id del gestor que se esta modificando */
		$id = $request->input('id');

		/* Se selecciona el gestor para ser modificado */
		$gestor = Gestor::where('id', $id)->first();

		/* Validara los campos para evitar problemas */
		$validate = $this->validate($request,[
            'nombre' => 'required|string|max:50',
            'apellidopaterno' => 'required|string|max:30',
            'apellidomaterno' => 'required|string|max:30',
            'telefono' => 'required|string|max:50',
            'celular' => 'required|string|max:50',
            'correoelectronico' => 'required|string|max:75|unique:gestores,correoelectronico,' . $id,
            'ine' => 'required|string|max:30|unique:gestores,ine,' . $id,
            'estatus' => 'required|string|max:1'
		]);

		/* Optiene la id del usuario administrador que modifica los gestores */
		$idUser = \Auth::user()->id;
		/* Se reciben los datos del formulario y se crean variables */
		$nombre = $request->input('nombre');
		$apellidopaterno = $request->input('apellidopaterno');
		$apellidomaterno = $request->input('apellidomaterno');
		$telefono = $request->input('telefono');
		$celular = $request->input('celular');
		$correoelectronico = $request->input('correoelectronico');
		$ine = $request->input('ine');
		$estatus = $request->input('estatus');

        /* Una ves verificados los datos y creados las variables se actualiza en la BD */
		$gestor->idusuario = $idUser;
		$gestor->nombre = $nombre;
		$gestor->apellidopaterno = $apellidopaterno;
		$gestor->apellidomaterno = $apellidomaterno;
		$gestor->telefono = $telefono;
		$gestor->celular = $celular;
		$gestor->correoelectronico = $correoelectronico;
		$gestor->ine = $ine;
		$gestor->estatus = $estatus;
		$gestor->update();

        /* Una vez actualizado el gestor redirige e indica que fue correcta la modificación del gestor */
    	return redirect()->route('listado-gestores')->with('status', 'Gestor Modificado');

	}

	public function delete($id){

		$gestor = Gestor::where('id', $id)->delete();

    	return redirect()->route('listado-gestores')->with('status', 'Gestor Eliminado');
	}

}
