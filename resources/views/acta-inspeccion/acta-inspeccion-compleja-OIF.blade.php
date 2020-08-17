<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>INSPECCION 2019-2021</title>
		<link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.css') }}" />
		<style>
			body{
				font-family: Arial, Helvetica, sans-serif !important;
				max-width: 98%;
				display:block;
				margin:auto;
			}
			.page_break{
				page-break-after: always;
			}
		</style>
	</head>
	<body>
		@foreach($formavalorada->inspeccion as $inspeccion)
		<img src="{{ asset('img/header-orden-inspeccion.jpg') }}" width="100%" class="mb-3">	
		<h6 class="text-right mb-3 font-weight-bold">FOLIO: {{ $inspeccion->folio }}</h6>
		@if($inspeccion->comercio == null)
		<p class="mb-0 mt-0" style="line-height: 1.2;"><b style="font-size:12px;letter-spacing:2px;">NOMBRE DEL CONTRIBUYENTE: </b>___________________________________________________________________________</p>
		<p class="mb-0 mt-0" style="line-height: 1.2;"><b style="font-size:12px;letter-spacing:2px;">NOMBRE COMERCIAL DEL ESTABLECIMIENTO: </b>_______________________________________________________________</p>
		<p class="mb-0 mt-0" style="line-height: 1.2;"><b style="font-size:12px;letter-spacing:2px;">DOMICILIO DEL ESTABLECIMIENTO: </b>_______________________________________________________________________</p>
		<p class="mb-3 mt-0" style="line-height: 1.2;"><b style="font-size:12px;letter-spacing:2px;">NÚMERO DE PADRÓN MUNICIPAL: </b>_________________________________________________________________________</p>
		@else
		<p class="mb-0 mt-0" style="line-height: 1.2;"><b style="font-size:12px;letter-spacing:2px;">NOMBRE DEL CONTRIBUYENTE: </b>{{ $inspeccion->comercio->propietarionombre }}</p>
		<p class="mb-0 mt-0" style="line-height: 1.2;"><b style="font-size:12px;letter-spacing:2px;">NOMBRE COMERCIAL DEL ESTABLECIMIENTO: </b>{{ $inspeccion->comercio->nombreestablecimiento }}</p>
		<p class="mb-0 mt-0" style="line-height: 1.2;"><b style="font-size:12px;letter-spacing:2px;">DOMICILIO DEL ESTABLECIMIENTO: </b>{{ $inspeccion->comercio->domiciliofiscal }}</p>
		<p class="mb-3 mt-0" style="line-height: 1.2;"><b style="font-size:12px;letter-spacing:2px;">NÚMERO DE PADRÓN MUNICIPAL: </b></p>
		@endif
		<p class="text-justify mb-3" style="font-size:10px;letter-spacing:1px;">Esta Dirección de Fiscalización dependiente de la Tesorería Municipal del Ayuntamiento de Benito Juárez, Quintana Roo, con fundamento en los Artículos 16 y 115, fracción V, inciso f), de la Constitución Política de los Estados Unidos Mexicanos; 1, 2, 3, 24, 126, 127 y 128, fracción VI, de la Constitución Política del Estado Libre y Soberano de Quintana Roo; 1,2, 3, 116, fracción II, 122, 125, fracciones I, III, VII y XIX, de la Ley de los Municipios del Estado de Quintana Roo; 1, 2, 3, 4, 5, fracciones XI y XXVIII, 6 fracción IV, V, VI y VII, 7, 8, 17, 60, Apartado B, fracciones I, II, III, IV, VI, XVI y LXIII, 479, 480, 481, 482, 484, 485, 486, 491, 492, 498, 499, 502, 503 y 504 del Bando de Gobierno y Policía del Municipio de Benito Juárez, Quintana Roo; 1, 2, 3, 4, 6, 8, 34, 35, 38, 39, 52, 53, 54, 95, 98, 99, 116, 118, 119, 120, 135, 136, 137, 139, fracción XII, 141, fracciones V, VI, VII, 142, fracciones V, VI, VII, y 155, fracción I, incisos a) y b), de la Ley de Hacienda del Municipio de Benito Juárez del Estado de Quintana Roo; 1, 4, 5, fracciones II, V y VII, 11, 18, 19, 30, 33, fracciones I, II, III, IV, XI y XII, 40, 42, fracciones II y IV, 43, 45, 48, 51, fracción I, y 52 del Código Fiscal Municipal del Estado de Quintana Roo; 37 de la Ley para la Prevención y la Gestión integral de Residuos del Estado de Quintana Roo; 7, 22, fracción II, 35, fracciones II, III, XXV, XXVI, XXVII, XXVIII, XXXI y XLVI, y 36, fracción V, del  Reglamento Orgánico de la Administración Pública Centralizada del Municipio de Benito Juárez, Quintana Roo; 2, fracciones II y VI, 7, 9, 10, fracción I, inciso e), 12, 13, fracciones I y IV, y 22, fracciones II, III, IV, V, VIII, IX, XII, XIII, XV y XVIII, del Reglamento Interior de la Tesorería Municipal de Benito Juárez, todos ordenamientos jurídicos vigentes; expide la presente ORDEN DE INSPECCIÓN, para tal efecto se designa, autoriza y comisiona al @if($inspeccion->inspector == null) C._________________________________________, @else <b>C. {{ $inspeccion->inspector->nombre }} {{ $inspeccion->inspector->apellidopaterno }} {{ $inspeccion->inspector->apellidomaterno }},</b> @endif Inspector, Verificador y Notificador – Ejecutor adscritos a la Dirección de Fiscalización de la Tesorería Municipal del H. Ayuntamiento Benito Juárez, Quintana Roo, quienes podrán actuar conjunta o individualmente y deberán acreditar ese carácter con su identificación con fotografía y sello oficial vigente, expedida por el Lic. Marcelo José Guzmán, en su carácter de Tesorero Municipal del Municipio de Benito Juárez Quintana Roo, con fundamento en el artículo 11, fracción XI, del Reglamento Interior de la Tesorería Municipal de Benito Juárez; para que se presente en el domicilio del establecimiento arriba señalado y realice la inspección que corresponda, debiendo verificar que cumpla con el giro y horario de operación de dicho establecimiento comercial, que tenga a la vista la documentación vigente que acredite su correcto funcionamiento y que se encuentre al corriente del pago de sus contribuciones municipales, por lo que, se le requiere que permita al Inspector, Verificador y Notificador–Ejecutor el acceso y recorrido a su establecimiento y le exhiba el original de los documentos aplicables a su giro comercial y actividades, según sea el caso, entre otros, los consistentes en: @foreach($formavalorada->tipoInspeccion->documentacionPorTipoDeInspeccion as $documento)<b> {{ $documento->documentacionRequerida->nombre }}; </b>@endforeach lo anterior, para que se conozca su situación fiscal y administrativa, levantándose al efecto el Acta de Inspección en la que se deje constancia de lo aquí ordenado, apercibido que en caso de no hacerlo será sancionado según su conducta en términos de los artículos 505, 506, 507 y 509, fracción IV y VII, del Bando de Gobierno y Policía del Municipio de Benito Juárez, Quintana Roo y 68, fracciones I,III,V, X, XI y XV, del Código Fiscal Municipal del Estado de Quintana Roo, vigentes; autorizándose en su caso la intervención y acceso de elementos de la Fuerza Pública Municipal para su cumplimiento. Para el caso de prolongarse la realización de la diligencia aquí ordenada, con fundamento en lo dispuesto por el  artículo 18 del Código Fiscal Municipal del Estado de Quintana Roo, se habilita el horario comprendido de las 18:01 a las 24:00 horas del @if($inspeccion->comercio == null) día _____ de __________ del año _______, @else {{ $fecha_hoy }} @endif  así como de las 00:00 a las 07:29 horas del @if($inspeccion->comercio == null OR $inspeccion->fechavence == null) día _____ de _________ del año ______ @else {{ strftime("%d de %B del %G", strtotime($inspeccion->fechavence)) }} @endif en el cual podrá iniciarse o continuarse hasta su conclusión.</p>
		<p style="font-size:11px;letter-spacing:1px;"><b>Cancún, Municipio de Benito Juárez, Quintana Roo, @if($inspeccion->comercio == null) a _____ de _________ de ______. @else {{ $fecha_hoy }}.  @endif  </b></p>
		<p style="font-size:12px;"><b>A T E N T A M E N T E</b></p>
		<table class="firma-orden-inspeccion">
			<tr>
				<td style="width:40%;">
					@if(is_object($inspeccion->formavalorada))
					<p class="text-uppercase mb-0 mt-0" style="font-size:12px;letter-spacing:2px;"><b>{{ $inspeccion->formavalorada->encargado->nombre }} {{ $inspeccion->formavalorada->encargado->apellidopaterno }} {{ $inspeccion->formavalorada->encargado->apellidomaterno }}</b></p>
					<p class="text-uppercase mb-0 mt-0" style="font-size:12px;letter-spacing:2px;"><b>{{ $inspeccion->formavalorada->encargado->puesto }}</b></p>
					@endif
				</td>
				<td style="width:60%;">
					<div style="padding:5px;border-style:solid;border-width:1px;">
					<p class="text-uppercase mb-0 mt-0" ><b style="font-size:12px;letter-spacing:2px;">Firma: </b>____________________________________________________</p>
						<p class="text-uppercase mb-0 mt-0" ><b style="font-size:12px;letter-spacing:2px;">Nombre: </b>__________________________________________________</p>
						<p class="text-uppercase mb-0 mt-0" ><b style="font-size:12px;letter-spacing:2px;">Fecha:</b>____________________________________________________</p>
						<br>
						<p class="mt-0" style="font-size:10px;letter-spacing:1px;">Constancia de recepción de la presente Orden de Inspección. Los datos de identificación de la persona que recibe deberán quedar asentados en el Acta de Inspección que se realizará.</p>
					</div>
				</td>
			</tr>
		</table>
		<div class="page_break"></div>

		<img src="{{ asset('img/header-acta-inspeccion-comp.jpg') }}" width="100%" class="mb-3">
		<h6 class="text-center mb-3 font-weight-bold">ACTA DE INSPECCIÓN NÚMERO: {{ $inspeccion->folio }}</h6>
		<p class="text-justify mb-0" style="font-size:10px;letter-spacing:1px;">En Cancún, Quintana Roo, siendo las _______ horas del  @if($inspeccion->comercio == null) día _____ de __________ del año ______, @else {{ $fecha_hoy }}, @endif el/los suscrito(s) inspector, notificador-ejecutor @if($inspeccion->inspector == null) C._________________________________________, @else <b>C. {{ $inspeccion->inspector->nombre }} {{ $inspeccion->inspector->apellidopaterno }} {{ $inspeccion->inspector->apellidomaterno }},</b> @endif con fundamento en los artículos 16 de la Constitución Política de los Estados Unidos Mexicanos, 24 de la Constitución Política del Estado Libre y Soberano de Quintana Roo y 40 del Código Fiscal Municipal del Estado de Quintana Roo, en cumplimiento a la orden de inspección número {{ $inspeccion->folio }} de fecha ____________________________________, emitida por el Ingeniero @if(is_object($inspeccion->formavalorada)) {{ $inspeccion->formavalorada->encargado->nombre }} {{ $inspeccion->formavalorada->encargado->apellidopaterno }} {{ $inspeccion->formavalorada->encargado->apellidomaterno }} en su carácter de {{ $inspeccion->formavalorada->encargado->puesto }}, @endif me constituí en el domicilio  del contribuyente @if(is_object($inspeccion->comercio)) {{ $inspeccion->comercio->propietarionombre }} @else _______________________________________ @endif, ubicado en @if(is_object($inspeccion->comercio)) {{ $inspeccion->comercio->domiciliofiscal }} {{ $inspeccion->comercio->cp }} @else _________________________________________________ @endif, de esta ciudad de Cancún, Quintana Roo, cerciorándome que es el domicilio buscado por medio de _________________________________________________________________________ atendiendo la diligencia quien dijo llamarse _______________________________________________ quien dijo ser _______________________________________________ de la persona buscada y se identifica por medio de ______________________________________________________; requiriendole en este momento la presencia del contribuyente o su representante legal, quien informó que si (____) no (____) se encuentra, por lo que se entiende la presente orden de visita con el/la C. ______________________________________________________ quien dijo ser __________________________________________ en su carácter de ____________________________________________ acredintándolo con ________________________________________________________________, y quien se identifica con __________________________________________________; persona ante quien el suscrito se identifican como autoridad fiscal, con la credencial número ___________________________, vigente del __________________________________ al _______________________________________, expedida por el Tesorero Municipal del Municipio de Benito Juárez, Quintana Roo, Lic. Marcelo José Guzmán, con fundamento en lo dispuesto en el artículo 11 fracción XI del Reglamento Interior de la Tesorería del Municipio de Benito Juárez, Quintana Roo  documentos que contiene su firma autógrafa y fotografía; por si (____) no (____) haber precedido citatorio, a través del cual se citó al deudor o a su Representante Legal para que sirviera esperar al suscrito en su domicilio en la fecha y en la hora en la que se actúa, por lo que en este momento se le notifica la orden de inspección número {{ $inspeccion->folio }} de fecha _______________________, expedida por el Director de Fiscalización del Municipio de Benito Juárez, Quintana Roo, a través de la cual se ordena iniciar una inspección con el objeto o propósito de comprobar el cumplimiento de las disposiciones fiscales a que está afecto como sujeto directo en materia de las siguientes contribuciones municipales: @foreach($formavalorada->tipoInspeccion->documentacionPorTipoDeInspeccion as $documento)<b> {{ $documento->documentacionRequerida->nombre }}; </b>@endforeach Por lo que con fundamento en el artículo 44 fracción III del Código Fiscal Municipal para el Estado de quintana Roo, se le requiere a la persona con la que se entiende la visita domiciliaria  para que designe a dos testigos, apercibiéndole que en caso de no designarlos o que los designados no acepten servir como tales, serán designados por la autoridad fiscal, sin que tal situación afecta la legalidad de la presente diligencia, a lo que la persona con la que se entiende la diligencia a lo que manifestó que si (____) no (____) designa testigos por lo que el visitado (______) el verificador (______) designa como testigos a:_____</p>
		<p class="mb-0 mt-0" style="line-height: 1;">____________________________________________________________________________________________________</p>
		<p class="mb-0 mt-0" style="line-height: 1;">____________________________________________________________________________________________________</p>
		<p class="mb-0 mt-0" style="line-height: 1;">____________________________________________________________________________________________________</p>
		<p class="mb-2 mt-0" style="line-height: 1;">____________________________________________________________________________________________________</p>
		<p class="text-justify mb-2" style="font-size:10px;letter-spacing:1px;">En este momento se le requiere a la persona con la que se entiende la presente visita domiciliaria para que presente en este momento el original o los originales de la siguiente documentación a través del o los cuales acredita haber cumplido con sus obligaciones fiscales:</p>
		<table class="table table-bordered table-sm">
			<thead class="text-center text-uppercase" style="font-size:8px;letter-spacing:1px;">
				<tr>
					<th style="width:50%;">Documentación</th>
					<th style="width:5%;">Solicitada</th>
					<th style="width:5%;">Exhibida</th>
					<th style="width:30%;">Observaciones</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td ></td>
					<td class="text-center text-uppercase font-weight-bold pt-0 pb-0" style="font-size:8px;letter-spacing:1px;">Si / No</td>
					<td class="text-center text-uppercase font-weight-bold pt-0 pb-0" style="font-size:8px;letter-spacing:1px;">Si / No</td>
					<td ></td>
				</tr>
				@foreach($formavalorada->tipoInspeccion->documentacionPorTipoDeInspeccion as $documento)
				<tr>
					<td class="text-uppercase font-weight-bold pt-0 pb-0" style="font-size:7px;">{{ $documento->documentacionRequerida->nombre }}</td>
					<td ></td>
					<td ></td>
					<td ></td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<p class="text-justify mb-0" style="font-size:10px;letter-spacing:1px;">Finalmente el suscrito, le informa al visitado el derecho que tiene a formular observaciones en el acto de la diligencia y ofrecer pruebas en relación a los hechos contenidos en ella, o bien, por escrito, hacer uso de tal derecho dentro del término de 10 días hábiles siguientes a la fecha en que se hubiere levantado la presente diligencia, quien manifiesta que ____________________________________________________________________________________</p>
		<p class="mb-0 mt-0" style="line-height: 1;">____________________________________________________________________________________________________</p>
		<p class="mb-0 mt-0" style="line-height: 1;">____________________________________________________________________________________________________</p>
		<p class="mb-0 mt-0" style="line-height: 1;">____________________________________________________________________________________________________</p>
		<p class="mb-2 mt-0" style="line-height: 1;">____________________________________________________________________________________________________</p>
		<p class="text-justify mb-0" style="font-size:10px;letter-spacing:1px;">Independientemente de lo anterior, el verificador formula las siguientes observaciones: _________________________________________________________</p>
		<p class="mb-0 mt-0" style="line-height: 1;">____________________________________________________________________________________________________</p>
		<p class="mb-0 mt-0" style="line-height: 1;">____________________________________________________________________________________________________</p>
		<p class="mb-0 mt-0" style="line-height: 1;">____________________________________________________________________________________________________</p>
		<p class="mb-2 mt-0" style="line-height: 1;">____________________________________________________________________________________________________</p>
		<p class="text-justify mb-5" style="font-size:10px;letter-spacing:1px;">Asimismo, derivado  de los resultados de la presente Inspección, con fundamento en el artículo 51, fracción I, del Código Fiscal Municipal del Estado de Quintana Roo, en este acto se le requiere al  contribuyente o a su representante legal, para que dentro del término de diez días contados a  partir del día siguiente al que se realiza esta diligencia, comparezca en las oficinas de la Dirección de Fiscalización dependiente de la Tesorería Municipal de Benito Juárez, Quintana Roo, ubicada en Edificio anexo al Palacio Municipal  en la Avenida Nader sin número, Supermanzana 5, de esta ciudad de Cancún, Quintana Roo, para exhibir la documentación que no exhibe en la presente diligencia, apercibido que en caso de no hacerlo se procederá de conformidad con lo establecido en el artículo 68 del Código Fiscal Municipal del Estado de Quintana Roo. Asimismo, en el caso de no contar con la licencia de funcionamiento municipal al momento de la diligencia, se le apercibe al contribuyente que el establecimiento visitado podrá ser sujeto a clausura en cualquier momento, ello de conformidad con lo establecido en los artículos 479 y 509, fracciones IV y VII del Bando de Gobierno y Policía del Municipio de Benito Juárez, Quintana Roo, ya que para el ejercicio de cualquier actividad comercial, industrial o de servicios por parte de los contribuyentes, se requiere de permiso, licencia o autorización, según sea el caso, expedido por el Ayuntamiento, entendiéndose que no cuenta la autorización para funcionar si no exhibe la licencia de funcionamiento municipal correspondiente. Con lo anterior se da por concluida la presente diligencia, siendo las _______ horas con ______ minutos del @if($inspeccion->comercio == null) día _____ del mes ___________ del año _______, @else {{ $fecha_hoy }}, @endif se levanta el acta correspondiente, la cual se leyó en presencia de los que en ella intervinieron, haciéndole entrega al visitado de una copia de la presente con firmas autógrafas, la cual ratifican y firman para constancia los que en ella intervinieron y así quisieron hacerlo.</p>
		<table class="text-uppercase text-center" style="width: 100%;">
			<tr>
				<td>
					<b>INSPECTOR, NOTIFICADOR-EJECUTOR</b>
					<p>________________________________________</p>
					<p><b>NOMBRE Y FIRMA</b></p>
				</td>
			</tr>
		</table>
		<h4 class="text-center"><b>LOS TESTIGOS</b></h4>
		<table class="text-center mt-0" style="width: 100%;">
			<tr>
				<td>
					<p>_________________________________</p>
					<p><b>Nombre y Firma del Testigo de Asistencia</b></p>
				</td>
				<td>
					<p>_________________________________</p>
					<p><b>Nombre y Firma del Testigo de Asistencia</b></p>
				</td>
			</tr>
		</table>
		<h4 class="text-center"><b>PERSONA CON LA QUE SE ENTENDIÓ LA VISITA DOMICILIARIA</b></h4>
		<p class="text-center">_______________________________________________________________________</p>
		<p class="text-center"><b>Nombre y Firma</b></p>
		<div class="page_break"></div>
		@endforeach
	</body>
</html>