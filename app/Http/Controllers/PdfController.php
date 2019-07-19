<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\EjercicioFiscal;
use App\Inspeccion;
use App\Gafete;

class PdfController extends Controller
{
	public function inspeccionesPdf(){


		//return view('gafete.gafete');

		$inspecciones = Inspeccion::all();
		$pdf = PDF::loadView('pdf.pdf', ['inspecciones' => $inspecciones]);

		return $pdf->stream();
	}

	public function verGafete($id){

		$gafete = Gafete::find($id);
		$ejercicio_fiscal = EjercicioFiscal::where('anio', date("Y"))->first();

		
		$customPaper = array(0,0,425,328);
		$pdf = PDF::loadView('gafete.gafete', ['gafete' => $gafete])->setPaper($customPaper, "landscape");

		return $pdf->download('Gafete-'.$ejercicio_fiscal->anio.'-'.$gafete->inspector->nombre.'.pdf');
	}	

}
