<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Style\Font;
use PhpOffice\PhpWord\TemplateProcessor;
use Carbon\Carbon;
use App\DocumentacionPorInspeccion;
use App\Inspeccion;
use App\Encargado;
use App\FormaValorada;
use App\Comercio;
use App\Multa;
use App\EjercicioFiscal;

class WordController extends Controller
{
	public function descargarMultas($id){
		$multas = Multa::where('inspeccion_id', $id)->get(['id', 'montoMulta', 'valorUma', 'total']);
		$ultima_multa = $multas->last();
		$inspeccion = Inspeccion::find($id);
		$documentos_por_inspeccion = DocumentacionPorInspeccion::where('inspeccion_id', $id)->get(['id', 'documentacionrequerida_id', 'solicitado', 'exhibido', 'observaciones']);
		$total_documentos = count($documentos_por_inspeccion);
		$comercio = Comercio::find($inspeccion->Comercio->id);
		$forma_valorada = FormaValorada::find($inspeccion->formaValorada->id);
		$encargado = Encargado::find($forma_valorada->encargado->id);

		// fecha de hoy en español 
		setlocale(LC_ALL, 'es_ES');
		$hoy = date('d-m-Y');
		$hoy_formateado = Carbon::parse($hoy);
		$hoy_formateado = $hoy_formateado->formatLocalized('%d de %B del %G');
		$fecha_vence_formateado = Carbon::parse($inspeccion->fechavence);
		$fecha_vence_formateado = $fecha_vence_formateado->formatLocalized('%d de %B del %G');

		if ($inspeccion->tipoInspeccion->clave == 'OIF') {
			$templateWord = new TemplateProcessor(storage_path('PlantillaMultaOIF.docx'));

			$claves = [
				'documentos_tabla',
				'solicitado',
				'exhibido',
				'observaciones'
			];
	
			for ($i = 0; $i < $total_documentos; $i++) {
				if ($documentos_por_inspeccion[$i]->exhibido == 0) {
					if ($documentos_por_inspeccion[$i]->solicitado == 0) {
						$solicitado = 'No';
					} else {
						$solicitado = 'Si';
					}
	
					$documento_tabla = [
						[
							$documentos_por_inspeccion[$i]->documentacionRequerida->nombre,
							$solicitado,
							'No',
							$documentos_por_inspeccion[$i]->observaciones
						]
					];
	
					$documentos_tabla_array[] = array_combine($claves, array_flatten($documento_tabla));
				}
			}

			$templateWord->cloneRowAndSetValues('documentos_tabla', $documentos_tabla_array);
		} else {
			$templateWord = new TemplateProcessor(storage_path('PlantillaMultaOIE.docx'));
		}

		$puesto = $encargado->puesto;
		$nombre_completo_encargado = $encargado->nombre.' '.$encargado->apellidopaterno.' '.$encargado->apellidomaterno;
		
		$folio = $inspeccion->folio;
		$fecha_hoy = $hoy_formateado;
		$empresa = $comercio->denominacion;
		$fecha_vence = $fecha_vence_formateado;
		$domicilio_fiscal = $comercio->domiciliofiscal;
		$monto_total = $ultima_multa->total;
		$umas = $ultima_multa->montoMulta;
		$valor_uma = $ultima_multa->valorUma;
		$encargado = $nombre_completo_encargado;
		$puesto_encargado = $puesto;
		$documentos_array = array();

        for ($i = 0; $i < count($documentos_por_inspeccion); $i++) {
            $documento = $documentos_por_inspeccion[$i]->documentacionRequerida->nombre;
            $documentos_array[] = $documento;
		}

		$documentos = implode("; ", $documentos_array);

		// Remplaza las / del folio por -
		$nombre_archivo = str_replace("/", "-", $inspeccion->folio);

		// Se reemplazan las variables en el documento word
		$templateWord->setValue('folio', $folio);
		$templateWord->setValue('fecha_hoy', $fecha_hoy);
		$templateWord->setValue('empresa', $empresa);
		$templateWord->setValue('fecha_vence', $fecha_vence);
		$templateWord->setValue('domicilio_fiscal', $domicilio_fiscal);
		$templateWord->setValue('monto_total', $monto_total);
		$templateWord->setValue('umas', $umas);
		$templateWord->setValue('valor_uma', $valor_uma);
		$templateWord->setValue('encargado', $encargado);
		$templateWord->setValue('puesto_encargado', $puesto_encargado);
		$templateWord->setValue('documentos', $documentos);

		return $templateWord->saveAs('MultaFolio-'.$nombre_archivo.'.rft');
	}
}
