<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use App\DocumentacionRequerida;
use App\DocumentacionPorTipoDeInspeccion;
use App\DocumentacionPorInspeccion;
use App\EjercicioFiscal;
use App\FormaValorada;
use App\Inspeccion;
use App\Gafete;
use App\Multa;
use App\EstatusInspeccion;
use App\BitacoraDeEstatus;

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

	public function validarFoliosAsignados($id){
		$estatus_NA = EstatusInspeccion::where('clave', 'NA')->first();
		$forma_valorada = FormaValorada::find($id)->load('tipoInspeccion');
		$inspecciones = Inspeccion::where('formavalorada_id', $id)->where('estatusinspeccion_id', $estatus_NA->id)->get();

		$data = [
			'code' 		=> 400,
			'message' 	=> 'error, ocurrió algo inesperado'
		];

		if (!empty($inspecciones)) {
			if (count($inspecciones) == 0) {
				$data = [
					'code' 			=> 200,
					'message' 		=> 'true',
					'FormaValorada' => $forma_valorada
				];
			} else {
				$data = [
					'code' 			=> 400,
					'message' 		=> 'error, todas estas inspecciones no están asignadas',
					'inspecciones' 	=> $inspecciones
				];
			}
		} else {
			$data = [
				'code' 		=> 400,
				'message' 	=> 'No hay inspecciones seleccionadas'
			];
		}

		return $data;
	}

	public function imprimirInspeccionesIndividual($id){
		$inspeccion = Inspeccion::find($id);
		$estatus_NA = EstatusInspeccion::where('clave', 'NA')->first();

		$data = [
			'code' 		=> 400,
			'message' 	=> 'error, ocurrió algo inesperado'
		];

		if (!empty($inspeccion)) {
			if ($inspeccion->estatusInspeccion->clave != $estatus_NA->clave) {
				$data = [
					'code' 				=> 200,
					'message' 			=> 'Datos de la inspección',
					'tipoInspeccion' 	=> $inspeccion->tipoInspeccion->clave
				];
			} else {
				$data = [
					'code' 			=> 400,
					'message' 		=> 'La inspección debe estar asignada para imprimir la documentación'
				];
			}
		} else {
			$data = [
				'code' 		=> 400,
				'message' 	=> 'No se encontro la inspección'
			];
		}

		return $data;
	}

	/* Descarga las inspecciones con las actas comunes */
	public function descargarPdfInspecciones($id){
		$forma_valorada = FormaValorada::find($id);
		$inspecciones = Inspeccion::where('formavalorada_id', $id)->get();
		$documentos_requeridos = DocumentacionPorTipoDeInspeccion::where('tipoinspeccion_id', $forma_valorada->tipoinspeccion_id)->get();
		$ejercicio_fiscal = EjercicioFiscal::where('anio', date("Y"))->first();
	
		$pdf = PDF::loadView('acta-inspeccion.acta-inspeccion-'.$forma_valorada->tipoInspeccion->clave, ['inspecciones' => $inspecciones, 'documentos' => $documentos_requeridos]);
		return $pdf->download('Inspeccion-'.$ejercicio_fiscal->anio.'-Folio-'.$forma_valorada->folioinicio.'-'.$forma_valorada->foliofin.'.pdf');
	}

	/* Descarga las inspecciones con las actas complejas (con testigos) */
	public function descargarPdfInspeccionesComplejas($id){
		$forma_valorada = FormaValorada::find($id);
		$inspecciones = Inspeccion::where('formavalorada_id', $id)->get();
		$documentos_requeridos = DocumentacionPorTipoDeInspeccion::where('tipoinspeccion_id', $forma_valorada->tipoinspeccion_id)->get();
		$ejercicio_fiscal = EjercicioFiscal::where('anio', date("Y"))->first();
		
		$pdf = PDF::loadView('acta-inspeccion.acta-inspeccion-compleja-OIVP', ['inspecciones' => $inspecciones, 'documentos' => $documentos_requeridos]);
		return $pdf->download('Inspeccion-'.$ejercicio_fiscal->anio.'-Folio-'.$forma_valorada->folioinicio.'-'.$forma_valorada->foliofin.'.pdf');
	}

	/* Descarga los citatorios de las inspecciones */
	public function descargarPdfCitatorios($id){
		$forma_valorada = FormaValorada::find($id);
		$inspecciones = Inspeccion::where('formavalorada_id', $id)->get();
		$ejercicio_fiscal = EjercicioFiscal::where('anio', date("Y"))->first();

		$pdf = PDF::loadView('acta-inspeccion.citatorio-OIVP', ['inspecciones' => $inspecciones]);

		return $pdf->download('Citatorios-'.$ejercicio_fiscal->anio.'-Folio-'.$forma_valorada->folioinicio.'-'.$forma_valorada->foliofin.'.pdf');
	}

	/* Descarga las clausuras de las inspecciones */
	public function descargarPdfClausuras($id){
		$forma_valorada = FormaValorada::find($id);
		$inspecciones = Inspeccion::where('formavalorada_id', $id)->get();
		$documentos_requeridos = DocumentacionPorTipoDeInspeccion::where('tipoinspeccion_id', $forma_valorada->tipoinspeccion_id)->get();
		$ejercicio_fiscal = EjercicioFiscal::where('anio', date("Y"))->first();

		$pdf = PDF::loadView('clausura.clausuras-'.$forma_valorada->tipoInspeccion->clave, ['inspecciones' => $inspecciones, 'documentos' => $documentos_requeridos]);
		
		return $pdf->download('Clausuras-'.$ejercicio_fiscal->anio.'-Folio-'.$forma_valorada->folioinicio.'-'.$forma_valorada->foliofin.'.pdf');
	}

	public function descargarMultas($id){
		$multas = Multa::where('inspeccion_id', $id)->get();
		$inspeccion = Inspeccion::find($id);
		$documentos_por_inspeccion = DocumentacionPorInspeccion::where('inspeccion_id', $id)->get(['id', 'documentacionrequerida_id', 'solicitado', 'exhibido', 'observaciones']);

		//dd($documentos_por_inspeccion);
		//die();

		// $inspecciones = Inspeccion::where('formavalorada_id', $id)->get();
		// $documentos_requeridos = DocumentacionPorTipoDeInspeccion::where('tipoinspeccion_id', $forma_valorada->tipoinspeccion_id)->get();
		// $ejercicio_fiscal = EjercicioFiscal::where('anio', date("Y"))->first();
		
		$pdf = PDF::loadView('multas.multas-'.$inspeccion->formaValorada->tipoInspeccion->clave, ['multas' => $multas, 'inspeccion' => $inspeccion, 'documentos_por_inspeccion' => $documentos_por_inspeccion]);
		return $pdf->download('Multa.pdf');
	}

	public function descargarOrdenClausura($id){
		$inspeccion = Inspeccion::find($id);
		$documentos_no_presentados = DocumentacionPorInspeccion::where('inspeccion_id', $id)->where('exhibido', 0)->get();
		$ejercicio_fiscal = EjercicioFiscal::where('anio', date("Y"))->first();
		$estatus_ProcesoClausura = EstatusInspeccion::where('clave', 'Epc')->first();
		$usuario = Auth::user();

		$inspeccion->usuario_id = $usuario->id;
		$inspeccion->estatusinspeccion_id = $estatus_ProcesoClausura->id;
		
		if ($inspeccion->update()) {
			$datos_bitacora = [
				'inspeccion_id' => $inspeccion->id,
				'estatusinspeccion_id' => $estatus_ProcesoClausura->id,
				'usuario_id' => $usuario->id,
				'observacion' => $estatus_ProcesoClausura->nombre
			];

			BitacoraDeEstatus::create($datos_bitacora);
		}

		$pdf = PDF::loadView('clausura.acta-clausura', ['inspeccion' => $inspeccion, 'documentos' => $documentos_no_presentados]);
		return $pdf->download('Orden-Clausura-'.$ejercicio_fiscal->anio.'-Folio-'.$id.'.pdf');
	}

	/* Descarga inspecciones individuales con las actas comunes */
	public function descargarPdfInspeccionIndividual($id){
		$inspeccion = Inspeccion::find($id);
		$documentos_requeridos = DocumentacionPorTipoDeInspeccion::where('tipoinspeccion_id', $inspeccion->tipoinspeccion_id)->get();
		$ejercicio_fiscal = EjercicioFiscal::where('anio', date("Y"))->first();
	
		$pdf = PDF::loadView('acta-inspeccion.acta-inspeccion-individual-'.$inspeccion->tipoInspeccion->clave, ['inspeccion' => $inspeccion, 'documentos' => $documentos_requeridos]);

		return $pdf->download('Inspeccion-'.$ejercicio_fiscal->anio.'-Folio-'.$inspeccion->folio.'.pdf');
	}

	/* Descarga clausura individual y limpia no tiene fechas ni datos */
	public function descargarPdfClausuraIndividual($id){
		$inspeccion = Inspeccion::find($id);
		$documentos_requeridos = DocumentacionPorTipoDeInspeccion::where('tipoinspeccion_id', $inspeccion->tipoinspeccion_id)->get();
		$ejercicio_fiscal = EjercicioFiscal::where('anio', date("Y"))->first();

		$pdf = PDF::loadView('clausura.clausura-individual-'.$inspeccion->tipoInspeccion->clave, ['inspeccion' => $inspeccion, 'documentos' => $documentos_requeridos]);
		
		return $pdf->download('Clausuras-'.$ejercicio_fiscal->anio.'-Folio-'.$inspeccion->folio.'.pdf');
	}

	/* Descarga citatorios individuales */
	public function descargarPdfCitatorioIndividual($id){
		$inspeccion = Inspeccion::find($id);
		$ejercicio_fiscal = EjercicioFiscal::where('anio', date("Y"))->first();

		$pdf = PDF::loadView('acta-inspeccion.citatorio-individual-OIVP', ['inspeccion' => $inspeccion]);

		return $pdf->download('Citatorios-'.$ejercicio_fiscal->anio.'-Folio-'.$inspeccion->folio.'.pdf');
	}

	/* Descarga la inspeccion con las actas complejas (con testigos) individualmente  */
	public function descargarPdfInspeccionComplejaIndividual($id){
		$inspeccion = Inspeccion::find($id);
		$documentos_requeridos = DocumentacionPorTipoDeInspeccion::where('tipoinspeccion_id', $inspeccion->tipoinspeccion_id)->get();
		$ejercicio_fiscal = EjercicioFiscal::where('anio', date("Y"))->first();
		
		$pdf = PDF::loadView('acta-inspeccion.acta-inspeccion-compleja-individual-OIVP', ['inspeccion' => $inspeccion, 'documentos' => $documentos_requeridos]);
		return $pdf->download('Inspeccion-'.$ejercicio_fiscal->anio.'-Folio-'.$inspeccion->folio.'.pdf');
	}

	public function verGafete($id){
		$gafete = Gafete::find($id);
		$ejercicio_fiscal = EjercicioFiscal::where('anio', date("Y"))->first();
		
		$customPaper = array(0,0,425,328);
		$pdf = PDF::loadView('gafete.gafete', ['gafete' => $gafete])->setPaper($customPaper, "landscape");

		return $pdf->download('Gafete-'.$ejercicio_fiscal->anio.'-'.$gafete->inspector->nombre.'.pdf');
	}

	public function inspeccionesPorPaquete($id){
		$inspecciones = Inspeccion::where('formavalorada_id', $id)->get()->load('estatusInspeccion');

		return Datatables::of($inspecciones)->make(true);
	}

	public function reasignarInspeccionesPorPaquete($id){
		$inspecciones = Inspeccion::where('formavalorada_id', $id)->get()->load('documentacionPorInspeccion');
		$estatus_NA = EstatusInspeccion::where('clave', 'NA')->first();
		$tipo_inspeccion_id = $inspecciones->last()->tipoInspeccion->id;
		$documentacion_por_inspeccion = DocumentacionPorTipoDeInspeccion::where('tipoinspeccion_id', $tipo_inspeccion_id)->get();

		$data =  array();
		$total_inspecciones_reasignadas = 0;

		if (count($inspecciones) > 0) {
			for ($i = 0; $i < count($inspecciones); $i++) {
				if ($inspecciones[$i]->estatusInspeccion->clave == $estatus_NA->clave) {
					for ($a = 0; $a < count($inspecciones[$i]->documentacionPorInspeccion); $a++) {
						$inspecciones[$i]->documentacionPorInspeccion[$a]->delete();
					}

					for ($c = 0; $c < count($documentacion_por_inspeccion); $c++) {
						$datos = [
							'tipoinspeccion_id' => $tipo_inspeccion_id,
							'documentacionrequerida_id' => $documentacion_por_inspeccion[$c]->documentacionrequerida_id,
							'inspeccion_id' => $inspecciones[$i]->id,
							'solicitado' => 0,
							'exhibido' => 0
						];

						DocumentacionPorInspeccion::create($datos);
					}
					
					$total_inspecciones_reasignadas = $total_inspecciones_reasignadas + 1;
				}
			}
		}

		if ($total_inspecciones_reasignadas > 0) {
			$data = [
				'code' => 200,
				'inspecciones' => $inspecciones,
				'total_inspecciones_reasignadas' => $total_inspecciones_reasignadas
			];
		}else{
			$data = [
				'code' => 400,
				'message' => 'No se reasignaron inspecciones'
			];
		}

		return $data;
	}

}
