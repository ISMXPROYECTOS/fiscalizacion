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
	<p class="text-justify mb-3" style="font-size:10px;letter-spacing:1px;">Esta Dirección de Fiscalización dependiente de la Tesorería Municipal del Ayuntamiento de Benito Juárez, Quintana Roo, con fundamento en los Artículos 16 y 115, fracción V, inciso f), de la Constitución Política de los Estados Unidos Mexicanos; 1, 2, 3, 24, 126, 127 y 128, fracción VI, de la Constitución Política del Estado Libre y Soberano de Quintana Roo; 1,2, 3, 116, fracción II, 122, 125, fracciones I, III, VII y XIX, de la Ley de los Municipios del Estado de Quintana Roo; 1, 2, 3, 4, 5, fracciones XI y XXVIII, 6 fracción IV, V, VI y VII, 7, 8, 17, 60, Apartado B, fracciones I, II, III, IV, VI, XVI y LXIII, 479, 480, 481, 482, 484, 485, 486, 491, 492, 498, 499, 502, 503 y 504 del Bando de Gobierno y Policía del Municipio de Benito Juárez, Quintana Roo; 1, 2, 3, 4, 6, 8, 34, 35, 38, 39, 52, 53, 54, 95, 98, 99, 116, 118, 119, 120, 135, 136, 137, 139, fracción XII, 141, fracciones V, VI, VII, 142, fracciones V, VI, VII, y 155, fracción I, incisos a) y b), de la Ley de Hacienda del Municipio de Benito Juárez del Estado de Quintana Roo; 1, 4, 5, fracciones II, V y VII, 11, 18, 19, 30, 33, fracciones I, II, III, IV, XI y XII, 40, 42, fracciones II y IV, 43, 45, 48, 51, fracción I, y 52 del Código Fiscal Municipal del Estado de Quintana Roo; 37 de la Ley para la Prevención y la Gestión integral de Residuos del Estado de Quintana Roo; 7, 22, fracción II, 35, fracciones II, III, XXV, XXVI, XXVII, XXVIII, XXXI y XLVI, y 36, fracción V, del Reglamento Orgánico de la Administración Pública Centralizada del Municipio de Benito Juárez, Quintana Roo; 2, fracciones II y VI, 7, 9, 10, fracción I, inciso e), 12, 13, fracciones I y IV, y 22, fracciones II, III, IV, V, VIII, IX, XII, XIII, XV y XVIII, del Reglamento Interior de la Tesorería Municipal de Benito Juárez, todos ordenamientos jurídicos vigentes; expide la presente <b>ORDEN DE INSPECCIÓN</b>, para tal efecto se designa, autoriza y comisiona al/los @if($inspeccion->inspector == null) C._________________________________________, @else <b>C. {{ $inspeccion->inspector->nombre }} {{ $inspeccion->inspector->apellidopaterno }} {{ $inspeccion->inspector->apellidomaterno }},
	@if(count($inspectoresExtra) >= 1)
		@foreach($inspectoresExtra as $inspectorExtra)
			{{ $inspectorExtra[0]['nombre'] }} {{ $inspectorExtra[0]['apellidopaterno'] }} {{ $inspectorExtra[0]['apellidomaterno'] }},
		@endforeach
	@endif
	</b> @endif Inspector(es), Verificador(es) y Notificador – Ejecutor(es) adscritos a la Dirección de Fiscalización de la Tesorería Municipal del H. Ayuntamiento Benito Juárez, Quintana Roo, quienes podrán actuar conjunta o individualmente y deberán acreditar ese carácter con su identificación con fotografía y sello oficial vigente, expedida por el Lic. Marcelo José Guzmán, en su carácter de Tesorero Municipal del Municipio de Benito Juárez Quintana Roo, con fundamento en el artículo 11, fracción XI, del Reglamento Interior de la Tesorería Municipal de Benito Juárez; para que se presente en el domicilio del establecimiento arriba señalado y realice la inspección que corresponda, debiendo verificar que cumpla con el giro y horario de operación de dicho establecimiento comercial, que tenga a la vista la documentación vigente que acredite su correcto funcionamiento y que se encuentre al corriente del pago de sus contribuciones municipales, por lo que, se le requiere que permita al Inspector, Verificador y Notificador–Ejecutor el acceso y recorrido a su establecimiento y le exhiba el original de los documentos aplicables a su giro comercial y actividades, según sea el caso, entre otros, los consistentes en: @foreach($inspeccion->tipoInspeccion->documentacionPorTipoDeInspeccion as $documento)<b>{{ $documento->documentacionRequerida->nombre }}; </b>@endforeach lo anterior, para que se conozca su situación fiscal y administrativa, levantándose al efecto el Acta de Inspección en la que se deje constancia de lo aquí ordenado, apercibido que en caso de no hacerlo será sancionado según su conducta en términos de los artículos 505, 506, 507 y 509, fracción IV y VII, del Bando de Gobierno y Policía del Municipio de Benito Juárez, Quintana Roo y 68, fracciones I,III,V, X, XI y XV, del Código Fiscal Municipal del Estado de Quintana Roo, vigentes; autorizándose en su caso la intervención y acceso de elementos de la Fuerza Pública Municipal para su cumplimiento. Considerando que las actividades que realiza pueden ser llevados a cabo más allá de los días y horarios hábiles, se habilitan días y horas inhábiles para que la visita de inspección también pueda llevarse a cabo en horas y días inhábiles, o iniciarse en  días y horas hábiles y finalizarse en días y horas inhábiles, lo anterior, con fundamento en el artículo 18 del Código Fiscal Municipal del Estado de Quintana Roo. se le apercibe al visitado, que, si al momento de la diligencia, no cuenta con la licencia de funcionamiento municipal o el refrendo declarativo anual, el establecimiento visitado podrá ser sujeto a clausura en cualquier momento, ello de conformidad con lo establecido en los artículos, 479 y 509, fracciones IV y VII del Bando de Gobierno y Policía del Municipio de Benito Juárez, Quintana Roo, ya que para el ejercicio de cualquier actividad comercial, industrial o de servicios por parte de los contribuyentes, previo a su apertura y operación, se requiere de licencia de funcionamiento expedido por el Ayuntamiento, entendiéndose que no cuenta con la autorización para funcionar si no exhibe la licencia de funcionamiento municipal o el refrendo declarativo anual correspondiente.</p>
	<p style="font-size:11px;letter-spacing:1px;"><b>Cancún, Municipio de Benito Juárez, Quintana Roo, @if($inspeccion->comercio == null) a _____ de _________ de ______. @else {{ $fecha_hoy }}. @endif </b></p>
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

	<img src="{{ asset('img/header-acta-inspeccion.jpg') }}" width="100%" class="mb-3">
	<h6 class="text-right mb-3 font-weight-bold">FOLIO: {{ $inspeccion->folio }}</h6>
	@if($inspeccion->comercio == null)
	<p class="mb-0 mt-0" style="line-height: 1;"><b style="font-size:10px;letter-spacing:1px;">NOMBRE DEL CONTRIBUYENTE: </b>________________________________________________________________________________</p>
	<p class="mb-0 mt-0" style="line-height: 1;"><b style="font-size:10px;letter-spacing:1px;">NOMBRE COMERCIAL DEL ESTABLECIMIENTO: </b>______________________________________________________________________</p>
	<p class="mb-0 mt-0" style="line-height: 1;"><b style="font-size:10px;letter-spacing:1px;">DOMICILIO DEL ESTABLECIMIENTO: </b>_____________________________________________________________________________</p>
	<p class="mb-3 mt-0" style="line-height: 1;"><b style="font-size:10px;letter-spacing:1px;">NÚMERO DE PADRÓN MUNICIPAL: </b>______________________________________________________________________________</p>
	@else
	<p class="mb-0 mt-0" style="line-height: 1;"><b style="font-size:10px;letter-spacing:1px;">NOMBRE DEL CONTRIBUYENTE: </b>{{ $inspeccion->comercio->propietarionombre }}</p>
	<p class="mb-0 mt-0" style="line-height: 1;"><b style="font-size:10px;letter-spacing:1px;">NOMBRE COMERCIAL DEL ESTABLECIMIENTO: </b>{{ $inspeccion->comercio->nombreestablecimiento }}</p>
	<p class="mb-0 mt-0" style="line-height: 1;"><b style="font-size:10px;letter-spacing:1px;">DOMICILIO DEL ESTABLECIMIENTO: </b>{{ $inspeccion->comercio->domiciliofiscal }}</p>
	<p class="mb-3 mt-0" style="line-height: 1;"><b style="font-size:10px;letter-spacing:1px;">NÚMERO DE PADRÓN MUNICIPAL: </b></p>
	@endif
	<p class="text-justify mb-3" style="font-size:8px;letter-spacing:1px;">En la ciudad de Cancún, Municipio de Benito Juárez, Quintana Roo, Quintana Roo, siendo las _______ horas del @if($inspeccion->comercio == null) día _____ de __________ del año ______, @else {{ $fecha_hoy }}, @endif el suscrito @if($inspeccion->inspector == null) C._________________________________________, @else <b>C. {{ $inspeccion->inspector->nombre }} {{ $inspeccion->inspector->apellidopaterno }} {{ $inspeccion->inspector->apellidomaterno }},</b> @endif Inspector, Verificador y Notificador – Ejecutor adscrito a la Dirección de Fiscalización dependiente de la Tesorería Municipal del H. Ayuntamiento de Benito Juárez, Quintana Roo, me constituí en el domicilio de la persona: @if($inspeccion->comercio == null) _________________________________________________________ ubicado en: _____________________________________________________________ lugar donde se encuentra una negociación con giro de ______________________________________ @else {{ $inspeccion->comercio->propietarionombre }} ubicado en: {{ $inspeccion->comercio->domiciliofiscal }} lugar donde se encuentra una negociación con giro de {aun no tenemos giro }@endif persona ante quien me identifico y acredito el carácter con el que me ostento mediante constancia con fotografía y sello oficial número con fecha de expedición _________________________; y vencimiento _________________________ expedida por el Lic. Marcelo José Guzmán, en su carácter de Tesorero Municipal de Benito Juárez Quintana Roo, con fundamento en el artículo 11, fracción XI, del Reglamento Interior de la Tesorería Municipal de Benito Juárez, Quintana Roo;  la cual tuvo a la vista y devuelve al identificado, para efecto a dar cumplimiento a la Orden de Inspección con número de folio <b>{{ $inspeccion->folio }}</b> de fecha ____________________________ expedida por el Director de Fiscalización  de  la Tesorería Municipal del H. Ayuntamiento de Benito Juárez, Quintana Roo, persona a la cual requerí la presencia del representante legal del contribuyente manifestando expresamente que _________________________________________________, por lo que, entendí la presente diligencia con una persona de nombre C. ________________________________________________, quien se identifica con ___________________________________________________ número ______________________________ expedida por ________________________________ quien señala ser ________________________________________________________________ quien lo acredita con ________________________________________________________________, acto seguido y en cumplimiento a la orden de inspección, procedo a solicitarle me informe cual es horario de operación del establecimiento comercial, a lo que manifiesta que: __________________________________________________________________________________________. Seguidamente, solicité a la persona con quien se entiende la presente diligencia la siguiente documentación: </p>
	<table class="table table-bordered table-sm">
		<thead class="text-center text-uppercase" style="font-size:8px;letter-spacing:1px;">
			<tr>
				<th style="width:50%;">Documentación</th>
				<th style="width:5%;">Solicitada</th>
				<th style="width:5%;">Exhibida</th>
				<th cstyle="width:30%;">Observaciones</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td></td>
				<td class="text-center text-uppercase font-weight-bold pt-0 pb-0" style="font-size:8px;letter-spacing:1px;">Si / No</td>
				<td class="text-center text-uppercase font-weight-bold pt-0 pb-0" style="font-size:8px;letter-spacing:1px;">Si / No</td>
				<td></td>
			</tr>
			@foreach($inspeccion->tipoInspeccion->documentacionPorTipoDeInspeccion as $documento)
			<tr>
				<td class="text-uppercase font-weight-bold pt-0 pb-0" style="font-size:7px;">{{ $documento->documentacionRequerida->nombre }}</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<p class="text-uppercase mb-0 mt-0" style="line-height: 1;"><b style="font-size:10px;letter-spacing:1px;">Observaciones: </b> ________________________________________________________________________________________</p>
	<p class="mb-0 mt-0" style="line-height: 1;">____________________________________________________________________________________________________</p>
	<p class="mb-0 mt-0" style="line-height: 1;">____________________________________________________________________________________________________</p>
	<p class="mb-3 mt-0" style="line-height: 1;">____________________________________________________________________________________________________</p>
	<p class="text-justify mb-3" style="font-size:8px;letter-spacing:1px;">Derivado  de los resultados de la presente Inspección, con fundamento en el artículo 51, fracción I, del Código Fiscal Municipal del Estado de Quintana Roo vigente, en este acto se le requiere al  contribuyente o a su representante legal, para que dentro del término de diez días contados a  partir del día siguiente al que se realiza esta diligencia, comparezca en las oficinas de la Dirección de Fiscalización dependiente de la Tesorería Municipal de Benito Juárez, Quintana Roo, ubicada en Edificio anexo al Palacio Municipal  en la Avenida Nader sin número, Supermanzana 5, de esta ciudad de Cancún, Quintana Roo, para exhibir la documentación que no exhibe en la presente diligencia, apercibido que en caso de no hacerlo se procederá de conformidad con lo establecido en el artículo 68 del Código Fiscal Municipal del  Estado de Quintana Roo. Asimismo, en el caso de no contar con la licencia de funcionamiento municipal al momento de la diligencia, se le apercibe al contribuyente que el establecimiento visitado podrá ser sujeto a clausura en cualquier momento, ello de conformidad con lo establecido en los artículos 479 y 509, fracciones IV y VII del Bando de Gobierno y Policía del Municipio de Benito Juárez, Quintana Roo, ya que para el ejercicio de cualquier actividad comercial, industrial o de servicios por parte de los contribuyentes, se requiere de permiso, licencia o autorización, según sea el caso, expedido por el Ayuntamiento, entendiéndose que no cuenta la autorización para funcionar si no exhibe la licencia de funcionamiento municipal o el refrendo declarativo anual correspondiente. Leída la presente acta de inspección y no habiendo nada más que hacer constar, se da por terminada la presente diligencia a las __________ horas del día _________ del mes ________________ del año ___________, haciendo constar que se entrega un tanto original de la orden de inspección  señalada de la presente actuación y una copia al carbón de la presente actuación a la persona con quien se entendió la diligencia, firmándola para su constancia las personas que en ella intervinieron y quisieron hacerlo para los efectos legales que correspondan</p><br>
	<table class="table-sm" style="font-size:10px;">
		<tr>
			<td class="text-uppercase" style="width:50%;padding-left: 5%">
				<div>
					<p class="text-center">______________________________________</p>
					<p class="text-center"><b>Inspector, verificador y notificador - ejecutor <br>nombre y firma</b></p>
					<p><b>Constancia número __________ expedida por la tesorería municipal del h. ayuntamiento de benito juárez, quintana roo, con fotografía y sello oficial.</b></p>
					<p><b>Fecha de emisión: </b>________________________________________________.</p>
					<p><b>Vigencia del: </b>____________________________________________________.</p>
				</div>
			</td>
			<td class="text-uppercase" style="width:50%;">
				<div>
					<p class="text-center">______________________________________</p>
					<p class="text-center"><b>Persona con quien se entendío la diligencia <br>nombre y firma</b></p>
				</div>
			</td>
		</tr>
	</table>
</body>
</html>