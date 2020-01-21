<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Style\Font;
use PhpOffice\PhpWord\TemplateProcessor;
use App\DocumentacionPorInspeccion;
use App\Inspeccion;
use App\Multa;
use App\EjercicioFiscal;

class WordController extends Controller
{
	public function descargarMultas($id){
		/*
		$multas = Multa::where('inspeccion_id', $id)->get();
		$inspeccion = Inspeccion::find($id);
		$documentos_por_inspeccion = DocumentacionPorInspeccion::where('inspeccion_id', $id)->get(['id', 'documentacionrequerida_id', 'solicitado', 'exhibido', 'observaciones']);
		
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
		$templateWord = new TemplateProcessor(storage_path('plantillaMultas.docx'));

		$empresa = 'Crealab';
		$folio = '2020/OIF/1';

		$templateWord->setValue('nombre_empresa', $empresa);
		$templateWord->setValue('folio', $folio);
		
		$templateWord->saveAs('Holiwis.rft');
	}
}
