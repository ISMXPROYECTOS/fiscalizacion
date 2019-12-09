<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>MULTA FISCAL</title>
	<link rel="stylesheet" href="{{ asset('css/multa-oivp.css') }}" />
</head>
<body>
	@foreach($multas as $multa)
	<img src="{{ asset('img/header-multa-fiscal.jpg') }}" width="100%">
	<div class="multa-header-datos-div mt-3">
		<p class="multa-header-datos mbt-0 ">AYUNTAMIENTO DE BENITO JUÁREZ QUINTANA ROO</p>
		<p class="multa-header-datos mbt-0 ">TESORERÍA MUNICIPAL</p>
		<p class="multa-header-datos mbt-0 ">DIRECCIÓN DE FISCALIZACIÓN</p>
		<p class="multa-header-datos mbt-0 ">FOLIO: <b>{{ $inspeccion->folio }}</b></p>
		<p class="multa-header-datos mbt-0 "><b>ASUNTO: RESOLUCIÓN ADMINISTRATIVA</b></p>
		<p class="multa-header-datos mbt-0 ">CANCUN, QUINTANA ROO A ____________________________</p>
	</div>

	

	<p class="contenido-general">Visto el estado que guarda el presente expediente, formado con motivo de la visita de verificación efectuada en el domicilio de la empresa @if(is_object($inspeccion->comercio)) {{ $inspeccion->comercio->propietarionombre }} @else ____________________________________________ @endif y en cumplimiento a la sentencia de fecha ___________________________, radicada ante la Sala Constitucional del Tribunal Superior de Justicia del Estado de Quintana Roo bajo el expediente _________________________, esta autoridad procede a emitir la resolución en el presente asunto, en base a los siguientes:</p>

	<h1>RESULTANDO</h1>

	<p class="contenido-general">
		<b>1.-</b> Que con fecha _______________________, personal adscrito a la Dirección de Fiscalización de la Tesorería Municipal, llevó a cabo visita de inspección en el domicilio de la empresa @if(is_object($inspeccion->comercio)) {{ $inspeccion->comercio->propietarionombre }} @else ______________________________________________, @endif ubicado en @if(is_object($inspeccion->comercio)) {{ $inspeccion->comercio->domiciliofiscal }} {{ $inspeccion->comercio->cp }} @else __________________________________________ @endif de esta Ciudad de Cancún, Quintana Roo, levantándose acta circunstanciada con el objeto de constatar que en el establecimiento se cumpla con el giro y horario de operación de dicho establecimiento comercial, que tenga a la vista la documentación vigente que acredite su correcto funcionamiento y que se encuentre al corriente del pago de sus contribuciones municipales, por lo que, requiriéndose al visitado que permita al Inspector, Verificador y Notificador–Ejecutor el acceso y recorrido a su establecimiento y le exhiba el original de los documentos aplicables a su giro comercial y actividades, según sea el caso, entre otros, los consistentes en: <b>@foreach($documentos_por_inspeccion as $documentos) @if(is_object($documentos->documentacionRequerida)) {{ $documentos->documentacionRequerida->nombre }}; @endif @endforeach</b> lo anterior, para que se conozca su situación fiscal y administrativa.
	</p>

	<p class="contenido-general"><b>2.-</b> En virtud de que la empresa no presentó escrito de manifestaciones y pruebas consistentes en documentales, mismas que se admiten y desahogan en el acto dada su propia y especial naturaleza, habiendo transcurrido el plazo de diez días hábiles a que se refiere el artículo 51, fracción I del Código Fiscal Municipal, esta autoridad procede a emitir resolución administrativa al tenor de los siguientes:</p>

	<h1>CONSIDERANDOS</h1>

	<p class="contenido-general">I.- La Dirección de Fiscalización de la Tesorería Municipal del H. Ayuntamiento de Benito Juárez, es competente para conocer la substanciación del presente procedimiento en términos de lo dispuesto por los artículos 1, 2, 3, 24, primer y último párrafo, 126, 127 y 128, fracción VI, de la Constitución Política del Estado Libre y Soberano de Quintana Roo; 1,2, 3, 116, fracción II, 122, 125, fracciones I, III, VII y XIX, de la Ley de los Municipios del Estado de Quintana Roo; 1, 2, 3, 5, fracciones XI y XXVIII, 6 fracción IV, V, VI y VII, 7, 8, 17, 60, Apartado B, fracciones I, II, III, IV, VI, XVI y LXIII, 479, 480, 481fracciones I al III, 482, 484, 485, 486, 491, 492, 498, 499 en todas sus fracciones, 502, 503 y 504 del Bando de Gobierno y Policía del Municipio de Benito Juárez, Quintana Roo; 1, 2, 3, 4, 6, 8, 34, 35, 38, 39, 52, 53, 54, 95, 98, 99, 116, 118, 119, 120, 135, 136, 137, 139, fracción XII, 141, fracciones V, VI, VII, 142, fracciones V, VI, VII, y 155, fracción I, incisos a) y b), de la Ley de Hacienda del Municipio de Benito Juárez del Estado de Quintana Roo; 1, 4 fracciones I al V, 5, fracciones II, V y VII, 33, fracciones I, II, III, IV, VII, X, XI y XII, 42, fracciones II y IV, y 51, fracción I, del Código Fiscal Municipal del Estado de Quintana Roo; 4, 5, 7, 14, 22, fracción II, 35, fracciones II, III, XXV, XXVII, XXVIII, XXX, XXXI y XLVI, y 36, fracción V, del  Reglamento Orgánico de la Administración Pública Centralizada del Municipio de Benito Juárez, Quintana Roo; 1, 7, 10, fracción I, inciso e), 12, 13, fracciones I, IV y X y 22, fracciones II, III, IV, V, VIII, IX, XII, XIII, XV y XVIII, del Reglamento Interior de la Tesorería Municipal de Benito Juárez, todos ordenamientos jurídicos vigentes.</p>
	
	<p class="contenido-general">II.- Como se desprende de las constancias que obran en el presente expediente, así como el acta de visita de inspección <b>{{ $inspeccion->folio }}</b> de fecha ____________________ personal adscrito a la Dirección de Fiscalización de la Tesorería Municipal del Municipio de Benito Juárez, llevó a cabo visita de inspección en el domicilio de la empresa @if(is_object($inspeccion->comercio)) {{ $inspeccion->comercio->propietarionombre }} @else ______________________________________________, @endif con el objeto de constatar que en el establecimiento se cumpla con el giro y horario de operación de dicho establecimiento comercial, que tenga a la vista la documentación vigente que acredite su correcto funcionamiento y que se encuentre al corriente del pago de sus contribuciones municipales, requiriéndose al visitado que permita al Inspector, Verificador y Notificador–Ejecutor el acceso y recorrido a su establecimiento y le exhiba el original de los documentos aplicables a su giro comercial y actividades, según sea el caso, entre otros, los consistentes en: <b>@foreach($documentos_por_inspeccion as $documentos) @if(is_object($documentos->documentacionRequerida)) {{ $documentos->documentacionRequerida->nombre }}; @endif @endforeach</b> lo anterior, para que se conozca su situación fiscal y administrativa.</p>

	<p class="contenido-general"><b>III.-</b> Que del Resultado de la visita de inspección y de la documentación que se le requiriera al contribuyente, se desprende que el contribuyente infringió el artículo 68 fracciones I, III, V, VIII y XI del Código Fiscal Municipal del Estado de Quintana Roo, toda vez que no exhibió la siguiente documentación:</p>

	<table class="multa-documentacion-requerida">
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
			@foreach($documentos_por_inspeccion as $documento)
			<tr>
				<td class="nombre-documento">{{ $documento->documentacionRequerida->nombre }}</td>
				<td>
					@if($documento->solicitado == 1)
						Si
					@else
						No
					@endif
				</td>
				<td>
					@if($documento->exhibido == 1)
						Si
					@else
						No
					@endif
				</td>
				<td>{{ $documento->observaciones }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	<p class="contenido-general"><b>IV.-</b> Derivado que el contribuyente no exhibió la documentación que se describe en el recuadro anterior, se desprende que el mismo ha infringido el artículo 68 fracciones I, III, V, VIII, XI y XII  del Código Fiscal Municipal, esto en relación con los artículos 16, 82 fracción III, 85 fracción II, 86 fracción I, II, III y IV, 101, 102, 120 fracciones I, II y III, 132 fracción V y 133 Quater de la Ley de Hacienda del Municipio de Benito Juárez Vigente al momento de la inspección, por lo que para dar cumplimiento a lo establecido en el artículo 65 del Código Fiscal Municipal, procede a cuantificar la multa en base a lo siguiente:</p>

	<p class="contenido-general"><b>V.-</b> Se concluye que la contribuyente visitada se ha ubicado dentro de los supuestos previstos en el artículo 68, fracciones I, III, V, VIII, XI y XII, del Código Fiscal Municipal del Estado de Quintana Roo vigente, en los siguientes términos:</p>

	<p class="contenido-general pl-5">-	En cuanto a la fracción I.- Con motivo de que el contribuyente no incluyó al momento de solicitar su licencia de funcionamiento todas las actividades inherentes a su giro, tales como funcionar como oficina administrativa (Bufete de prestación de servicios) y como encierro de vehículos, esto en términos de los artículos 88 fracción XXVI y 130 fracción IV punto 15 de la Ley de Hacienda del Municipio de Benito Juárez, vigente al momento de cometerse la infracción, por lo que, la contribuyente se hace acreedora a una sanción de 105 U.M.A.</p>

	<p class="contenido-general pl-5">-	En cuanto a la fracción III.- Con motivo de que el contribuyente no obtuvo previamente los permisos, autorizaciones y licencia de funcionamiento municipal 2017 exigidos por las disposiciones fiscales municipales en cuanto a los giros de oficina administrativa (Bufete de prestación de servicios) y como encierro de vehículos, por lo que, la contribuyente se hace acreedora a una sanción de 115 U.M.A.</p>

	<p class="contenido-general pl-5">-	Con relación a la fracción V.- Por no proporcionar los permisos, autorizaciones y licencia de funcionamiento municipal 2017 en cuanto a los giros de oficina administrativa (Bufete de prestación de servicios) y como encierro de vehículos, que exigen las disposiciones fiscales municipales, la contribuyente se hace acreedora a una sanción de 115 U.M.A.</p>

	<p class="contenido-general pl-5">-	Respecto a la fracción VIII.- Al no efectuar el pago de derechos a que se refiere el artículo 130 fracción IV punto 15 de la Ley de Hacienda del Municipio de Benito Juárez, vigente al momento de cometerse la infracción la contribuyente se hace acreedora a una sanción de 39 U.M.A.</p>

	<p class="contenido-general pl-5">-	Por lo que respecta a la fracción XI.- Al no haber presentado ante esta autoridad municipal cuando se le solicitó, los permisos, autorizaciones y licencia de funcionamiento municipal para el ejercicio fiscal de 2017 en relación a los giros de oficina administrativa (Bufete de prestación de servicios) y como encierro de vehículos, la contribuyente se hace acreedora a una sanción de 177 U.M.A.; y</p>

	<p class="contenido-general pl-5">-	Y respecto a la fracción XII.- Por iniciar cualquier actividad económica sin haber cubierto los requisitos exigidos por los distintos ordenamientos fiscales municipales, como lo son, los permisos, autorizaciones y licencia de funcionamiento municipal para el ejercicio fiscal de 2017 en relación a los giros de oficina administrativa (Bufete de prestación de servicios) y como encierro de vehículos, se le impone a la contribuyente una multa de 177 U.M.A.</p>

	<p class="contenido-general">En el caso a estudio, la aplicación de las sanciones se lleva a cabo por la cantidad de {{ $multa->total }}, esto es, {{ $multa->montoMulta }} de la unidad de medida y actualización vigente a la fecha en la que se cometió la infracción, de acuerdo a lo establecido por el Instituto Nacional de Estadística y Geografía (INEGI), publicado en el Diario Oficial de la Federación del 10 de enero de 2017, con un monto de {{ $multa->valorUma }}, quedando de la siguiente forma: </p>

	<table class="multa-formula">
	  <tr>
		<td class="cons">Multa determinada en Unidad de Medida y Actualización (UMA)</td>
		<td class="cant">{{ $multa->montoMulta }}</td>
	  </tr>
	  <tr>
		<td>Cantidad en pesos por Unidad de Medida y Actualización</td>
		<td>X {{ $multa->valorUma }}</td>
	  </tr>
	  <tr>
		<td>Total determinado en pesos</td>
		<td>{{ $multa->total }}</td>
	  </tr>
	</table>

	<p class="contenido-general">Cabe precisar que la conducta de la infractora se considera grave, ya que ocasiona un grave perjuicio al erario fiscal al no permitir llegar los recursos económicos de manera oportuna municipio, causando un detrimento en consecuencia en los servicios que el municipio presta, citando como ejemplos, la recolección de basura, pavimentación y bacheo, mantenimiento de parques y jardines entre otros.</p>

	<p class="contenido-general">En cuanto a las condiciones económicas y sociales del contribuyente, esta autoridad considera que la empresa sancionada cuenta con los recursos económicos para cubrir la multa que aquí se le impone, ello en razón de que durante la secuela procedimental, no exhibió documentación alguna que acredite estar en estado de insolvencia, suspensión de pagos o concurso mercantil en términos de la leyes aplicables, aunado de que es un hecho notorio que la empresa sancionada tiene presencia a nivel nacional, por lo que es evidente que sus condiciones económicas y sociales son suficientes para cubrir la multa que aquí se le impone.</p>

	<p class="contenido-general">En cuanto a la reincidencia, esta autoridad no considera reincidente al contribuyente sancionado, ya que de los registros con que se cuenta en esta Dirección, no existen datos que lleven a concluir que la empresa haya incurrido en la infracción alguna del artículo 68 del Código Fiscal Municipal del Estado de Quintana Roo.</p>

	<p class="contenido-general">En cuanto a la conveniencia de destruir prácticas establecidas, con el fin de evitar la evasión fiscal y la infracción a las disposiciones fiscales, con la imposición de la presente multa esta autoridad fiscalizadora tiene como finalidad destruir prácticas irregulares, así como la evasión fiscal e infracción a las disposiciones legales, siendo conveniente inhibir este tipo de prácticas, como las cometidas por la infractora, ya que ello permitirá una mayor recaudación del Municipio redundando este incremento en la recaudación, en un aumento en la prestación de los servicios públicos en beneficio de la población de Benito Juárez, Quintana Roo. </p>

	<p class="contenido-general">Por lo expuesto, fundado y motivado es de resolverse y al efecto se;</p>

	<h1>RESUELVE</h1>

	<p class="contenido-general"><b>PRIMERO.-</b> Se le impone a la sociedad  mercantil denominada @if(is_object($multa->inspeccion)) {{ $multa->inspeccion->comercio->denominacion }} @else __________________________________________ @endif, una multa por un monto de {{ $multa->montoMulta }} unidades medida de actualización vigente en la fecha en que se cometió la infracción, que representan la cantidad de {{ $multa->total }}, por los motivos y fundamentos precisados en el apartado de Considerandos de la presente resolución.</p>

	<p class="contenido-general"><b>SEGUNDO.-</b> Considerando que existe constancia en autos del expediente en que se actúa, del pago que ha efectuado el contribuyente, mediante recibo número 429980 y número de folio f-2017-00395801 de fecha 12 de octubre de 2017, evítese enviar a la Dirección de Ingresos Coordinados la presente resolución.</p>

	<p class="contenido-general"><b>TERCERO.-</b> Se hace de su conocimiento que la multa impuesta, puede ser combatida mediante el recurso de revocación en términos del artículo 95 del Código Fiscal Municipal del Estado de Quintana</p>

	<p class="contenido-general"><b>QUINTO.- Notifíquese la presente la resolución a @if(is_object($multa->inspeccion)) {{ $multa->inspeccion->comercio->denominacion }}, @else __________________________________________ @endif en el domicilio ubicado en @if(is_object($multa->inspeccion)) {{ $multa->inspeccion->comercio->domiciliofiscal }}, @else __________________________________________ @endif, de esta Ciudad de Cancún, Quintana Roo.</b></p>

	<p class="contenido-general">Así lo acordó y firma el Ingeniero <b>{{ $inspeccion->formavalorada->encargado->nombre }} {{ $inspeccion->formavalorada->encargado->apellidopaterno }} {{ $inspeccion->formavalorada->encargado->apellidomaterno }},</b> {{ $inspeccion->formavalorada->encargado->puesto }}, con fundamento en los artículos 1, 2, 3, 24, primer y último párrafo, 126, 127 y 128, fracción VI, de la Constitución Política del Estado Libre y Soberano de Quintana Roo; 1,2, 3, 116, fracción II, 122, 125, fracciones I, III, VII y XIX, de la Ley de los Municipios del Estado de Quintana Roo; 1, 2, 3, 5, fracciones XI y XXVIII, 6 fracción IV, V, VI y VII, 7, 8, 17, 60, Apartado B, fracciones I, II, III, IV, VI, XVI y LXIII, 479, 480, 481fracciones I al III, 482, 484, 485, 486, 491, 492, 498, 499 en todas sus fracciones, 502, 503 y 504 del Bando de Gobierno y Policía del Municipio de Benito Juárez, Quintana Roo; 1, 2, 3, 4, 6, 8, 34, 35, 38, 39, 52, 53, 54, 95, 98, 99, 116, 118, 119, 120, 135, 136, 137, 139, fracción XII, 141, fracciones V, VI, VII, 142, fracciones V, VI, VII, y 155, fracción I, incisos a) y b), de la Ley de Hacienda del Municipio de Benito Juárez del Estado de Quintana Roo; 1, 4 fracciones I al V, 5, fracciones II, V y VII, 33, fracciones I, II, III, IV, VII, X, XI y XII, 42, fracciones II y IV, y 51, fracción I, del Código Fiscal Municipal del Estado de Quintana Roo; 4, 5, 7, 14, 22, fracción II, 35, fracciones II, III, XXV, XXVII, XXVIII, XXX, XXXI y XLVI, y 36, fracción V, del  Reglamento Orgánico de la Administración Pública Centralizada del Municipio de Benito Juárez, Quintana Roo; 1, 7, 10, fracción I, inciso e), 12, 13, fracciones I, IV y X y 22, fracciones II, III, IV, V, VIII, IX, XII, XIII, XV y XVIII, del Reglamento Interior de la Tesorería Municipal de Benito Juárez, todos ordenamientos jurídicos vigentes.</p>
	
	<div class="page_break"></div>

	

	<img src="{{ asset('img/header-logo-simple.jpg') }}" width="100%">

	<h1 class="mb-0">CÉDULA NOTIFICACIÓN</h1>
	<p class="cn-subtitulo text-center mt-0"><b>(Con el directo interesado)</b></p>

	<p class="cn-header-datos"><b>PROPIETARIO, REPRESENTANTE <br> O APODERADO LEGAL <br> DE @if(is_object($multa->inspeccion)) {{ $multa->inspeccion->comercio->denominacion }}, @else __________________________________________ @endif</b></p>

	<p class="cn-contenido-general mb-0">En ________________________________________________ siendo las _____ horas con _____ minutos del dia ______ del mes de ______________ del año _________, el C. _______________________________________________ notificador adscrito a la Dirección de Fiscalización de la Tesorería Municipal del Municipio de Benito Juárez, Quintana Roo identificándome con credencial No. ________________, con vigencia del _________________________________ al _____________________________ me constituí en el inmueble ubicado en {{ $multa->inspeccion->comercio->domiciliofiscal }} en esta ciudad de Cancún, Quintana Roo, cerciorándome por medio de _____________________________________________________________________________________</p>
	<p class="cn-contenido-general mbt-0">_____________________________________________________________________________________________________________</p>
	<p class="cn-contenido-general mbt-0">_____________________________________________________________________________________________________________</p>

	<p class="cn-contenido-general">que es el domicilio de la persona al rubro citada, requerí la presencia del propietario, su representante o apoderado legal, entendí la presente diligencia de notificación con quien dijo llamarse ________________________________________________________, identificandose con _____________________________________________________ en su caracter de __________________________________________________ personalidad que acredita con ______________________________________________________ a quien en este acto y con fundamento en el artículo 111 del Código Fiscal Municipal del Estado de Quintana Roo, le notifico formalmente para todos los efectos legales a que haya lugar, original con firma autógrafa del Acuerdo que consta de _________ fojas útiles, de fecha _______________________, con número de oficio __________________________ emitido por el Ingeniero {{ $inspeccion->formavalorada->encargado->nombre }} {{ $inspeccion->formavalorada->encargado->apellidopaterno }} {{ $inspeccion->formavalorada->encargado->apellidomaterno }}, en su carácter de {{ $inspeccion->formavalorada->encargado->puesto }}, así mismo le entrego copia de la presente cédula, con lo cual se da por concluida esta diligencia siendo las _______ horas con _________ minutos del día de su inicio, firmando el interesado al calce de recibido para constancia de todo lo anterior. Esta notificación surtirá efectos al día hábil siguiente a aquél en el que fue practicada y los términos empezarán a correr el día hábil siguiente del en que haya surtido efectos la notificación, de conformidad con lo establecido en el artículo 109, del Código Fiscal Municipal del Estado de Quintana Roo.</p>
	
	<table class="firma-final mt-10">
	  <tr>
		<td>
			<b>EL C. NOTIFICADOR</b>
			<p>_________________________________</p>
		</td>
		<td>
			<b>EL INTERESADO</b>
			<p>_________________________________</p>
		</td>
	  </tr>
	</table>

	<div class="page_break"></div>
	
	<img src="{{ asset('img/header-logo-simple.jpg') }}" width="100%">

	<h1 class="mb-0">CITATORIO</h1>
	

	<p class="cn-header-datos"><b>PROPIETARIO, REPRESENTANTE <br> O APODERADO LEGAL <br> DE @if(is_object($multa->inspeccion)) {{ $multa->inspeccion->comercio->denominacion }}, @else __________________________________________ @endif</b></p>
	
	<p class="cn-contenido-general mb-0">En ____________________________________________ siendo las ____ horas con ____ minutos del día _____ del mes de ______________________ del año ________, el C. __________________________________________________________ notificador-ejecutor adscrito a la Dirección de Fiscalización de la Tesorería Municipal del Municipio de Benito Juárez, Quintana Roo identificándome con credencial No. _____________, con vigencia del _________________________ al _______________________, me constituí en el inmueble ubicado en @if(is_object($multa->inspeccion)) {{ $multa->inspeccion->comercio->domiciliofiscal }} @else _______________________________________________ @endif en esta ciudad de Cancún, Quintana Roo, cerciorándome por medio de _________________________________________________________________________</p>
	<p class="cn-contenido-general mbt-0">_____________________________________________________________________________________________________________</p>
	<p class="cn-contenido-general mbt-0">_____________________________________________________________________________________________________________</p>
	<p class="cn-contenido-general">que es el domicilio de la persona al rubro citada, requerí la presencia del propietario, su representante o apoderado legal, presentándose el C.__________________________________________________, en su carácter de _________________________________________, quien se identifica con _________________________________________________________________ manifestando que la persona buscada no se encuentra, por lo que procedo a dejar en su poder el presente citatorio para que la persona al rubro citada espere al notificador a las __________ horas con __________ minutos, del día ______ del mes de ________________________ del año _________, apercibido de que en caso de no hacerlo, la diligencia de notificación se entenderá con cualquier persona que se encuentre en el domicilio o los vecinos, y de negarse éstos a recibirla o en caso de encontrarse cerrado el mismo, se realizará por instructivo que se fijará en lugar visible de dicho domicilio, con fundamento en el artículo 111 segundo párrafo del Código Fiscal Municipal del Estado de Quintana Roo.</p>
	
	<table class="firma-final mt-10">
		<tr>
			<td>
				<b>EL C. NOTIFICADOR</b>
				<p>_________________________________</p>
			</td>
			<td>
				<b>EL INTERESADO</b>
				<p>_________________________________</p>
			</td>
		</tr>
	</table>

	<div class="page_break"></div>

	<img src="{{ asset('img/header-logo-simple.jpg') }}" width="100%">

	<!-- http://localhost/fiscalizacion/public/pdf/descargar-multas/24 -->

	<h1 class="mb-0">NOTIFICACIÓN PREVIO CITATORIO</h1>
	<p class="cn-subtitulo text-center mt-0"><b>(Con quien esté)</b></p>

	<p class="cn-header-datos"><b>PROPIETARIO, REPRESENTANTE <br> O APODERADO LEGAL <br> DE @if(is_object($multa->inspeccion)) {{ $multa->inspeccion->comercio->denominacion }}, @else __________________________________________ @endif</b></p>
	
	<p class="cn-contenido-general mb-0">En ____________________________________________ siendo las ______ horas con ________ minutos del dia _____ del mes de __________________ del año _______, el C. ____________________________________________________________ notificador-ejecutor adscrito a la Dirección de Fiscalización de la Tesorería Municipal del Municipio de Benito Juárez, Quintana Roo identificándome con credencial No. ________________, con vigencia del _____________________________ al _____________________________, me constituí en el inmueble ubicado en @if(is_object($multa->inspeccion)) {{ $multa->inspeccion->comercio->domiciliofiscal }} @else _______________________________________________, @endif en esta ciudad de Cancún, Quintana Roo, cerciorándome por medio de __________________________________________</p> 
	<p class="cn-contenido-general mbt-0">_____________________________________________________________________________________________________________</p>
	<p class="cn-contenido-general mbt-0">_____________________________________________________________________________________________________________</p>

	<p class="cn-contenido-general">que es el domicilio de la persona al rubro citada, y considerando que el día ______ del mes de ____________________ del año _____ se dejó citatorio en poder del C. ________________________________________________________ en su carácter de _________________________________________________, y toda vez que ni la persona citada ni el propietario, representante o apoderado legal, atendieron el citatorio, hago efectivo el apercibimiento contenido en el citatorio aludido, y practico la diligencia con _____________________________________________________ persona que encontré en el domicilio en el que actúo, quien se identifica con ______________________________________. Con fundamento en el artículo 111 segundo párrafo del Código Fiscal Municipal del Estado de Quintana Roo, procedo a notificar para todos los efectos legales a que haya lugar, original con firma autógrafa de la resolución de fecha ____________________________ con número de oficio {{ $inspeccion->folio }} constante de ________ fojas dictada por el Ingeniero {{ $inspeccion->formavalorada->encargado->nombre }} {{ $inspeccion->formavalorada->encargado->apellidopaterno }} {{ $inspeccion->formavalorada->encargado->apellidomaterno }}, en su  carácter  de {{ $inspeccion->formavalorada->encargado->puesto }}, asimismo hago entrega de copia de la presente cédula. Esta notificación surtirá efectos el mismo día en el que fue practicada y los términos empezarán a correr el día hábil siguiente del en que haya surtido efectos la notificación, de conformidad con lo establecido en el artículo 109, del Código Fiscal Municipal del Estado de Quintana Roo.</p>
	
	<table class="firma-final mt-10">
		<tr>
			<td>
				<b>EL C. NOTIFICADOR</b>
				<p>_________________________________</p>
			</td>
			<td>
				<b>EL INTERESADO</b>
				<p>_________________________________</p>
			</td>
		</tr>
	</table>

	<div class="page_break"></div>

	<img src="{{ asset('img/header-logo-simple.jpg') }}" width="100%">

	<h1 class="mb-0">NOTIFICACIÓN PREVIO CITATORIO</h1>
	<p class="cn-subtitulo text-center mt-0"><b>(Por instructivo, previo citatorio, con quien esté y se niega a recibir)</b></p>

	<p class="cn-header-datos"><b>PROPIETARIO, REPRESENTANTE <br> O APODERADO LEGAL <br> DE @if(is_object($multa->inspeccion)) {{ $multa->inspeccion->comercio->denominacion }}, @else __________________________________________ @endif</b></p>
	
	<p class="cn-contenido-general mb-0">En _____________________________________________ siendo las ____ horas con ______ minutos del dia ______ del mes de ____________________ del año ________, el C. _______________________________________________________ notificador-ejecutor adscrito a la Dirección de Fiscalización de la Tesorería Municipal del Municipio de Benito Juárez, Quintana Roo identificándome con credencial No. ________________ con vigencia del _____________________________ al ____________________________, me constituí en el inmueble ubicado en @if(is_object($multa->inspeccion)) {{ $multa->inspeccion->comercio->domiciliofiscal }} @else _______________________________________________, @endif en esta ciudad de Cancún, Quintana Roo, cerciorándome por medio de __________________________________________</p> 
	<p class="cn-contenido-general mbt-0">_____________________________________________________________________________________________________________</p>
	<p class="cn-contenido-general mbt-0">_____________________________________________________________________________________________________________</p>

	<p class="cn-contenido-general">que es el domicilio de la persona al rubro citada, y considerando que el día ______ del mes de ________________ del año _______ se dejó citatorio en poder del C. __________________________________________________ en su carácter  de ________________________________________, y toda vez que ni la persona citada ni el propietario, representante o apoderado legal, atendieron el citatorio, hago efectivo el apercibimiento contenido en el citatorio aludido, y practico la diligencia con ______________________________________ en su carácter de (______________________________________________________) vecino (________) persona que encontré en el domicilio en el que actúo, quien se niega a recibir la presente notificación; por lo que con fundamento en el artículo 111 segundo párrafo del Código Fiscal Municipal del Estado de Quintana Roo, procedo a notificar al interesado o a su representante legal, por medio de instructivo, el original con firma autógrafa de la resolución de fecha _________________________, con número de oficio {{ $inspeccion->folio }} constante de ________ fojas dictada por el Ingeniero {{ $inspeccion->formavalorada->encargado->nombre }} {{ $inspeccion->formavalorada->encargado->apellidopaterno }} {{ $inspeccion->formavalorada->encargado->apellidomaterno }}, en su  carácter  de {{ $inspeccion->formavalorada->encargado->puesto }}, fijándolo en la puerta del domicilio del interesado, así como copia de la presente cédula y asentando razón de tal circunstancia. Esta notificación surtirá efectos el mismo día en el que fue practicada y los términos empezarán a correr el día hábil siguiente del en que haya surtido efectos la notificación, de conformidad con lo establecido en el artículo 109, del Código Fiscal Municipal del Estado de Quintana Roo.</p>

	<table class="firma-final mt-10">
		<tr>
			<td>
				<b>EL C. NOTIFICADOR</b>
				<p>_________________________________</p>
			</td>
		</tr>
	</table>

	<div class="page_break"></div>

	<img src="{{ asset('img/header-logo-simple.jpg') }}" width="100%">

	<h1 class="mb-0">NOTIFICACIÓN PREVIO CITATORIO</h1>
	<p class="cn-subtitulo text-center mt-0"><b>(Por instructivo, domicilio cerrado)</b></p>

	<p class="cn-header-datos"><b>PROPIETARIO, REPRESENTANTE <br> O APODERADO LEGAL <br> DE @if(is_object($multa->inspeccion)) {{ $multa->inspeccion->comercio->denominacion }}, @else __________________________________________ @endif</b></p>

	<p class="cn-contenido-general mb-0">En ___________________________________ siendo las ____ horas con ______minutos del día ______ del mes de ____________________ del año ______, el C. ______________________________________________________________________ notificador-ejecutor adscrito a la Dirección de Fiscalización de la Tesorería Municipal del Municipio de Benito Juárez, Quintana Roo identificándome con credencial No. ___________________ con vigencia del ________________________________ al ________________________________, me constituí en el inmueble ubicado en @if(is_object($multa->inspeccion)) {{ $multa->inspeccion->comercio->domiciliofiscal }} @else _______________________________________________, @endif en esta ciudad de Cancún, Quintana Roo, cerciorándome por medio de ______________</p> 
	<p class="cn-contenido-general mbt-0">_____________________________________________________________________________________________________________</p>
	<p class="cn-contenido-general mbt-0">_____________________________________________________________________________________________________________</p>

	<p class="cn-contenido-general">que es el domicilio de la persona al rubro citada, y considerando que el día _____ del mes de _______________ del año ____ se dejó citatorio en poder del C. ______________________________________________ en su carácter  de _____________________________________, y toda vez que el domicilio se encuentra cerrado y que en forma reiterada e insistente toqué la puerta del mismo sin que haya sido atendido el llamado, hago efectivo el apercibimiento contenido en el citatorio aludido; por lo que con fundamento en el artículo 111 segundo párrafo del Código Fiscal Municipal del Estado de Quintana Roo, procedo a notificar por instructivo al interesado o a su representante legal, por medio de instructivo, el original con firma autógrafa de la resolución de fecha _______________________ con número de oficio {{ $inspeccion->folio }}, constante de ________ fojas, dictada por el Ingeniero {{ $inspeccion->formavalorada->encargado->nombre }} {{ $inspeccion->formavalorada->encargado->apellidopaterno }} {{ $inspeccion->formavalorada->encargado->apellidomaterno }}, en su  carácter  de {{ $inspeccion->formavalorada->encargado->puesto }}, fijándolo en la puerta del domicilio del interesado, así como copia de la presente cédula y asentando razón de tal circunstancia. Esta notificación surtirá efectos el mismo día en el que fue practicada y los términos empezarán a correr el día hábil siguiente del en que haya surtido efectos la notificación, de conformidad con lo establecido en el artículo 109, del Código Fiscal Municipal del Estado de Quintana Roo.</p>

	<table class="firma-final mt-10">
		<tr>
			<td>
				<b>EL C. NOTIFICADOR</b>
				<p>_________________________________</p>
			</td>
		</tr>
	</table>

	@endforeach
</body>
</html>