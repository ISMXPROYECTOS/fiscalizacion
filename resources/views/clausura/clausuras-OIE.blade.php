<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>CLAUSURA 2019-2021</title>
		<link rel="stylesheet" href="{{ asset('css/acta-clausura-oie.css') }}" />
	</head>
	<body>
		@foreach($inspecciones as $inspeccion)
		<img src="{{ asset('img/header-orden-clausura-est.jpg') }}" width="100%">
		<div class="container">
			<h5 class="folio">FOLIO: {{ $inspeccion->folio }}</h5><br><br>
			@if($inspeccion->comercio == null)
				<p class="oc-header-datos mbt-0"><b>NOMBRE DEL CONTRIBUYENTE: </b>________________________________________________________________________________________________</p>
				<p class="oc-header-datos mbt-0"><b>NOMBRE COMERCIAL DEL ESTABLECIMIENTO: </b>___________________________________________________________________________________</p>
				<p class="oc-header-datos mbt-0"><b>DOMICILIO DEL ESTABLECIMIENTO: </b>_____________________________________________________________________________________________</p>
				<p class="oc-header-datos mbt-0"><b>GIRO: </b>_______________________________________________________________________________________________________________________</p>
			@else
				<p class="oc-header-datos mbt-0"><b>NOMBRE DEL CONTRIBUYENTE: </b>{{ $inspeccion->comercio->propietarionombre }}</p>
				<p class="oc-header-datos mbt-0"><b>NOMBRE COMERCIAL DEL ESTABLECIMIENTO: </b>{{ $inspeccion->comercio->nombreestablecimiento }}</p>
				<p class="oc-header-datos mbt-0"><b>DOMICILIO DEL ESTABLECIMIENTO: </b>{{ $inspeccion->comercio->domiciliofiscal }}</p>
				<p class="oc-header-datos mbt-0"><b>GIRO: </b></p>
			@endif

			<p class="oc-header-datos mbt-0">Cancún, Muncipio de Benito Juárez, Quintana Roo, a _____ de _______________ de ______. </p>

			<p class="contenido-general">Visto el estado de guarda el expediente {{ $inspeccion->folio }} mediante el cual en fecha _____ de ______________ de ______, se le impuso al contribuyente _________________________________________________________________ una sanción en cantidad de ________________________________________________________________ misma que fue notificada el día  _____ de ______________ de ______ y que una vez notificada la citada resolución se le concedió al infractor un plazo de 30 días naturales para acreditar el pago de la sanción impuesta, esta autoridad procede a dictar el siguiente acuerdo:</p>

			<p class="contenido-general">Comisiónese a ________________________________________________________________________________________, Inspector, Verificador y Notificador – Ejecutor adscrito a la Dirección de Fiscalización de la Tesorería Municipal del H. Ayuntamiento Benito Juárez, Quintana Roo, quienes podrán actuar de manera indistinta, para que se constituyan en el domicilio ubicado en ________________________________________________________________________________________ y en el acto, le requieran a la empresa __________________________________________________________________ que exhiba el recibo de pago de la sanción que le fuere impuesta en el presente expediente, con el apercibimiento que de no hacerlo, con fundamento en lo dispuesto en el artículo 82 fracción VI del Reglamento de estacionamientos del Municipio de Benito Juárez, el personal comisionado procederá a la clausura del establecimiento, debiendo permanecer así, hasta en tanto el infractor no acredite hacer cubierto el monto de la sanción impuesta.</p>

			<p class="contenido-general">Para tal fin, el personal comisionado, deberá identificarse con la constancia de identificación con fotografía vigente,  expedida por el Lic. Marcelo José Guzmán, en su carácter de Tesorero Municipal del Municipio de Benito Juárez Quintana Roo, con fundamento en el artículo 11, fracción XI, del Reglamento Interior de la Tesorería Municipal de Benito en vigor, requiriéndose al contribuyente para que permita el acceso a su establecimiento apercibido que en caso de no hacerlo será requerido el apoyo de la fuerza pública, así como que incurriría en el DELITO DE QUEBRANTAMIENTO DE SELLOS previsto por el artículo 218 del Código Penal para el Estado Libre y Soberano de Quintana Roo, si altera, rompe o destruye, los sellos de clausura que en el acto de la diligencia sean colocados por la persona designada para los efectos señalados, los cuales sólo podrán ser levantados por quien designe esta Autoridad.</p>
			
			
				<p class="contenido-general">Así lo acordó y firma el Ingeniero @if(is_object($inspeccion->formavalorada)) {{ $inspeccion->formavalorada->encargado->nombre }} {{ $inspeccion->formavalorada->encargado->apellidopaterno }} {{ $inspeccion->formavalorada->encargado->apellidomaterno }}, {{ $inspeccion->formavalorada->encargado->puesto }}, @endif con fundamento en los artículos los artículos 14 y 16 de la Constitución Política de los Estados Unidos Mexicanos, 65, 66 fracción I inciso b), de la Ley de los Municipios del Estado de Quintana Roo, 71, fracción I, II y V del Código de Justicia Administrativa del Estado de Quintana Roo, 1, 2 y 3 del Bando de Gobierno y Policía del Municipio de Benito Juárez, 1, 3, fracción IV, 3 inciso D, fracción II y V, 71, 77 y 78 fracciones  I y II, del Reglamento de Estacionamientos del Municipio de Benito Juárez,  artículos  22 fracciones II, III, V, VIII, IX, XII, XIII,  XV y XVIII del Reglamento Interior de la Tesorería del Municipio de Benito Juárez, todos ordenamientos jurídicos vigentes.</p>
			
		</div>

		<div class="page_break"></div>

		<img src="{{ asset('img/header-acta-clausura-est.jpg') }}" width="100%">
		<div class="container">
			<h5 class="folio">FOLIO: {{ $inspeccion->folio }}</h5><br><br>
			@if($inspeccion->comercio == null)
				<p class="ac-header-datos mbt-0"><b>NOMBRE DEL CONTRIBUYENTE: </b>_____________________________________________________________________________________________________________________________________</p>
				<p class="ac-header-datos mbt-0"><b>NOMBRE COMERCIAL DEL ESTABLECIMIENTO: </b>________________________________________________________________________________________________________________________</p>
				<p class="ac-header-datos mbt-0"><b>DOMICILIO DEL ESTABLECIMIENTO: </b>__________________________________________________________________________________________________________________________________</p>
				<p class="ac-header-datos mbt-0"><b>GIRO: </b>_____________________________________________________________________________________________________________________________________________________________</p>
			@else
				<p class="ac-header-datos mbt-0"><b>NOMBRE DEL CONTRIBUYENTE: </b>{{ $inspeccion->comercio->propietarionombre }}</p>
				<p class="ac-header-datos mbt-0"><b>NOMBRE COMERCIAL DEL ESTABLECIMIENTO: </b>{{ $inspeccion->comercio->nombreestablecimiento }}</p>
				<p class="ac-header-datos mbt-0"><b>DOMICILIO DEL ESTABLECIMIENTO: </b>{{ $inspeccion->comercio->domiciliofiscal }}</p>
				<p class="ac-header-datos mbt-0"><b>GIRO: </b></p>
			@endif

			<p class="ac-contenido-general mb-0">En la ciudad de Cancún, Municipio de Benito Juárez, Quintana Roo, Quintana Roo, siendo las _____ horas del día _____ del mes de ______________ del año _______, el suscrito @if($inspeccion->inspector == null) C.____________________________________________, @else <b>C. {{ $inspeccion->inspector->nombre }} {{ $inspeccion->inspector->apellidopaterno }} {{ $inspeccion->inspector->apellidomaterno }},</b> @endif en mi carácter de Inspector, Verificador y Notificador–Ejecutor adscrito a la Dirección de Fiscalización de la Tesorería Municipal del H. Ayuntamiento Benito Juárez, Quintana Roo, con fundamento en los Artículos 14 y 16 de la Constitución Política de los Estados Unidos Mexicanos; 24 y 128, fracción VI, de la Constitución Política del Estado Libre y Soberano de Quintana Roo, 125, fracciones I, III y VII, de la Ley de los Municipios del Estado de Quintana Roo; 1, 2 y 3 del Bando de Gobierno y Policía del Municipio de Benito Juárez, Quintana Roo, 71, fracción I, II y V del Código de Justicia Administrativa del Estado de Quintana Roo, 1, 2 y 3 del Bando de Gobierno y Policía del Municipio de Benito Juárez, 1, 3, fracción IV, 3 inciso D, fracción II y V, 71, 77 y 78 fracciones  I y II, del Reglamento de Estacionamientos del Municipio de Benito Juárez y 22, fracciones II, III, V, VIII, IX, XII, XIII,  XV y XVIII del Reglamento Interior de la Tesorería del Municipio de Benito Juárez, todos ordenamientos jurídicos vigentes; y en cumplimiento al acuerdo de fecha _______ de _________________ de _______ a través  del cual se me comisiona para requerirle a la empresa @if($inspeccion->comercio == null ) _________________________________________________ @else {{ $inspeccion->comercio->denominacion }} @endif que acredite haber efectuado el pago de la sanción impuesta en el folio {{ $inspeccion->folio }} y en caso de no hacer proceder a la clausura del establecimiento, hace constar que estando constituido en el domicilio del establecimiento comercial del contribuyente ubicado  en: @if($inspeccion->comercio == null)  ______________________________________________________________ @else {{ $inspeccion->comercio->domiciliofiscal }} @endif de esta Ciudad de Cancún, Quintana Roo, lugar donde se encuentra una negociación con giro ESTACIONAMIENTO AL PÚBLICO, entendiendo la presente diligencia con una persona de nombre C. __________________________________________________________, quien señala ser _________________________________________, lo que acredita con _____________________________________________, y se identifica con ____________________________________________ número ____________________________________ expedida por: ________________________________________________________________ persona ante quien me identifico y acredito el carácter con el que me ostento mediante identificación con fotografía número __________________, con fecha de expedición ______________________________ y fecha de vencimiento ________________________________  expedida por el Lic. Marcelo José Guzmán, en su carácter de Tesorero Municipal del Municipio de Benito Juárez Quintana Roo, con fundamento en el artículo 11, fracción XI, del Reglamento Interior de la Tesorería Municipal de Benito Juárez; la cual tuvo a la vista y devuelve al identificado, notificando  y entregándosele un tanto en original de la orden señalada, por lo que en acto seguido se procede a requerir a la persona con la que se atiende la diligencia que acredite haber efectuado el pago de la sanción impuesta en el presente expediente, mismo que manifiesta que _________________________________________________________________________________________________________________</p>
			<p class="ac-contenido-general mbt-0">_____________________________________________________________________________________________________________________________</p>
			<p class="ac-contenido-general mbt-0">_____________________________________________________________________________ por lo que al no exhibirme el recibo de pago, en este acto, procedo  a ejecutar y cumplimentar el acuerdo aquí citado, clausurándose formalmente dicho establecimiento, no sin antes habiéndose permitido la salida de todas las personas que se encontraban en el interior del mismo, así como que se apagaran y desconectaran los aparatos que así lo decidió la persona con la que se entiende la presente diligencia, de igual manera en caso de contar con alimentos perecederos esta autoridad permite que sean retirados por quien atiende la diligencia,  cerrándose todos sus accesos y colocándose _________________ sellos de clausura, los cuales sólo podrán ser retirados por quien designe esta Autoridad, ahora bien, si los altera, rompe o destruye, se incurrirá en el DELITO DE QUEBRANTAMIENTO DE SELLOS previsto por el artículo 218 del Código Penal para el Estado Libre y Soberano de Quintana Roo; por lo que no habiendo nada más que agregar se da por terminada la presente diligencia a las ________ horas del día _______ del mes de ____________________ del año ______, haciendo constar que se entregó un tanto en original de la Orden de Clausura señalada y de la presente actuación a la persona  con quien se entendió la diligencia, firmándola para su constancia las personas que en ella intervinieron y quisieron hacerlo para los efectos legales que correspondan</p>

			<br>
			<table class="firma-acta-clausura">
				<tr>
					<td class="ac-firma-inspector">
						<div >
							<p class="text-center mbt-0">_________________________________________________</p>
							<p class="text-center"><b>Inspector, verificador y notificador - ejecutor <br>nombre y firma</b></p>
							<p class="mbt-0"><b>Previo al inicio de la visita se hace constar que el inspector se identifico constancia número ______________ espedida por la tesoreria municipal del H. Ayuntamiento de Benito Juárez, Quintana Roo, con fotografía y sello oficial</b></p>
							<p class="mbt-0"><b>Fecha de emisión: </b>______________________________________________________________.</p>
							<p class="mbt-0"><b>Vigencia del: </b>__________________________________________________________________.</p>
						</div>
					</td>
					<td class="ac-firma-encargado">
						<div >
							<p class="text-center mbt-0 ">_______________________________________________</p>
							<p class="text-center mbt-0 "><b>Persona con quien se entendío la diligencia <br>nombre y firma</b></p>
						</div>
					</td>
				</tr>
			</table>
		</div>
	@endforeach
	</body>
</html>