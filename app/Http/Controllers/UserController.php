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

		/* Una vez agregado el nuevo usuario redirige e indica que fue correcta la creación del usuario */
    	return redirect()->route('listado-usuarios')->with('status', 'Usuario Creado');

	}

	public function editarUsuario($id){

    	$usuario = User::where('id', $id)->first();

    	return view('user.registro-usuarios', [
    		'usuario' => $usuario
    	]);
    }

	public function update(Request $request){

		/* Se reciben la id del usuario que se esta modificando */
		$id = $request->input('id');

		/* Se selecciona el usuario para ser modificado */
		$usuario = User::where('id', $id)->first();

		/* Validara los campos para evitar problemas */
		$validate = $this->validate($request,[
            'usuario' => 'required|string|max:255|unique:usuario,usuario,' . $id,
            'role' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
		]);

		/* Se reciben los datos del formulario y se crean variables */
		$usuarioForm = $request->input('usuario');
		$role = $request->input('role');
		$password = $request->input('password');

        /* Una ves verificados los datos y creados las variables se actualiza en la BD */
		$usuario->usuario = $usuarioForm;
		$usuario->role = $role;
		$usuario->password = Hash::make($password);
		$usuario->update();

        /* Una vez actualizado el usuario redirige e indica que fue correcta la modificación del usuario */
    	return redirect()->route('listado-usuarios')->with('status', 'Usuario Modificado');

	}

	public function delete($id){

		$usuario = User::where('id', $id)->delete();

    	return redirect()->route('listado-usuarios')->with('status', 'Usuario Eliminado');
	}


}
