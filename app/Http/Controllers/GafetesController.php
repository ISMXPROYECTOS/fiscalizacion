<?php

namespace App\Http\Controllers;

use App\Gafetes;
use App\Inspector;
use App\EjercicioFiscal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class GafetesController extends Controller
{

	public function create(Request $request){

		// Este metodo debe crear un gafete de inspector que incluya ejercicio fiscal, inspector, folio, created_at, fecha vence, qr, estatus

		// el gafete a mostrar debe tener: Nombre, Apellido, Puesto, Vigencia, Foto

		// el codigo qr debe mandarnos a una vista rellenada por los datos del inspector

		// primero recibimos el inspector al que queremos generar su gafete


		

		$id = $request->input('id');
		$inspector = Inspector::find($id);

		// año fiscal
		$ejercicio_fiscal = EjercicioFiscal::where('anio', date("Y"))->get();

		//var_dump(url('/perfil/inspector/'.$inspector->id));
		//die();
		
		
		return \QrCode::size(300)->generate(url('/perfil/inspector/'.$inspector->id));
	}
    
}
