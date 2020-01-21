<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Style\Font;
use PhpOffice\PhpWord\TemplateProcessor;
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
		
		/*
		$multa = new PhpWord();

		$seccion_1 = $multa->addSection();
		$seccion_1->addTextBreak(2);

		$membrete = $seccion_1->addHeader();

		$membrete->addImage(
			'https://www.crealab.com.mx/images/clientes/header-multa-fiscal-word.jpg',
			array(
				'width'         => 500,
				'height'        => 73,
				'wrappingStyle' => 'behind',
				'positioning'   => 'absolute',
				'posHorizontalRel' => 'margin',
				'posVerticalRel' => 'line',
			)
		);

		$letra_negrita = 'negrita';
		$multa->addFontStyle($letra_negrita,
			array('name' => 'Arial', 'size' => '10', 'bold' => 'true')
		);

		$datos_encabezado = $seccion_1->addTable();
		$datos_encabezado->addRow();
		$datos_encabezado->addCell(3500);
		$datos_encabezado->addCell(5500)->addText("AYUNTAMIENTO DE BENITO JUÁREZ QUINTANA ROO <w:br/>TESORERÍA MUNICIPAL <w:br/>DIRECCIÓN DE FISCALIZACIÓN
			 <w:br/><w:br/>EXPEDIENTE: ".$inspeccion->folio."<w:br/> <w:br/>ASUNTO: RESOLUCIÓN ADMINISTRATIVA<w:br/><w:br/>Cancún, Quintana Roo a ".strftime( "%d-%m-%Y %H:%M")."");
		// $contenido_encabezado = "AYUNTAMIENTO DE BENITO JUÁREZ QUINTANA ROO <br/>TESORERÍA MUNICIPAL <br/>DIRECCIÓN DE FISCALIZACIÓN
		// 						<br/><br/>EXPEDIENTE: <b>".$inspeccion->folio."</b>";
		// $datos_encabezado->addCell(5500)->addText(\PhpOffice\PhpWord\Shared\Html::addHtml($seccion_1, $contenido_encabezado));

		$objectWriter = \PhpOffice\PhpWord\IOFactory::createWriter($multa, 'Word2007');

		//$objectWriter = \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html);

		try {
			$objectWriter->save(storage_path('holi.rtf'));
		} catch (Exception $e) {
			
		}

		return response()->download(storage_path('holi.rtf'));
		*/

		$templateWord = new TemplateProcessor(storage_path('PlantillaMultaOIF.docx'));
		
		// fecha de hoy en español 
		setlocale(LC_TIME, 'es_CO.UTF-8');
		$hoy = strftime("%d de %B del %G");
		$puesto = $encargado->puesto;
		$nombre_completo_encargado = $encargado->nombre.' '.$encargado->apellidopaterno.' '.$encargado->apellidomaterno;

		$folio = $inspeccion->folio;
		$fecha_hoy = $hoy;
		$empresa = $comercio->denominacion;
		$fecha_vence = $inspeccion->fechavence;
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

		$templateWord->setValue('folio', $folio);
		$templateWord->setValue('fecha_hoy', $fecha_hoy);
		$templateWord->setValue('empresa', $empresa);
		$templateWord->setValue('fecha_vence', $fecha_vence);
		$templateWord->setValue('domicilio_fiscal', $domicilio_fiscal);
		$templateWord->setValue('monto_total', $monto_total);
		$templateWord->setValue('umas', $umas);
		$templateWord->setValue('valor_uma', $valor_uma);
		$templateWord->setValue('encargado', $encargado);
		$templateWord->setValue('puesto_esncargado', $puesto_encargado);
		$templateWord->setValue('documentos', $documentos);

		/*
		for ($i = 0; $i < count($documentos); $i++) { 
			$templateWord->setValue('documentos', $documentos[$i]);
		}
		*/

		return $templateWord->saveAs('Holiwis.rft');
	}
}
