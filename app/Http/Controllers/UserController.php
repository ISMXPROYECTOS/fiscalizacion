<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function listadoUsuarios(){
		/* Se solicita a la bd todos los usuarios para listarlos */
		$usuarios = User::all();
		return view('user.listado-usuarios', [
    		'usuarios' => $usuarios
    	]);
	}

	public function registroUsuario(){
		return view('user.registro-usuarios');
	}

	public function create(Request $request){

		/* Validara los campos para evitar problemas */
		$validate = $this->validate($request,[
			'usuario' => 'required|string|max:255|unique:usuario',
            'role' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
		]);

		/* Optiene la id del usuario administrador que crea los gestores */
		$id = \Auth::user()->id;
		/* Se reciben los datos del formulario y se crean variables */
		$usuario = $request->input('usuario');
		$role = $request->input('role');
		$password = $request->input('password');

		/* Una ves verificados los datos y creados las variables se inserta en la BD */
		User::create([
            'usuario' => $usuario,
            'role' => $role,
            'password' => Hash::make($password),
            'activo' => 1,
        ]);

		/* Una vez agregado el nuevo gestor redirige e indica que fue correcta la creación del gestor */
    	return redirect()->route('listado-usuarios')->with('status', 'Usuario Creado');

	}


}
