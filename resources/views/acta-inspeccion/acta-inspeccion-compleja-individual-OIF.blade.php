<?php

set_time_limit(0);
ini_set("memory_limit",-1);
ini_set('max_execution_time', 0);

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>INSPECCION 2019-2021</title>
		<link rel="stylesheet" href="{{ asset('css/acta-inspeccion-oivp-comp.css') }}" />
	</head>
	<body>
		<img src="{{ asset('img/header-orden-inspeccion.jpg') }}" width="100%">
		<div class="container">
			<h5 class="folio">FOLIO: {{ $inspeccion->folio }}</h5><br><br>
			@if($inspeccion->comercio == null)
				<p class="oi-header-datos mbt-0"><b>NOMBRE DEL CONTRIBUYENTE: </b>________________________________________________________________________________________________</p>
				<p class="oi-header-datos mbt-0"><b>NOMBRE COMERCIAL DEL ESTABLECIMIENTO: </b>___________________________________________________________________________________</p>
				<p class="oi-header-datos mbt-0"><b>DOMICILIO DEL ESTABLECIMIENTO: </b>_____________________________________________________________________________________________</p>
				<!-- <p class="oi-header-datos mbt-0"><b>GIRO: </b>_______________________________________________________________________________________________________________________</p> -->
				<p class="oi-header-datos mbt-0"><b>NÚMERO DE PADRÓN MUNICIPAL: </b>______________________________________________________________________________________________</p>
			@else
				<p class="oi-header-datos mbt-0"><b>NOMBRE DEL CONTRIBUYENTE: </b>{{ $inspeccion->comercio->propietarionombre }}</p>
				<p class="oi-header-datos mbt-0"><b>NOMBRE COMERCIAL DEL ESTABLECIMIENTO: </b>{{ $inspeccion->comercio->nombreestablecimiento }}</p>
				<p class="oi-header-datos mbt-0"><b>DOMICILIO DEL ESTABLECIMIENTO: </b>{{ $inspeccion->comercio->domiciliofiscal }}</p>
				<!-- <p class="oi-header-datos mbt-0"><b>GIRO: </b></p> -->
				<p class="oi-header-datos mbt-0"><b>NÚMERO DE PADRÓN MUNICIPAL: </b></p>
			@endif
			<p class="contenido-general">@include('acta-inspeccion.primera-seccion') @if($inspeccion->inspector == null) C._________________________________________, @else <b>C. {{ $inspeccion->inspector->nombre }} {{ $inspeccion->inspector->apellidopaterno }} {{ $inspeccion->inspector->apellidomaterno }},
			@if(count($inspectoresExtra) >= 1) 
				@foreach($inspectoresExtra as $inspectorExtra)
					{{ $inspectorExtra[0]['nombre'] }} {{ $inspectorExtra[0]['apellidopaterno'] }} {{ $inspectorExtra[0]['apellidomaterno'] }},
				@endforeach
			@endif
			</b> @endif Inspector, Verificador y Notificador – Ejecutor adscritos a la Dirección de Fiscalización de la Tesorería Municipal del H. Ayuntamiento Benito Juárez, Quintana Roo, quienes podrán actuar conjunta o individualmente y deberán acreditar ese carácter con su identificación con fotografía y sello oficial vigente, expedida por el Lic. Marcelo José Guzmán, en su carácter de Tesorero Municipal del Municipio de Benito Juárez Quintana Roo, con fundamento en el artículo 11, fracción XI, del Reglamento Interior de la Tesorería Municipal de Benito Juárez; para que se presente en el domicilio del establecimiento arriba señalado y realice la inspección que corresponda, debiendo verificar que cumpla con el giro y horario de operación de dicho establecimiento comercial, que tenga a la vista la documentación vigente que acredite su correcto funcionamiento y que se encuentre al corriente del pago de sus contribuciones municipales, por lo que, se le requiere que permita al Inspector, Verificador y Notificador–Ejecutor el acceso y recorrido a su establecimiento y le exhiba el original de los documentos aplicables a su giro comercial y actividades, según sea el caso, entre otros, los consistentes en: @foreach($documentos as $documento)<b>{{ $documento->documentacionRequerida->nombre }}; </b>@endforeach lo anterior, para que se conozca su situación fiscal y administrativa, levantándose al efecto el Acta de Inspección en la que se deje constancia de lo aquí ordenado, apercibido que en caso de no hacerlo será sancionado según su conducta en términos de los artículos 505, 506, 507 y 509, fracción IV y VII, del Bando de Gobierno y Policía del Municipio de Benito Juárez, Quintana Roo y 68, fracciones I,III,V, X, XI y XV, del Código Fiscal Municipal del Estado de Quintana Roo, vigentes; autorizándose en su caso la intervención y acceso de elementos de la Fuerza Pública Municipal para su cumplimiento. Para el caso de prolongarse la realización de la diligencia aquí ordenada, con fundamento en lo dispuesto por el  artículo 18 del Código Fiscal Municipal del Estado de Quintana Roo, se habilita el horario comprendido de las 18:01 a las 24:00 horas del @if($inspeccion->comercio == null) día _____ de __________ del año _______, @else {{ $fecha_hoy }} @endif  así como de las 00:00 a las 07:29 horas del @if($inspeccion->comercio == null OR $inspeccion->fechavence == null) día _____ de _________ del año ______ @else {{ strftime("%d de %B del %G", strtotime($inspeccion->fechavence)) }}, @endif en el cual podrá iniciarse o continuarse hasta su conclusión.</p>
			<p class="fecha-cierre"><b>Cancún, Municipio de Benito Juárez, Quintana Roo, @if($inspeccion->comercio == null) a _____ de _________ de ______. @else {{ $fecha_hoy }}.  @endif  </b></p>
			<p class="atte"><b>A T E N T A M E N T E</b></p>
			<table class="firma-orden-inspeccion">
				<tr>
					<td class="encargado">
						@if(is_object($inspeccion->formavalorada))
						<p class="firma-encargado mbt-0"><b>{{ $inspeccion->formavalorada->encargado->nombre }} {{ $inspeccion->formavalorada->encargado->apellidopaterno }} {{ $inspeccion->formavalorada->encargado->apellidomaterno }}</b></p>
						<p class="firma-encargado mbt-0"><b>{{ $inspeccion->formavalorada->encargado->puesto }}</b></p>
						@endif
					</td>
					<td class="representante">
						<div>
							<p class="firma-representante mbt-0"><b>Firma: </b>_______________________________________________________________________________</p>
							<p class="firma-representante mbt-0"><b>Nombre: </b>____________________________________________________________________________</p>
							<p class="firma-representante mbt-0"><b>Fecha:</b>_______________________________________________________________________________</p>
							<br>
							<p class="constancia mt-0">Constancia de recepción de la presente Orden de Inspección. Los datos de identificación de la persona que recibe deberán quedar asentados en el Acta de Inspección que se realizará.</p>
						</div>
					</td>
				</tr>
			</table>
		</div>

		<div class="page_break"></div>

		<img src="{{ asset('img/header-acta-inspeccion-comp.jpg') }}" width="100%">
		<div class="container">
			<h5 class="aic-folio">ACTA DE INSPECCIÓN NÚMERO: {{ $inspeccion->folio }}</h5><br><br>
			<p class="aic-contenido-general mb-0">En Cancún, Quintana Roo, siendo las _______ horas del @if($inspeccion->comercio == null) día _____ de __________ del año ______, @else {{ $fecha_hoy }}, @endif el/los suscrito(s) inspector, notificador-ejecutor @if($inspeccion->inspector == null) C._________________________________________, @else <b>C. {{ $inspeccion->inspector->nombre }} {{ $inspeccion->inspector->apellidopaterno }} {{ $inspeccion->inspector->apellidomaterno }},</b> @endif con fundamento en los artículos 16 de la Constitución Política de los Estados Unidos Mexicanos, 24 de la Constitución Política del Estado Libre y Soberano de Quintana Roo y 40 del Código Fiscal Municipal del Estado de Quintana Roo, en cumplimiento a la orden de inspección número {{ $inspeccion->folio }} de fecha ____________________________________, emitida por el Ingeniero @if(is_object($inspeccion->formavalorada)) {{ $inspeccion->formavalorada->encargado->nombre }} {{ $inspeccion->formavalorada->encargado->apellidopaterno }} {{ $inspeccion->formavalorada->encargado->apellidomaterno }} en su carácter de {{ $inspeccion->formavalorada->encargado->puesto }}, @endif me constituí en el domicilio  del contribuyente @if(is_object($inspeccion->comercio)) {{ $inspeccion->comercio->propietarionombre }} @else _______________________________________ @endif, ubicado en @if(is_object($inspeccion->comercio)) {{ $inspeccion->comercio->domiciliofiscal }} {{ $inspeccion->comercio->cp }} @else _________________________________________________ @endif, de esta ciudad de Cancún, Quintana Roo, cerciorándome que es el domicilio buscado por medio de _________________________________________________________________________ atendiendo la diligencia quien dijo llamarse _______________________________________________ quien dijo ser _______________________________________________ de la persona buscada y se identifica por medio de ______________________________________________________; requiriendole en este momento la presencia del contribuyente o su representante legal, quien informó que si (____) no (____) se encuentra, por lo que se entiende la presente orden de visita con el/la C. ______________________________________________________ quien dijo ser __________________________________________ en su carácter de ____________________________________________ acredintándolo con ________________________________________________________________, y quien se identifica con __________________________________________________; persona ante quien el suscrito se identifican como autoridad fiscal, con la credencial número ___________________________, vigente del __________________________________ al _______________________________________, expedida por el Tesorero Municipal del Municipio de Benito Juárez, Quintana Roo, Lic. Marcelo José Guzmán, con fundamento en lo dispuesto en el artículo 11 fracción XI del Reglamento Interior de la Tesorería del Municipio de Benito Juárez, Quintana Roo  documentos que contiene su firma autógrafa y fotografía; por si (____) no (____) haber precedido citatorio, a través del cual se citó al deudor o a su Representante Legal para que sirviera esperar al suscrito en su domicilio en la fecha y en la hora en la que se actúa, por lo que en este momento se le notifica la orden de inspección número {{ $inspeccion->folio }} de fecha _______________________, expedida por el Director de Fiscalización del Municipio de Benito Juárez, Quintana Roo, a través de la cual se ordena iniciar una inspección con el objeto o propósito de comprobar el cumplimiento de las disposiciones fiscales a que está afecto como sujeto directo en materia de las siguientes contribuciones municipales: @foreach($documentos as $documento)<b>{{ $documento->documentacionRequerida->nombre }}.</b>@endforeach Por lo que con fundamento en el artículo 44 fracción III del Código Fiscal Municipal para el Estado de quintana Roo, se le requiere a la persona con la que se entiende la visita domiciliaria  para que designe a dos testigos, apercibiéndole que en caso de no designarlos o que los designados no acepten servir como tales, serán designados por la autoridad fiscal, sin que tal situación afecta la legalidad de la presente diligencia, a lo que la persona con la que se entiende la diligencia a lo que manifestó que si (____) no (____) designa testigos por lo que el visitado (______) el verificador (______) designa como testigos a: ________________________________________________________________________________________________________________________________________</p>
			<p class="aic-contenido-general mbt-0">________________________________________________________________________________________________________________________________________</p>
			<p class="aic-contenido-general mbt-0">________________________________________________________________________________________________________________________________________</p>
			<p class="aic-contenido-general mbt-0">________________________________________________________________________________________________________________________________________</p>
			<p class="aic-contenido-general mbt-0">________________________________________________________________________________________________________________________________________</p>
			<p class="aic-contenido-general">En este momento se le requiere a la persona con la que se entiende la presente visita domiciliaria para que presente en este momento el original o los originales de la siguiente documentación a través del o los cuales acredita haber cumplido con sus obligaciones fiscales:</p>
			<table class="aic-documentacion-requerida">
				<thead>
					<tr>
						<th class="doc">Documentación</th>
						<th class="sol">Solicitada</th>
						<th class="exh">Exhibida</th>
						<th class="obs">Observaciones</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td></td>
						<td class="si-no">Si / No</td>
						<td class="si-no">Si / No</td>
						<td></td>
					</tr>
					@foreach($documentos as $documento)
					<tr>
						<td class="nombre-documento">{{ $documento->documentacionRequerida->nombre }}</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					@endforeach
				</tbody>
			</table>
			@include('acta-inspeccion.segunda-seccion')
	</body>
</html>