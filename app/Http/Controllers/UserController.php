<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
	public function registroInspector(){
		return view('inspector.registro-inspector');
	}

	public function registroGestores(){
		return view('inspector.regitro-gestores');
	}
}
