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
			<p class="contenido-general">Esta Dirección de Fiscalización dependiente de la Tesorería Municipal del Ayuntamiento de Benito Juárez, Quintana Roo, con fundamento en los Artículos 16 y 115, fracción V, inciso f), de la Constitución Política de los Estados Unidos Mexicanos; 1, 2, 3, 24, 126, 127 y 128, fracción VI, de la Constitución Política del Estado Libre y Soberano de Quintana Roo; 1,2, 3, 116, fracción II, 122, 125, fracciones I, III, VII y XIX, de la Ley de los Municipios del Estado de Quintana Roo; 1, 2, 3, 4, 5, fracciones XI y XXVIII, 6 fracción IV, V, VI y VII, 7, 8, 17, 60, Apartado B, fracciones I, II, III, IV, VI, XVI y LXIII, 479, 480, 481, 482, 484, 485, 486, 491, 492, 498, 499, 502, 503 y 504 del Bando de Gobierno y Policía del Municipio de Benito Juárez, Quintana Roo; 1, 2, 3, 4, 6, 8, 34, 35, 38, 39, 52, 53, 54, 95, 98, 99, 116, 118, 119, 120, 135, 136, 137, 139, fracción XII, 141, fracciones V, VI, VII, 142, fracciones V, VI, VII, y 155, fracción I, incisos a) y b), de la Ley de Hacienda del Municipio de Benito Juárez del Estado de Quintana Roo; 1, 4, 5, fracciones II, V y VII, 11, 18, 19, 30, 33, fracciones I, II, III, IV, XI y XII, 40, 42, fracciones II y IV, 43, 45, 48, 51, fracción I, y 52 del Código Fiscal Municipal del Estado de Quintana Roo; 37  de la Ley para la Prevención y la Gestión integral de Residuos del Estado de Quintana Roo; 7, 22, fracción II, 35, fracciones II, III, XXV, XXVI, XXVII, XXVIII, XXXI y XLVI, y 36, fracción V, del  Reglamento Orgánico de la Administración Pública Centralizada del Municipio de Benito Juárez, Quintana Roo; 2, fracciones II y VI, 7, 9, 10, fracción I, inciso e), 12, 13, fracciones I y IV, y 22, fracciones II, III, IV, V, VIII, IX, XII, XIII, XV y XVIII, del Reglamento Interior de la Tesorería Municipal de Benito Juárez, todos ordenamientos jurídicos vigentes; expide la presente ORDEN DE INSPECCIÓN, para tal efecto se designa, autoriza y comisiona al/los @if($inspeccion->inspector == null) C._________________________________________, @else <b>C. {{ $inspeccion->inspector->nombre }} {{ $inspeccion->inspector->apellidopaterno }} {{ $inspeccion->inspector->apellidomaterno }},
			@if(count($inspectoresExtra) >= 1) 
				@foreach($inspectoresExtra as $inspectorExtra)
					{{ $inspectorExtra[0]['nombre'] }} {{ $inspectorExtra[0]['apellidopaterno'] }} {{ $inspectorExtra[0]['apellidomaterno'] }},
				@endforeach
			@endif
			</b> @endif Inspector, Verificador y Notificador – Ejecutor adscritos a la Dirección de Fiscalización de la Tesorería Municipal del H. Ayuntamiento Benito Juárez, Quintana Roo, quienes podrán actuar conjunta o individualmente y deberán acreditar ese carácter con su identificación con fotografía y sello oficial vigente, expedida por el Lic. Marcelo José Guzmán, en su carácter de Tesorero Municipal del Municipio de Benito Juárez Quintana Roo, con fundamento en el artículo 11, fracción XI, del Reglamento Interior de la Tesorería Municipal de Benito Juárez; para que se presente en el domicilio del establecimiento arriba señalado y realice la inspección que corresponda, debiendo verificar que cumpla con el giro y horario de operación de dicho establecimiento comercial, que tenga a la vista la documentación vigente que acredite su correcto funcionamiento y que se encuentre al corriente del pago de sus contribuciones municipales, por lo que, se le requiere que permita al Inspector, Verificador y Notificador–Ejecutor el acceso y recorrido a su establecimiento y le exhiba el original de los documentos aplicables a su giro comercial y actividades, según sea el caso, entre otros, los consistentes en: @foreach($inspeccion->tipoInspeccion->documentacionPorTipoDeInspeccion as $documento)<b>{{ $documento->documentacionRequerida->nombre }}; </b>@endforeach lo anterior, para que se conozca su situación fiscal y administrativa, levantándose al efecto el Acta de Inspección en la que se deje constancia de lo aquí ordenado, apercibido que en caso de no hacerlo será sancionado según su conducta en términos de los artículos 505, 506, 507 y 509, fracción IV y VII, del Bando de Gobierno y Policía del Municipio de Benito Juárez, Quintana Roo y 68, fracciones I,III,V, X, XI y XV, del Código Fiscal Municipal del Estado de Quintana Roo, vigentes; autorizándose en su caso la intervención y acceso de elementos de la Fuerza Pública Municipal para su cumplimiento. Para el caso de prolongarse la realización de la diligencia aquí ordenada, con fundamento en lo dispuesto por el  artículo 18 del Código Fiscal Municipal del Estado de Quintana Roo, se habilita el horario comprendido de las 18:01 a las 24:00 horas del @if($inspeccion->comercio == null) día _____ de __________ del año _______, @else {{ $fecha_hoy }} @endif  así como de las 00:00 a las 07:29 horas del @if($inspeccion->comercio == null OR $inspeccion->fechavence == null) día _____ de _________ del año ______ @else {{ strftime("%d de %B del %G", strtotime($inspeccion->fechavence)) }}, @endif en el cual podrá iniciarse o continuarse hasta su conclusión.</p>
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
			<p class="aic-contenido-general mb-0">En Cancún, Quintana Roo, siendo las _______ horas del @if($inspeccion->comercio == null) día _____ de __________ del año ______, @else {{ $fecha_hoy }}, @endif el/los suscrito(s) inspector, notificador-ejecutor @if($inspeccion->inspector == null) C._________________________________________, @else <b>C. {{ $inspeccion->inspector->nombre }} {{ $inspeccion->inspector->apellidopaterno }} {{ $inspeccion->inspector->apellidomaterno }},</b> @endif con fundamento en los artículos 16 de la Constitución Política de los Estados Unidos Mexicanos, 24 de la Constitución Política del Estado Libre y Soberano de Quintana Roo y 40 del Código Fiscal Municipal del Estado de Quintana Roo, en cumplimiento a la orden de inspección número {{ $inspeccion->folio }} de fecha ____________________________________, emitida por el Ingeniero @if(is_object($inspeccion->formavalorada)) {{ $inspeccion->formavalorada->encargado->nombre }} {{ $inspeccion->formavalorada->encargado->apellidopaterno }} {{ $inspeccion->formavalorada->encargado->apellidomaterno }} en su carácter de {{ $inspeccion->formavalorada->encargado->puesto }}, @endif me constituí en el domicilio  del contribuyente @if(is_object($inspeccion->comercio)) {{ $inspeccion->comercio->propietarionombre }} @else _______________________________________ @endif, ubicado en @if(is_object($inspeccion->comercio)) {{ $inspeccion->comercio->domiciliofiscal }} {{ $inspeccion->comercio->cp }} @else _________________________________________________ @endif, de esta ciudad de Cancún, Quintana Roo, cerciorándome que es el domicilio buscado por medio de _________________________________________________________________________ atendiendo la diligencia quien dijo llamarse _______________________________________________ quien dijo ser _______________________________________________ de la persona buscada y se identifica por medio de ______________________________________________________; requiriendole en este momento la presencia del contribuyente o su representante legal, quien informó que si (____) no (____) se encuentra, por lo que se entiende la presente orden de visita con el/la C. ______________________________________________________ quien dijo ser __________________________________________ en su carácter de ____________________________________________ acredintándolo con ________________________________________________________________, y quien se identifica con __________________________________________________; persona ante quien el suscrito se identifican como autoridad fiscal, con la credencial número ___________________________, vigente del __________________________________ al _______________________________________, expedida por el Tesorero Municipal del Municipio de Benito Juárez, Quintana Roo, Lic. Marcelo José Guzmán, con fundamento en lo dispuesto en el artículo 11 fracción XI del Reglamento Interior de la Tesorería del Municipio de Benito Juárez, Quintana Roo  documentos que contiene su firma autógrafa y fotografía; por si (____) no (____) haber precedido citatorio, a través del cual se citó al deudor o a su Representante Legal para que sirviera esperar al suscrito en su domicilio en la fecha y en la hora en la que se actúa, por lo que en este momento se le notifica la orden de inspección número {{ $inspeccion->folio }} de fecha _______________________, expedida por el Director de Fiscalización del Municipio de Benito Juárez, Quintana Roo, a través de la cual se ordena iniciar una inspección con el objeto o propósito de comprobar el cumplimiento de las disposiciones fiscales a que está afecto como sujeto directo en materia de las siguientes contribuciones municipales: @foreach($inspeccion->tipoInspeccion->documentacionPorTipoDeInspeccion as $documento)<b>{{ $documento->documentacionRequerida->nombre }}.</b>@endforeach Por lo que con fundamento en el artículo 44 fracción III del Código Fiscal Municipal para el Estado de quintana Roo, se le requiere a la persona con la que se entiende la visita domiciliaria  para que designe a dos testigos, apercibiéndole que en caso de no designarlos o que los designados no acepten servir como tales, serán designados por la autoridad fiscal, sin que tal situación afecta la legalidad de la presente diligencia, a lo que la persona con la que se entiende la diligencia a lo que manifestó que si (____) no (____) designa testigos por lo que el visitado (______) el verificador (______) designa como testigos a: ________________________________________________________________________________________________________________________________________</p>
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
					@foreach($inspeccion->tipoInspeccion->documentacionPorTipoDeInspeccion as $documento)
					<tr>
						<td class="nombre-documento">{{ $documento->documentacionRequerida->nombre }}</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					@endforeach
				</tbody>
			</table>
			<p class="aic-contenido-general mb-0">Finalmente el suscrito, le informa al visitado el derecho que tiene a formular observaciones en el acto de la diligencia y ofrecer pruebas en relación a los hechos contenidos en ella, o bien, por escrito, hacer uso de tal derecho dentro del término de 10 días hábiles siguientes a la fecha en que se hubiere levantado la presente diligencia, quien manifiesta que ______________________________________________________________________________________________________________</p>
			<p class="aic-contenido-general mbt-0">________________________________________________________________________________________________________________________________________</p>
			<p class="aic-contenido-general mbt-0">________________________________________________________________________________________________________________________________________</p>
			<p class="aic-contenido-general mbt-0">________________________________________________________________________________________________________________________________________</p>
			<p class="aic-contenido-general mbt-0">________________________________________________________________________________________________________________________________________</p>

			<p class="aic-contenido-general mb-0">Independientemente de lo anterior, el verificador formula las siguientes observaciones: __________________________________________________________________</p>
			<p class="aic-contenido-general mbt-0">________________________________________________________________________________________________________________________________________</p>
			<p class="aic-contenido-general mbt-0">________________________________________________________________________________________________________________________________________</p>
			<p class="aic-contenido-general mbt-0">________________________________________________________________________________________________________________________________________</p>
			<p class="aic-contenido-general mbt-0">________________________________________________________________________________________________________________________________________</p>
			<p class="aic-contenido-general">Asimismo, derivado  de los resultados de la presente Inspección, con fundamento en el artículo 51, fracción I, del Código Fiscal Municipal del Estado de Quintana Roo, en este acto se le requiere al  contribuyente o a su representante legal, para que dentro del término de diez días contados a  partir del día siguiente al que se realiza esta diligencia, comparezca en las oficinas de la Dirección de Fiscalización dependiente de la Tesorería Municipal de Benito Juárez, Quintana Roo, ubicada en Edificio anexo al Palacio Municipal  en la Avenida Nader sin número, Supermanzana 5, de esta ciudad de Cancún, Quintana Roo, para exhibir la documentación que no exhibe en la presente diligencia, apercibido que en caso de no hacerlo se procederá de conformidad con lo establecido en el artículo 509, fracciones IV y VII del Bando de Gobierno y Policía del Municipio de Benito Juárez, Quintana Roo y 68 del Código Fiscal Municipal del  Estado de Quintana Roo. Asimismo, en el caso de no contar con la licencia de funcionamiento municipal al momento de la diligencia, se le apercibe al contribuyente que el establecimiento visitado podrá ser sujeto a clausura en cualquier momento, ello de conformidad con lo establecido en los artículos 479 y 509, fracciones IV y VII del Bando de Gobierno y Policía del Municipio de Benito Juárez, Quintana Roo, ya que para el ejercicio de cualquier actividad comercial, industrial o de servicios por parte de los contribuyentes, se requiere de permiso, licencia o autorización, según sea el caso, expedido por el Ayuntamiento, entendiéndose que no cuenta la autorización para funcionar si no exhibe la licencia de funcionamiento municipal correspondiente. Con lo anterior se da por concluida la presente diligencia, siendo las _______ horas con ______ minutos del @if($inspeccion->comercio == null) día _____ del mes ___________ del año _______, @else {{ $fecha_hoy }}, @endif se levanta el acta correspondiente, la cual se leyó en presencia de los que en ella intervinieron, haciéndole entrega al visitado de una copia de la presente con firmas autógrafas, la cual ratifican y firman para constancia los que en ella intervinieron y así quisieron hacerlo.</p>
			<br>
			<table class="aic-firma-inspector">
				<tr>
					<td>
						<b class="mb-0">INSPECTOR, NOTIFICADOR-EJECUTOR</b>
						<p class="mbt-0">________________________________________</p>
						<p class="mbt-0"><b>NOMBRE Y FIRMA</b></p>
					</td>
				</tr>
			</table>
			<h4 class="text-center"><b>LOS TESTIGOS</b></h4>
			<table class="aic-firma-testigo mt-0">
				<tr>
					<td>
						<p class="mbt-0">_________________________________</p>
						<p><b>Nombre y Firma del Testigo de Asistencia</b></p>
					</td>
					<td>
						<p class="mbt-0">_________________________________</p>
						<p><b>Nombre y Firma del Testigo de Asistencia</b></p>
					</td>
				</tr>
			</table>
			<h4 class="text-center mt-0"><b>PERSONA CON LA QUE SE ENTENDIÓ LA VISITA DOMICILIARIA</b></h4>
			<p class="mbt-0 text-center mbt-0">_______________________________________________________________________</p>
			<p class="text-center"><b>Nombre y Firma</b></p>
			</div>
	</body>
</html>