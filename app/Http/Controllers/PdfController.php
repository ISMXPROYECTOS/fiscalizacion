<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Inspeccion;

class PdfController extends Controller
{
	public function inspeccionesPdf(){

		$inspecciones = Inspeccion::all();
		$pdf = PDF::loadView('pdf.pdf', ['inspecciones' => $inspecciones]);

		return $pdf->stream();
	}

}
