<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
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

		$pdf = PDF::loadView('gafete.gafete', ['gafete' => $gafete]);

		return $pdf->download();
	}	

}
