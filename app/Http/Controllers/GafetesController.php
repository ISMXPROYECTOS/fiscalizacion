<?php

namespace App\Http\Controllers;

use DateTime;
use App\Gafete;
use App\Inspector;
use App\EjercicioFiscal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class GafetesController extends Controller
{
	public function registrar($id){
		$inspector = Inspector::find($id);
    	return $inspector;
	}

	public function generar(Request $request){

		// Este metodo debe crear un gafete de inspector que incluya ejercicio fiscal, inspector, folio, created_at, fecha vence, qr, estatus

		// el gafete a mostrar debe tener: Nombre, Apellido, Puesto, Vigencia, Foto

		// el codigo qr debe mandarnos a una vista rellenada por los datos del inspector

		// primero recibimos el inspector al que queremos generar su gafete

	
		// Validamos los campos que estamos enviando por AJAX
		$validate = $request->validate([
			'gafete-nombre' => 'required|string|max:50',
            'gafete-apellidopaterno' => 'required|string|max:30',
            'gafete-apellidomaterno' => 'required|string|max:30',
            'gafete-clave' => 'required|string|max:50',
            'gafete-image' => 'required|image|mimes:jpeg,png,jpg,gif'
	    ]);

	    $vigencia = new DateTime();

		$ejercicio_fiscal = EjercicioFiscal::where('anio', date("Y"))->first();
		$folio_gafete = $ejercicio_fiscal->anio . '/INSPECTOR';

		$vigencia->modify('last day of december'.$ejercicio_fiscal->anio);

		$inspector = Inspector::find($request->input('gafete-id'));

		$nombre_qr = "QR".date("Y").'INS'.$inspector->id;
		$qr = \QrCode::format('png')
			->size(500)
			->generate(url('/inspectores/perfil/'.$inspector->hash), public_path('img/qrs/'.$nombre_qr.'.png'));

		$imagen = $request->file('gafete-image'); 
		$nombre_imagen = $ejercicio_fiscal->anio .'INS'. $request->input('gafete-id').'.'.$imagen
			->getClientOriginalExtension();
		$imagen->move(public_path('img/inspectores'), $nombre_imagen);

		$datos = [
			'idejerciciofiscal' => $ejercicio_fiscal->id,
            'idinspector' => $request->input('gafete-id'),
            'folio' => $folio_gafete,
            'vigencia' => $vigencia,
            'codigoqr' => $nombre_qr,
            'imageninspector' => $nombre_imagen
		];

		// Retornamos los datos a la peticion Ajax, al mismo tiempo en se almacena en la BD
	    return Gafete::create($datos);

		/*$id = $request->input('id');
		$inspector = Inspector::find($id);

		// año fiscal
		$ejercicio_fiscal = EjercicioFiscal::where('anio', date("Y"))->get();

		//var_dump(url('/perfil/inspector/'.$inspector->id));
		//die();
		
		
		return \QrCode::size(300)->generate(url('/perfil/inspector/'.$inspector->id));*/
	}
    
}
