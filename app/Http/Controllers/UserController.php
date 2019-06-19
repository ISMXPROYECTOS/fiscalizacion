<?php

namespace App\Http\Controllers;

use App\User;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function verificarUsuario($username){
		$usuario = User::where('usuario', $username)->get();

		$fecha = new DateTime('now');
		$fecha_hoy = $fecha->format('Y-m-d');

		foreach($usuario as $user){
			if ($user->activo == 0 && $user->vigencia < $fecha_hoy) {
				echo "error";
			} else {
				return [
					'user' => $user,
					'fecha_hoy' => $fecha_hoy
				];
			}	
		}     	
	}

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

		// Convierte la fecha de un string a un date
		$vigencia = $request->input('vigencia');
		$date = strtotime($vigencia);
		$fecha_format = date("Y-m-d", $date);
		
		// Validara los campos para evitar problemas 
		$validate = $request->validate([
			'usuario' => 'required|string|max:255|unique:usuario',
            'role' => 'required|string|max:255',
            'vigencia' => 'required|date_format:Y-m-d',
            'password' => 'required|string|min:6|confirmed',
	    ]);

	    // Se reciben los datos del formulario creando un Array de datos
		$datos = [
			'usuario' => $request->input('usuario'),
            'role' => $request->input('role'),
            'vigencia' => $fecha_format,
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

		// Se reciben la id del usuario que se esta modificando
		$id = $request->input('id');

		// Convierte la fecha de un string a un date
		$vigencia = $request->input('vigencia');
		$date = strtotime($vigencia);
		$fecha_format = date("Y-m-d", $date);

		// Se selecciona el usuario para ser modificado
		$usuario = User::where('id', $id)->first();

		// Validara los campos para evitar problemas
		$validate = $this->validate($request,[
            'usuario' => 'required|string|max:255|unique:usuario,usuario,' . $id,
            'role' => 'required|string|max:255',
            'vigencia' => 'required|date_format:Y-m-d',
            'password' => 'required|string|min:6|confirmed',
		]);

		// Se reciben los datos del formulario y se crean variables
		$usuarioForm = $request->input('usuario');
		$role = $request->input('role');
		
		// Se verifica si la password es la misma o diferente y se asigna al usuario
		if ($request->input('password') == $usuario->password) {
			$usuario->password = $request->input('password');
		} else {
			$usuario->password = Hash::make($request->input('password'));
		}
		
        // Una ves verificados los datos y creados las variables se actualiza en la BD
		$usuario->usuario = $usuarioForm;
		$usuario->role = $role;
		$usuario->vigencia = $fecha_format;
		$usuario->update();

        // Una vez actualizado el usuario redirige e indica que fue correcta la modificación del usuario
    	return $usuario;

	}

	public function updateEstatus(Request $request){

		// Se reciben la id del usuario que se esta modificando
		$id = $request->input('id');

		// Se selecciona el usuario para ser modificado
		$usuario = User::where('id', $id)->first();

		// Validara los campos para evitar problemas
		$validate = $this->validate($request,[
       		'activo' => 'required|string',
		]);

		// Se reciben los datos del formulario y se crean variables
		$activo = $request->input('activo');

        // Una ves verificados los datos y creados las variables se actualiza en la BD
		$usuario->activo = $activo;
		$usuario->update();

        // Una vez actualizado el usuario redirige e indica que fue correcta la modificación del usuario
    	return $usuario;

	}

	public function cambiarPassword(){
		return view('user.cambio-de-password');
	}

	public function updatePassword(Request $request){

		// Se obtiene la id del usuario con la sesión
		$id = \Auth::user()->id;

		// Se selecciona el usuario para ser modificado
		$usuario = User::find($id);

		// Validara los campos para evitar problemas
		$validate = $this->validate($request,[
       		'password' => 'required|string|min:6|confirmed',
		]);

		// Se realiza el cambio de la contraseña
		if ($request->input('password') == $usuario->password) {
			$usuario->password = $request->input('password');
		} else {
			$usuario->password = Hash::make($request->input('password'));
		}

        // Una ves verificada la contraseña se actualiza en la BD
		$usuario->update();

        // Una vez actualizado el usuario redirige e indica que fue correcta la modificación del usuario
    	return redirect()->route('home')->with('status', 'Contraseña Modificada');

	}

}
