<?php

namespace App\Http\Controllers;

use App\Gestor;
use Illuminate\Http\Request;

class GestorController extends Controller
{
	public function listadoGestores(){
		return view('gestor.listado-gestores');
	}

	public function tbody(){
		$gestores = Gestor::all();
		return view('gestor.tbody-gestores',[
			'gestores' => $gestores
		]);
	}

	public function registroGestores(){
		return view('gestor.registro-gestores');
	}

	public function create(Request $request){

		// Validara los campos para evitar problemas 
		$validate = $request->validate([
			'nombre' => 'required|string|max:50',
            'apellidopaterno' => 'required|string|max:30',
            'apellidomaterno' => 'required|string|max:30',
            'telefono' => 'required|string|min:10|max:50',
            'celular' => 'required|string|min:10|max:50',
            'correoelectronico' => 'required|string|max:75|unique:gestores',
            'ine' => 'required|string|max:30|unique:gestores',
            'estatus' => 'required|string|max:1'
	    ]);

	    // Se reciben los datos del formulario creando un Array de datos 
		$datos = [
			'idusuario' => \Auth::user()->id,
			'nombre' => $request->input('nombre'),
            'apellidopaterno' => $request->input('apellidopaterno'),
            'apellidomaterno' => $request->input('apellidomaterno'),
            'telefono' => $request->input('telefono'),
            'celular' => $request->input('celular'),
            'correoelectronico' => $request->input('correoelectronico'),
            'ine' => $request->input('ine'),
            'estatus' => $request->input('estatus')
		];

		// Retornamos los datos a la peticion Ajax al mismo tiempo en que se almacena en la BD
	    return Gestor::create($datos);
	}


	public function editarGestor($id){

    	$gestor = Gestor::find($id);
    	echo json_encode($gestor);

    }

    public function update(Request $request, $id){

		/* Se selecciona el gestor para ser modificado */
		$gestor = Gestor::find($id);

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

        echo "actualizado";

	}

	public function delete($id){

		$gestor = Gestor::find($id);
		$gestor->delete();
    	echo "realizado";
	}

}
