<?php

namespace App\Http\Controllers;

use App\Gafetes;
use App\Inspector;
use App\EjercicioFiscal;
use Illuminate\Http\Request;

class GafetesController extends Controller
{

	public function create(Request $request){

		$id = $request->input('id');
		$inspector = Inspector::find($id);

		var_dump($inspector);
		die();
		return \QrCode::size(300)->generate("www.crealab.com.mx");
	}
    
}
