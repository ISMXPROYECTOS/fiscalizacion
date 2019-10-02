<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>INSPECCION 2019-2021</title>
		
		<link rel="stylesheet" href="{{ asset('css/acta-inspeccion.css') }}" />
		
	</head>
	<body>
		
		
		<img src="{{ asset('img/header-orden-inspeccion.jpg') }}" width="100%">
		<div class="container">
			<h5 class="folio">FOLIO: {{ $inspeccion->folio }}</h5><br><br>
			@if($inspeccion->comercio == null)
				<p class="oi-header-datos mbt-0"><b>NOMBRE DEL CONTRIBUYENTE: </b>________________________________________________________________________________________________</p>
				<p class="oi-header-datos mbt-0"><b>NOMBRE COMERCIAL DEL ESTABLECIMIENTO: </b>___________________________________________________________________________________</p>
				<p class="oi-header-datos mbt-0"><b>DOMICILIO DEL ESTABLECIMIENTO: </b>_____________________________________________________________________________________________</p>
				<p class="oi-header-datos mbt-0"><b>GIRO: </b>_______________________________________________________________________________________________________________________</p>
				<p class="oi-header-datos mbt-0"><b>NÚMERO DE PADRÓN MUNICIPAL: </b>______________________________________________________________________________________________</p>

			@else
				<p class="oi-header-datos mbt-0"><b>NOMBRE DEL CONTRIBUYENTE: </b>{{ $inspeccion->comercio->propietarionombre }}</p>
				<p class="oi-header-datos mbt-0"><b>NOMBRE COMERCIAL DEL ESTABLECIMIENTO: </b>{{ $inspeccion->comercio->nombreestablecimiento }}</p>
				<p class="oi-header-datos mbt-0"><b>DOMICILIO DEL ESTABLECIMIENTO: </b>{{ $inspeccion->comercio->domiciliofiscal }}</p>
				<p class="oi-header-datos mbt-0"><b>GIRO: </b></p>
				<p class="oi-header-datos mbt-0"><b>NÚMERO DE PADRÓN MUNICIPAL: </b></p>

			@endif
			

			<p class="contenido-general">Derivado de los hechos consignados en el Acta de Inspección: {{ $inspeccion->folio }} de {{ $inspeccion->fecharealizada }} realiza da con motivo de la Orden de Inspección: {{ $inspeccion->folio }} emitida por el suscrito con fecha {{ $inspeccion->fecharealizada }},  de la que se derivó que el establecimiento comercial del contribuyente señalado ubicado dentro de la circunscripción territorial del Municipio de Benito Juárez, Quintana Roo. <b>NO CUENTA CON;</b> lo cual es violatorio de lo previsto por los artículos 479, 480, 482, 491 y 492 del Bando de Gobierno y Policía del Municipio de Benito Juárez, así como en los diversos numerales 1, 2, 3, 4, 6, 8, 34, 35, 38, 39, 52, 53, 54, 95, 98, 99, 116, 118, 119, 120, 135, 136, 137, 139, fracción XII, 141, fracciones V, VI, VII, 142, fracciones V, VI, VII, y 155, fracción I, incisos a) y b), de la Ley de Hacienda del Municipio de Benito Juárez del Estado de Quintana Roo, lo cual constituye una falta grave y en contravención a lo previsto por las disposiciones Municipales vigentes; razón por la cual con fundamento en los artículos 16 y 115, fracción V, de la Constitución Política de los Estados Unidos Mexicanos; 1, 2, 3, 24, 126, 127 y 128, fracción VI, de la Constitución Política del Estado Libre y Soberano de Quintana Roo; 1,2, 3, 116, fracción II, 122, 125, fracciones I, III, VII y XIX, de la Ley de los Municipios del Estado de Quintana Roo; 1, 2, 3, 4, 5, fracciones XI y XXVIII, 6 fracción IV, V, VI y VII, 7, 8, 17, 60, Apartado B, fracciones I, II, III, IV, VI, XVI y LXIII, 479, 480, 482, 484, 485, 486, 491, 492, 498, 499, 502, 503 y 504 del Bando de Gobierno y Policía del Municipio de Benito Juárez, Quintana Roo; 1, 2, 3, 4, 6, 8, 34, 35, 38, 39, 52, 53, 54, 95, 98, 99, 116, 118, 119, 120, 135, 136, 137, 139, fracción XII, 141, fracciones V, VI, VII, 142, fracciones V, VI, VII, y 155, fracción I, incisos a) y b), de la Ley de Hacienda del Municipio de Benito Juárez del Estado de Quintana Roo; 1, 4, 5, fracciones II, V y VII, 11, 18, 19, 20, 30, 33, fracciones I, II, III, IV y XII, 40, 42, fracciones II y IV, 43, 45, 47, 48, 51 y 52 del Código Fiscal Municipal del Estado de Quintana Roo; 37  de la Ley para la Prevención y la Gestión integral de Residuos del Estado de Quintana Roo; 7, 22, 35, fracciones II, III, XXV, XXVI, XXVII, XXVIII, XXXI y XLVI y 36, fracción V, del  Reglamento Orgánico de la Administración Pública Centralizada del Municipio de Benito Juárez, Quintana Roo; 2, fracciones I y VI, 7, 9, 10, fracción I, inciso e), 12, 13, fracciones I y IV, y 22, fracciones II, III, IV, V, VIII, IX, XII, XIII, XV y XVIII, del Reglamento Interior de la Tesorería Municipal de Benito Juárez, todos ordenamientos jurídicos vigentes; se aplica la sanción consistente en la CLAUSURA de la citada negociación, por lo que se designa, autoriza y comisiona al C. {{ $inspeccion->inspector->nombre }} {{ $inspeccion->inspector->apellidopaterno }} {{ $inspeccion->inspector->apellidomaterno }}, Inspector, Verificador y Notificador – Ejecutor adscrito a la Dirección de Fiscalización de la Tesorería Municipal del H. Ayuntamiento Benito Juárez, Quintana Roo, quienes podrán actuar de manera conjunta o individualmente y deberán identificarse con la credencial con fotografía vigente, expedida por el Lic. Marcelo José Guzmán, en su carácter de Tesorero Municipal del Municipio de Benito Juárez Quintana Roo, con fundamento en el artículo 11, fracción XI, del Reglamento Interior de la Tesorería Municipal de Benito Juárez; para que se presente en el domicilio del establecimiento comercial señalado y de cumplimiento a la presente orden, requiriéndose al contribuyente para que permita el acceso a su establecimiento apercibido que en caso de no hacerlo será requerido el apoyo de la fuerza pública; así como que se incurrirá en el DELITO DE QUEBRANTAMIENTO DE SELLOS previsto por el artículo 218 del Código Penal para el Estado Libre y Soberano de Quintana Roo, los que en el acto de la diligencia serán colocados por la persona designada para los efectos señalados, los cuales sólo podrán ser levantados por quien designe esta autoridad; para el caso de prolongarse la realización de la diligencia aquí ordenada de conformidad con lo establecido en el artículo 18 de Código Fiscal Municipal del Estado de Quintana Roo vigente, se habilita el horario comprendido de las 18:01 a las 24:00 horas del día 14 de mayo de 2019, así como de las 00:00 a las 07:29 horas del día 24 de mayo de 2019, en el cual podrá iniciarse o continuarse hasta su conclusión.</p>
			<p class="fecha-cierre"><b>Cancún, Municipio de Benito Juárez, Quintana Roo,  a _____ de _________ de ______. </b></p>
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

		<img src="{{ asset('img/header-acta-inspeccion.jpg') }}" width="100%">
		<div class="container">
			<h5 class="folio">FOLIO: {{ $inspeccion->folio }}</h5><br><br>

			@if($inspeccion->comercio == null)
			<p class="ai-header-datos mbt-0"><b>NOMBRE DEL CONTRIBUYENTE: </b>_____________________________________________________________________________________________________________________________________</p>
			<p class="ai-header-datos mbt-0"><b>NOMBRE COMERCIAL DEL ESTABLECIMIENTO: </b>________________________________________________________________________________________________________________________</p>
			<p class="ai-header-datos mbt-0"><b>DOMICILIO DEL ESTABLECIMIENTO: </b>__________________________________________________________________________________________________________________________________</p>
			<p class="ai-header-datos mbt-0"><b>GIRO: </b>_____________________________________________________________________________________________________________________________________________________________</p>
			<p class="ai-header-datos mbt-0"><b>NÚMERO DE PADRÓN MUNICIPAL: </b>____________________________________________________________________________________________________________________________________</p>
			@else 

			<p class="ai-header-datos mbt-0"><b>NOMBRE DEL CONTRIBUYENTE: </b>{{ $inspeccion->comercio->propietarionombre }}</p>
			<p class="ai-header-datos mbt-0"><b>NOMBRE COMERCIAL DEL ESTABLECIMIENTO: </b>{{ $inspeccion->comercio->nombreestablecimiento }}</p>
			<p class="ai-header-datos mbt-0"><b>DOMICILIO DEL ESTABLECIMIENTO: </b>{{ $inspeccion->comercio->domiciliofiscal }}</p>
			<p class="ai-header-datos mbt-0"><b>GIRO: </b></p>
			<p class="ai-header-datos mbt-0"><b>NÚMERO DE PADRÓN MUNICIPAL: </b></p>

			@endif
			<p class="ai-contenido-general">En la ciudad de Cancún, Municipio de Benito Juárez, Quintana Roo, Quintana Roo, siendo las _____ horas del día _____ de __________ del año ______, el suscrito @if($inspeccion->inspector == null) C._________________________________________, @else <b>C. {{ $inspeccion->inspector->nombre }} {{ $inspeccion->inspector->apellidopaterno }} {{ $inspeccion->inspector->apellidomaterno }},</b> @endif Inspector, Verificador y Notificador – Ejecutor adscrito a la Dirección de Fiscalización dependiente de la Tesorería Municipal del H. Ayuntamiento de Benito Juárez, Quintana Roo, me constituí en el domicilio de la persona: @if($inspeccion->comercio == null) _________________________________________________________ ubicado en: _____________________________________________________________ lugar donde se encuentra una negociación con giro de ______________________________________  @else {{ $inspeccion->comercio->propietarionombre }}  ubicado en: {{ $inspeccion->comercio->domiciliofiscal }} lugar donde se encuentra una negociación con giro de {aun no tenemos giro }@endif persona ante quien me identifico y acredito el carácter con el que me ostento mediante constancia con fotografía y sello oficial número con fecha de expedición _________________________; y vencimiento _________________________ expedida por el Lic. Marcelo José Guzmán, en su carácter de Tesorero Municipal de Benito Juárez Quintana Roo, con fundamento en el artículo 11, fracción XI, del Reglamento Interior de la Tesorería Municipal de Benito Juárez, Quintana Roo;  la cual tuvo a la vista y devuelve al identificado, para efecto a dar cumplimiento a la Orden de Inspección con número de folio <b>{{ $inspeccion->folio }}</b> de fecha ____________________________ expedida por el Director de Fiscalización  de  la Tesorería Municipal del H. Ayuntamiento de Benito Juárez, Quintana Roo, persona a la cual requerí la presencia del representante legal del contribuyente manifestando expresamente que _________________________________________________, por lo que, entendí la presente diligencia con una persona de nombre C. ________________________________________________, quien se identifica con ___________________________________________________ número ______________________________ expedida por ________________________________ quien señala ser ________________________________________________________________ quien lo acredita con ________________________________________________________________, acto seguido y en cumplimiento a la orden de inspección, procedo a solicitarle me informe cual es horario de operación del establecimiento comercial, a lo que manifiesta que: __________________________________________________________________________________________. Seguidamente, solicité a la persona con quien se entiende la presente diligencia la siguiente documentación: </p>

			<table class="ai-documentacion-requerida">
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
					

				</tbody>
			</table>

			<p class="observaciones mbt-0"><b>Observcaciones: </b>__________________________________________________________________________________________________________________________________________________________________</p>
			<p class="observaciones mbt-0">_____________________________________________________________________________________________________________________________________________________________________________________</p>
			<p class="observaciones mbt-0">_____________________________________________________________________________________________________________________________________________________________________________________</p>
			<p class="observaciones mbt-0">_____________________________________________________________________________________________________________________________________________________________________________________</p>

			<p class="derivado mt-0">Derivado  de los resultados de la presente Inspección, con fundamento en el artículo 51, fracción I, del Código Fiscal Municipal del Estado de Quintana Roo vigente, se cita al contribuyente o a su representante legal, para que dentro del término de diez días contados a  partir del día siguiente al que se realiza esta diligencia, se presente en las oficinas de la Dirección de Fiscalización dependiente de la Tesorería Municipal de Benito Juárez, Quintana Roo, ubicada en Edificio anexo al Palacio Municipal  en la Avenida Nader sin número, Supermanzana 5, de esta ciudad de Cancún, Quintana Roo, para presentar la documentación que no exhibe en la presente diligencia, apercibido que en caso de no hacerlo se procederá de conformidad con lo establecido en el artículo 509, fracciones IV y VII del Bando de Gobierno y Policía del Municipio de Benito Juárez, Quintana Roo y 68 del Código Fiscal Municipal del  Estado de Quintana Roo. Leída la presente acta de inspección y no habiendo nada más que hacer constar, se da por terminada la presente diligencia a las ______ horas del día _____ del mes __________ del año _______, haciendo constar que se entrega un tanto original de la orden de inspección señalada de la presente actuación a la persona con quien se entendió la diligencia, firmándola para su constancia las personas que en ella intervinieron y quisieron hacerlo para los efectos legales que correspondan.</p><br>

			<table class="firma-acta-inspeccion">
				<tr>
					<td class="ai-firma-inspector">
						<div >
							<p class="text-center mbt-0">_________________________________________________</p>
							<p class="text-center"><b>Inspector, verificador y notificador - ejecutor <br>nombre y firma</b></p>
							<p class="mbt-0"><b>Constancia número __________ expedida por la tesorería municipal del h. ayuntamiento de benito juárez, quintana roo, con fotografía y sello oficial.</b></p>
							<p class="mbt-0"><b>Fecha de emisión: </b>______________________________________________________________.</p>
							<p class="mbt-0"><b>Vigencia del: </b>__________________________________________________________________.</p>
						</div>
					</td>
					<td class="ai-firma-encargado">
						<div >
							<p class="text-center mbt-0 ">_______________________________________________</p>
							<p class="text-center mbt-0 "><b>Persona con quien se entendío la diligencia <br>nombre y firma</b></p>
						</div>
					</td>
				</tr>
			</table>
		</div>
		
	</body>
</html>