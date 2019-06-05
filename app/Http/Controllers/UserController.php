<?php

namespace App\Http\Controllers;

use App\User;
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

}
