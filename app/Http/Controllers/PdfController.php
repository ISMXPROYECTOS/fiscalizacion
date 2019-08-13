<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
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


		return datatables()
			->eloquent(FormaValorada::query())
			->addColumn('descargar', 'pdf/boton-descargar')
			->rawColumns(['descargar'])
			->toJson();
	}

	public function validarActaInspeccion($id){

		$inspecciones = Inspeccion::find($id);

		if ($inspecciones->estatusinspeccion_id == 1) {
			return 'false';
		} else {
			return $inspecciones;
		}
		
	}

	public function descargarActaInspeccion($id){

		$inspecciones = Inspeccion::all();

		$pdf = PDF::loadView('acta-inspeccion.acta-inspeccion', ['inspecciones' => $inspecciones]);
		return $pdf->download();
		
	}

	public function descargarActaInspeccinMultiple($id_forma_valorada){
		
		$inspecciones = Inspeccion::where('formavalorada_id', $id_forma_valorada)->get();
		$forma_valorada = FormaValorada::find($id_forma_valorada);

		$ejercicio_fiscal = EjercicioFiscal::where('anio', date("Y"))->first();

		$pdf = PDF::loadView('acta-inspeccion.acta-inspeccion', ['inspecciones' => $inspecciones]);
		return $pdf->download('ActaInspeccion-'.$ejercicio_fiscal->anio.'-Folio-'.$forma_valorada->folioinicio.'-'.$forma_valorada->foliofin.'.pdf');
	}

	public function verGafete($id){

		$gafete = Gafete::find($id);
		$ejercicio_fiscal = EjercicioFiscal::where('anio', date("Y"))->first();

		
		$customPaper = array(0,0,425,328);
		$pdf = PDF::loadView('gafete.gafete', ['gafete' => $gafete])->setPaper($customPaper, "landscape");

		return $pdf->download('Gafete-'.$ejercicio_fiscal->anio.'-'.$gafete->inspector->nombre.'.pdf');
		
	}	

}
