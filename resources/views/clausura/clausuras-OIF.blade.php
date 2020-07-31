<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>CLAUSURA 2019-2021</title>
		<link rel="stylesheet" href="{{ asset('css/acta-clausura-oivp.css') }}" />
	</head>
	<body>
		@foreach($formavalorada->inspeccion as $inspeccion)
		<img src="{{ asset('img/header-orden-clausura.jpg') }}" width="100%">
		<div>
			<h5 style="float: right;margin-bottom:0;margin-top:0;font-size:1.2em;">FOLIO: {{ $inspeccion->folio }}</h5><br><br>
			@if($inspeccion->comercio == null)
				<p style="margin-bottom:0;margin-top:0;font-size:1em;"><b>NOMBRE DEL CONTRIBUYENTE: </b>____________________________________________________________________</p>
				<p style="margin-bottom:0;margin-top:0;font-size:1em;"><b>NOMBRE COMERCIAL DEL ESTABLECIMIENTO: </b>_______________________________________________________</p>
				<p style="margin-bottom:0;margin-top:0;font-size:1em;"><b>DOMICILIO DEL ESTABLECIMIENTO: </b>_________________________________________________________________</p>
				<!-- <p class="oi-header-datos mbt-0"><b>GIRO: </b>_______________________________________________________________________________________________________________________</p> -->
				<p style="margin-bottom:0;margin-top:0;font-size:1em;"><b>NÚMERO DE PADRÓN MUNICIPAL: </b>___________________________________________________________________</p>
			@else
				<p style="margin-bottom:1%;margin-top:0;"><b>NOMBRE DEL CONTRIBUYENTE: </b>{{ $inspeccion->comercio->propietarionombre }}</p>
				<p style="margin-bottom:1%;margin-top:0;"><b>NOMBRE COMERCIAL DEL ESTABLECIMIENTO: </b>{{ $inspeccion->comercio->nombreestablecimiento }}</p>
				<p style="margin-bottom:1%;margin-top:0;"><b>DOMICILIO DEL ESTABLECIMIENTO: </b>{{ $inspeccion->comercio->domiciliofiscal }}</p>
				<!-- <p class="oi-header-datos mbt-0"><b>GIRO: </b></p> -->
				<p style="margin-bottom:1%;margin-top:0;"><b>NÚMERO DE PADRÓN MUNICIPAL: </b></p>
			@endif
			<br>
			<p style="text-align:justify; font-size:.90em;">Derivado de los hechos consignados en el Acta de Inspección: {{ $inspeccion->folio }} realizada el @if($inspeccion->fecharealizada == null) día _____ de _________ del año ______ @else {{ strftime("%d de %B del %G", strtotime($inspeccion->fecharealizada)) }} @endif con motivo de la Orden de Inspección: {{ $inspeccion->folio }} emitida por el suscrito con fecha de @if($inspeccion->created_at == null) día _____ de _________ del año ______ @else {{ strftime("%d de %B del %G", strtotime($inspeccion->created_at)) }} @endif  de la que se derivó que el establecimiento comercial del contribuyente señalado ubicado dentro de la circunscripción territorial del Municipio de Benito Juárez, Quintana Roo. <b>NO CUENTA CON: @foreach($formavalorada->tipoInspeccion->documentacionPorTipoDeInspeccion as $documento) {{ $documento->documentacionRequerida->nombre }}; @endforeach</b> lo cual es violatorio de lo previsto por los artículos 479, 480, 482, 491 y 492 del Bando de Gobierno y Policía del Municipio de Benito Juárez, así como en los diversos numerales 1, 2, 3, 4, 6, 8, 34, 35, 38, 39, 52, 53, 54, 95, 98, 99, 116, 118, 119, 120, 135, 136, 137, 139, fracción XII, 141, fracciones V, VI, VII, 142, fracciones V, VI, VII, y 155, fracción I, incisos a) y b), de la Ley de Hacienda del Municipio de Benito Juárez del Estado de Quintana Roo, lo cual constituye una falta grave y en contravención a lo previsto por las disposiciones Municipales vigentes; razón por la cual con fundamento en los artículos 16 y 115, fracción V, de la Constitución Política de los Estados Unidos Mexicanos; 1, 2, 3, 24, 126, 127 y 128, fracción VI, de la Constitución Política del Estado Libre y Soberano de Quintana Roo; 1,2, 3, 116, fracción II, 122, 125, fracciones I, III, VII y XIX, de la Ley de los Municipios del Estado de Quintana Roo; 1, 2, 3, 4, 5, fracciones XI y XXVIII, 6 fracción IV, V, VI y VII, 7, 8, 17, 60, Apartado B, fracciones I, II, III, IV, VI, XVI y LXIII, 479, 480, 482, 484, 485, 486, 491, 492, 498, 499, 502, 503 y 504 del Bando de Gobierno y Policía del Municipio de Benito Juárez, Quintana Roo; 1, 2, 3, 4, 6, 8, 34, 35, 38, 39, 52, 53, 54, 95, 98, 99, 116, 118, 119, 120, 135, 136, 137, 139, fracción XII, 141, fracciones V, VI, VII, 142, fracciones V, VI, VII, y 155, fracción I, incisos a) y b), de la Ley de Hacienda del Municipio de Benito Juárez del Estado de Quintana Roo; 1, 4, 5, fracciones II, V y VII, 11, 18, 19, 20, 30, 33, fracciones I, II, III, IV y XII, 40, 42, fracciones II y IV, 43, 45, 47, 48, 51 y 52 del Código Fiscal Municipal del Estado de Quintana Roo; 37  de la Ley para la Prevención y la Gestión integral de Residuos del Estado de Quintana Roo; 7, 22, 35, fracciones II, III, XXV, XXVI, XXVII, XXVIII, XXXI y XLVI y 36, fracción V, del  Reglamento Orgánico de la Administración Pública Centralizada del Municipio de Benito Juárez, Quintana Roo; 2, fracciones I y VI, 7, 9, 10, fracción I, inciso e), 12, 13, fracciones I y IV, y 22, fracciones II, III, IV, V, VIII, IX, XII, XIII, XV y XVIII, del Reglamento Interior de la Tesorería Municipal de Benito Juárez, todos ordenamientos jurídicos vigentes; se aplica la sanción consistente en la <b>CLAUSURA</b> de la citada negociación, por lo que se designa, autoriza y comisiona al C. {{ $inspeccion->inspector->nombre }} {{ $inspeccion->inspector->apellidopaterno }} {{ $inspeccion->inspector->apellidomaterno }}, Inspector, Verificador y Notificador – Ejecutor adscrito a la Dirección de Fiscalización de la Tesorería Municipal del H. Ayuntamiento Benito Juárez, Quintana Roo, quienes podrán actuar de manera conjunta o individualmente y deberán identificarse con la credencial con fotografía vigente, expedida por el Lic. Marcelo José Guzmán, en su carácter de Tesorero Municipal del Municipio de Benito Juárez Quintana Roo, con fundamento en el artículo 11, fracción XI, del Reglamento Interior de la Tesorería Municipal de Benito Juárez; para que se presente en el domicilio del establecimiento comercial señalado y de cumplimiento a la presente orden, requiriéndose al contribuyente para que permita el acceso a su establecimiento apercibido que en caso de no hacerlo será requerido el apoyo de la fuerza pública; así como que se incurrirá en el DELITO DE QUEBRANTAMIENTO DE SELLOS previsto por el artículo 218 del Código Penal para el Estado Libre y Soberano de Quintana Roo, los que en el acto de la diligencia serán colocados por la persona designada para los efectos señalados, los cuales sólo podrán ser levantados por quien designe esta autoridad; para el caso de prolongarse la realización de la diligencia aquí ordenada de conformidad con lo establecido en el artículo 18 de Código Fiscal Municipal del Estado de Quintana Roo vigente, se habilita el horario comprendido de las 18:01 a las 24:00 horas del @if($inspeccion->comercio == null) día _____ de __________ del año _______, @else {{ $fecha_hoy }} @endif así como de las 00:00 a las 07:29 horas del @if($inspeccion->comercio == null OR $inspeccion->fechaprorroga == null) día _____ de _________ del año ______ @else {{ strftime("%d de %B del %G", strtotime($inspeccion->fechavence)) }} @endif en el cual podrá iniciarse o continuarse hasta su conclusión.</p>
			<p style="font-size: .90em;"><b>Cancún, Municipio de Benito Juárez, Quintana Roo, @if($inspeccion->comercio == null) a _____ de _________ de ______. @else {{ $fecha_hoy }}.  @endif  </b></p>
			<p style="font-size: .90em;"><b>A T E N T A M E N T E</b></p>
			<table class="firma-orden-inspeccion">
				<tr>
					<td style="width: 40%;">
						@if(is_object($inspeccion->formavalorada))
						<p style="text-transform: uppercase;margin-bottom:0;margin-top:0;font-size:.90em;"><b>{{ $inspeccion->formavalorada->encargado->nombre }} {{ $inspeccion->formavalorada->encargado->apellidopaterno }} {{ $inspeccion->formavalorada->encargado->apellidomaterno }}</b></p>
						<p style="text-transform: uppercase;margin-bottom:0;margin-top:0;font-size:.90em;"><b>{{ $inspeccion->formavalorada->encargado->puesto }}</b></p>
						@endif
					</td>
					<td style="width: 60%;">
						<div style="padding: 5px;border-style: solid;border-width: 1px;">
							<p style="text-transform: uppercase;margin-top:0;margin-bottom:0;font-size:.90em;"><b>Firma: </b>_________________________________________________</p>
							<p style="text-transform: uppercase;margin-top:0;margin-bottom:0;font-size:.90em;"><b>Nombre: </b>_______________________________________________</p>
							<p style="text-transform: uppercase;margin-top:0;margin-bottom:0;font-size:.90em;"><b>Fecha:</b>_________________________________________________</p>
							<br>
							<p style="margin-top:0;font-size:.90em;">Constancia de recepción de la presente Orden de Inspección. Los datos de identificación de la persona que recibe deberán quedar asentados en el Acta de Inspección que se realizará.</p>
						</div>
					</td>
				</tr>
			</table>
		</div>
		<div class="page_break"></div>
		<img src="{{ asset('img/header-acta-clausura.jpg') }}" width="100%">
		<div>
			<h5 style="float:right;margin-bottom:0;margin-top:0;font-size:1.2em;">FOLIO: {{ $inspeccion->folio }}</h5><br><br>
			@if($inspeccion->comercio == null)
			<p style="margin-bottom:0;margin-top:0;"><b>NOMBRE DEL CONTRIBUYENTE: </b>____________________________________________________________________</p>
			<p style="margin-bottom:0;margin-top:0;"><b>NOMBRE COMERCIAL DEL ESTABLECIMIENTO: </b>_______________________________________________________</p>
			<p style="margin-bottom:0;margin-top:0;"><b>DOMICILIO DEL ESTABLECIMIENTO: </b>_________________________________________________________________</p>
			<p style="margin-bottom:0;margin-top:0;"><b>NÚMERO DE PADRÓN MUNICIPAL: </b>__________________________________________________________________</p>
			@else
			<p style="margin-bottom:0;margin-top:0;"><b>NOMBRE DEL CONTRIBUYENTE: </b>{{ $inspeccion->comercio->propietarionombre }}</p>
			<p style="margin-bottom:0;margin-top:0;"><b>NOMBRE COMERCIAL DEL ESTABLECIMIENTO: </b>{{ $inspeccion->comercio->nombreestablecimiento }}</p>
			<p style="margin-bottom:0;margin-top:0;"><b>DOMICILIO DEL ESTABLECIMIENTO: </b>{{ $inspeccion->comercio->domiciliofiscal }}</p>
			<p style="margin-bottom:0;margin-top:0;"><b>NÚMERO DE PADRÓN MUNICIPAL: </b></p>
			@endif
			<p style="text-align: justify;font-size:.90em;">En la ciudad de Cancún, Municipio de Benito Juárez, Quintana Roo, Quintana Roo, siendo las _____ horas del @if($inspeccion->comercio == null) día _____ de __________ del año _______, @else {{ $fecha_hoy }}, @endif el suscrito @if($inspeccion->inspector == null) C._________________________________________, @else <b>C. {{ $inspeccion->inspector->nombre }} {{ $inspeccion->inspector->apellidopaterno }} {{ $inspeccion->inspector->apellidomaterno }},</b> @endif en mi carácter de Inspector, Verificador y Notificador–Ejecutor adscrito a la Dirección de Fiscalización de la Tesorería Municipal del H. Ayuntamiento Benito Juárez, Quintana Roo, con fundamento en los artículo 16 y 115, fracción V, de la Constitución Política de los Estados Unidos Mexicanos; 1, 2, 3, 24, 126, 127 y 128, fracción VI, de la Constitución Política del Estado Libre y Soberano de Quintana Roo; 1,2, 3, 116, fracción II, 122, 125, fracciones I, III, VII y XIX, de la Ley de los Municipios del Estado de Quintana Roo; 1, 2, 3, 4, 5, fracciones XI y XXVIII, 6 fracción IV, V, VI y VII, 7, 8, 17, 60, Apartado B, fracciones I, II, III, IV, VI, XVI y LXIII, 479, 480, 482, 484, 485, 486, 491, 492, 498, 499, 502, 503 y 504 del Bando de Gobierno y Policía del Municipio de Benito Juárez, Quintana Roo; 1, 2, 3, 4, 6, 8, 34, 35, 38, 39, 52, 53, 54, 95, 98, 99, 116, 118, 119, 120, 135, 136, 137, 139, fracción XII, 141, fracciones V, VI, VII, 142, fracciones V, VI, VII, y 155, fracción I, incisos a) y b), de la Ley de Hacienda del Municipio de Benito Juárez del Estado de Quintana Roo; 1, 4, 5, fracciones II, V y VII, 11, 18, 19, 20, 30, 33, fracciones I, II, III, IV y XII, 40, 42, fracciones II y IV, 43, 45, 47, 48, 51 y 52 del Código Fiscal Municipal del Estado de Quintana Roo; 37  de la Ley para la Prevención y la Gestión integral de Residuos del Estado de Quintana Roo; 7, 22, 35, fracciones II, III, XXV, XXVI, XXVII, XXVIII, XXXI y XLVI y 36, fracción V, del  Reglamento Orgánico de la Administración Pública Centralizada del Municipio de Benito Juárez, Quintana Roo; 2, fracciones I y VI, 7, 9, 10, fracción I, inciso e), 12, 13, fracciones I y IV, y 22, fracciones II, III, IV, V, VIII, IX, XII, XIII, XV y XVIII, del Reglamento Interior de la Tesorería Municipal de Benito Juárez, todos ordenamientos jurídicos vigentes; y en cumplimiento a la ORDEN DE CLAUSURA con número {{ $inspeccion->folio }} de fecha <b>{{ $inspeccion->fecharealizada }}</b> expedida por el Director de Fiscalización de la Tesorería Municipal de Benito Juárez, Quintana Roo, me constituí en el domicilio del establecimiento comercial del contribuyente ubicado en: _________________________________________________________________________________________________________ lugar donde se encuentra una negociación con giro de lugar donde se encuentra una negociación con giro de ______________________________________ entendiendo la presente diligencia con una persona de nombre C. ____________________________________________________________, quien señala ser _______________________________________, lo que acredita con ________________________________________________________, numero _______________________________________________________________, expedida por __________________________________________________________________; persona ante quien me identifico y acredito el carácter con el que me ostento mediante credencial con fotografía y sello oficial número ___________________________________ con fecha de expedición _________________________________ y fecha de vencimiento ____________________________________ expedida por el Lic. Marcelo José Guzmán, en su carácter de Tesorero Municipal del Municipio de Benito Juárez Quintana Roo, con fundamento en el artículo 11, fracción XI, del Reglamento Interior de la Tesorería Municipal de Benito Juárez; la cual tuvo a la vista y devuelve al identificado, notificando  y entregándosele un tanto en original de la orden señalada, por lo que, acto seguido se procede a su ejecución y cumplimiento, clausurándose formalmente dicho establecimiento, no sin antes habiéndose permitido la salida de todas las personas que se encontraban en el interior del mismo, así como que se apagaran y desconectaran los aparatos que así lo decidió la persona con la que se entiende la presente diligencia, de igual manera en caso de contar con alimentos perecederos esta autoridad permite que sean retirados por quien atiende la diligencia, cerrándose todos sus accesos y colocándose ____________________________ sellos de clausura, los cuales sólo podrán ser retirados por quien designe esta autoridad, ahora bien, si los altera, rompe o destruye, se incurrirá en el <b>DELITO DE QUEBRANTAMIENTO DE SELLOS</b> previsto por el artículo 218 del Código Penal para el Estado Libre y Soberano de Quintana Roo; por lo que no habiendo nada más que agregar se da por terminada la presente diligencia a las ________ horas del @if($inspeccion->comercio == null) día _____ de ____________ del año _______, @else {{ $fecha_hoy }}, @endif haciendo constar que se entregó un tanto en original de la Orden de Clausura señalada y de la presente actuación a la persona con quien se entendió la diligencia, firmándola para su constancia las personas que en ella intervinieron y quisieron hacerlo para los efectos legales que correspondan.</p>
			<table style="font-size:.85em;text-transform: uppercase;width: 100%;">
				<tr>
					<td class="ai-firma-inspector">
						<div>
							<p class="text-center mbt-0" style="text-align:center;">_________________________________________________</p>
							<p class="text-center" style="text-align:center;"><b>Inspector, verificador y notificador - ejecutor <br>nombre y firma</b></p>
							<p class="mbt-0"><b>Credencial número __________ expedida por la tesorería municipal del h. ayuntamiento de benito juárez, quintana roo, con fotografía y sello oficial.</b></p>
							<p class="mbt-0"><b>Fecha de emisión:</b>_________________________________</p>
							<p class="mbt-0"><b>Vigencia del:</b>______________________________________</p>
						</div>
					</td>
					<td class="ai-firma-encargado">
						<div >
							<p class="text-center mbt-0" style="text-align:center;">_______________________________________________</p>
							<p class="text-center mbt-0" style="text-align:center;"><b>Persona con quien se entendío la diligencia <br>nombre y firma</b></p>
						</div>
					</td>
				</tr>
			</table>
		</div>
		<div class="page_break"></div>
	@endforeach
	</body>
</html>