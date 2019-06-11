<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function listadoUsuarios(){
		return view('user.listado-usuarios');
	}

	public function tbody(){
		return datatables()
			->eloquent(User::query())
			->addColumn('btn', 'user/actions-usuarios')
			->rawColumns(['btn'])->toJson();
	}

	public function create(Request $request){

		// Validara los campos para evitar problemas 
		$validate = $request->validate([
			'usuario' => 'required|string|max:255|unique:usuario',
            'role' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
	    ]);

	    // Se reciben los datos del formulario creando un Array de datos
		$datos = [
			'usuario' => $request->input('usuario'),
            'role' => $request->input('role'),
            'password' => Hash::make($request->input('password')),
            'activo' => 1
		];

		// Retornamos los datos a la peticion Ajax al mismo tiempo en que se almacena en la BD
	    return User::create($datos);
	}


	public function editarUsuario($id){

    	$usuario = User::find($id);
    	return $usuario;

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
		$activo = $request->input('activo');
		// Se verifica si la password es la misma o diferente y se asigna al usuario
		if ($request->input('password') == $usuario->password) {
			$usuario->password = $request->input('password');
		} else {
			$usuario->password = Hash::make($request->input('password'));
		}
		

        /* Una ves verificados los datos y creados las variables se actualiza en la BD */
		$usuario->usuario = $usuarioForm;
		$usuario->role = $role;
		$usuario->activo = $activo;
		$usuario->update();

        /* Una vez actualizado el usuario redirige e indica que fue correcta la modificación del usuario */
    	return redirect()->route('listado-usuarios')->with('status', 'Usuario Modificado');

	}

	public function delete($id){

		$usuario = User::find($id);
		$usuario->delete();
		
    	echo "realizado";
	}


}
