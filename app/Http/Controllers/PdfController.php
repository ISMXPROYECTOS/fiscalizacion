<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\Datatables\Datatables;
use App\DocumentacionRequerida;
use App\EjercicioFiscal;
use App\FormaValorada;
use App\Inspeccion;
use App\Gafete;

class PdfController extends Controller
{

	public function listadoInspeccionesParaDescargar(){
		return view('pdf.listado-de-inspecciones-para-descargar');
	}

	public function tbody(){
		$formas_valoradas = FormaValorada::all()->load('tipoInspeccion')->load('ejercicioFiscal');

        return Datatables::of($formas_valoradas)
            ->addColumn('descargar', 'pdf/boton-descargar')
			->rawColumns(['descargar'])
			->make(true);
	}

	/*public function validarActaInspeccion($id){

		$inspecciones = Inspeccion::find($id);

		if ($inspecciones->estatusinspeccion_id == 1) {
			return 'false';
		} else {
			return $inspecciones;
		}
		
	}*/

	/*public function descargarActaInspeccion($id){

		$inspecciones = Inspeccion::all();

		$pdf = PDF::loadView('acta-inspeccion.acta-inspeccion', ['inspecciones' => $inspecciones]);
		return $pdf->download();
		
	}*/

	public function descargarPdfInspecciones($id){
		
		$inspecciones = Inspeccion::where('formavalorada_id', $id)->get();
		$forma_valorada = FormaValorada::find($id);

		$documentos_requeridos = DocumentacionRequerida::all();

		$ejercicio_fiscal = EjercicioFiscal::where('anio', date("Y"))->first();

		$pdf = PDF::loadView('acta-inspeccion.acta-inspeccion', ['inspecciones' => $inspecciones, 'documentos' => $documentos_requeridos]);
		return $pdf->download('Inspeccion-'.$ejercicio_fiscal->anio.'-Folio-'.$forma_valorada->folioinicio.'-'.$forma_valorada->foliofin.'.pdf');
	}

	public function verGafete($id){

		$gafete = Gafete::find($id);
		$ejercicio_fiscal = EjercicioFiscal::where('anio', date("Y"))->first();

		
		$customPaper = array(0,0,425,328);
		$pdf = PDF::loadView('gafete.gafete', ['gafete' => $gafete])->setPaper($customPaper, "landscape");

		return $pdf->download('Gafete-'.$ejercicio_fiscal->anio.'-'.$gafete->inspector->nombre.'.pdf');
		
	}	

}
