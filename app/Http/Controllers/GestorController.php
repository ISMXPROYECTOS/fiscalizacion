<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GestorController extends Controller
{
	public function registroGestores(){
		return view('gestor.regitro-gestores');
	}
}
