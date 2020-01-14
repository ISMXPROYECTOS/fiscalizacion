<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Barryvdh\DomPDF\Facade as PDF;
use DateTime;
use App\Gafete;
use App\Inspector;
use App\EjercicioFiscal;

class GafetesController extends Controller
{
	public function registrar($id){
		$gafetes = Gafete::whereYear('vigencia', date('Y'))
							->where('inspector_id', $id)
							->get();

		if (count($gafetes) >= 1) {
			return $gafetes->last()->id;
		} else {
			$inspector = Inspector::find($id);
    		return $inspector;
		}
	}

	public function generar(Request $request){
		// Validamos los campos que estamos enviando por AJAX
		$validate = $request->validate([
            'gafete-image' => 'required|image|mimes:jpeg,png,jpg'
	    ]);

	    $vigencia = new DateTime();

	    $inspector = Inspector::find($request->input('gafete-id'));
	    $gafetes = Gafete::where('inspector_id', $inspector->id)->get();

		$ejercicio_fiscal = EjercicioFiscal::where('anio', date("Y"))->first();
		
		$vigencia->modify('last day of december'.$ejercicio_fiscal->anio);


		$imagen = $request->file('gafete-image'); 

		if (count($gafetes) < 1) {
			$folio_gafete = $ejercicio_fiscal->anio . '/INSPECTOR/1';

			$nombre_qr = "1-QR-".date("Y").'-INSPECTOR-'.$inspector->nombre;

			$nombre_imagen = '1-'.$ejercicio_fiscal->anio.'-INSPECTOR-'.$inspector->nombre.'.'.$imagen->getClientOriginalExtension();
		} else {
			$total_gafetes = count($gafetes)+1;
			$folio_gafete = $ejercicio_fiscal->anio . '/INSPECTOR/'.$total_gafetes;

			$nombre_qr = $total_gafetes."-QR-".date("Y").'-INSPECTOR-'.$inspector->nombre;

			$nombre_imagen = $total_gafetes.'-'.$ejercicio_fiscal->anio .'-INSPECTOR-'.$inspector->nombre.'.'.$imagen->getClientOriginalExtension();
		}

		$qr = \QrCode::format('png')
			->size(500)
			->generate(url('/inspectores/perfil/'.$inspector->hash), public_path('img/qrs/'.$nombre_qr.'.png'));
		
		$imagen->move(public_path('img/inspectores'), $nombre_imagen);

		$datos = [
			'ejerciciofiscal_id' => $ejercicio_fiscal->id,
            'inspector_id' => $request->input('gafete-id'),
            'folio' => $folio_gafete,
            'vigencia' => $vigencia,
            'codigoqr' => $nombre_qr,
            'imageninspector' => $nombre_imagen
		];

		// Retornamos los datos a la peticion Ajax, al mismo tiempo en se almacena en la BD
		return Gafete::create($datos);

		//$pdf = PDF::loadView('gafete.gafete', ['gafete' => $datos]);
	}
    
}
