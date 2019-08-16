<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.css') }}" />
	<link rel="stylesheet" href="{{ asset('css/acta-inspeccion.css') }}" />
	
</head>
<body>
	
	
	@foreach($inspecciones as $inspeccion)
	<img src="{{ asset('img/header-acta-inspeccion.png') }}" width="100%" class="mb-1">
	<div class="container">
		<h6 class="float-right folio">FOLIO <b>{{ $inspeccion->folio }}</b></h6><br><br>
		<p class="mb-1 text-uppercase"><b>Nombre del Contribuyente:</b> ________________________________________________________________________________________________</p>
		<p class="mb-1 text-uppercase"><b>Nombre comercial del establecimiento:</b> ___________________________________________________________________________________</p>
		<p class="mb-1 text-uppercase"><b>Domicilio del establecimiento:</b> _____________________________________________________________________________________________</p>
		<p class="mb-1 text-uppercase"><b>Giro:</b> ________________________________________________________________________________________________________________________</p>
		<p class="mb-2 text-uppercase"><b>Número de padron municipal:</b> _______________________________________________________________________________________________</p>
		<p class="text-justify">Esta Dirección de Fiscalización dependiente de la Tesorería Municipal del Ayuntamiento de Benito Juárez, Quintana Roo, con fundamento en los Artículos 16 y 115, fracción V, inciso f), de la Constitución Política de los Estados Unidos Mexicanos; 1, 2, 3, 24, 126, 127 y 128, fracción VI, de la Constitución Política del Estado Libre y Soberano de Quintana Roo; 1,2, 3, 116, fracción II, 122, 125, fracciones I, III, VII y XIX, de la Ley de los Municipios del Estado de Quintana Roo; 1, 2, 3, 4, 5, fracciones XI y XXVIII, 6 fracción IV, V, VI y VII, 7, 8, 17, 60, Apartado B, fracciones I, II, III, IV, VI, XVI y LXIII, 479, 480, 481, 482, 484, 485, 486, 491, 492, 498, 499, 502, 503 y 504 del Bando de Gobierno y Policía del Municipio de Benito Juárez, Quintana Roo; 1, 2, 3, 4, 6, 8, 34, 35, 38, 39, 52, 53, 54, 95, 98, 99, 116, 118, 119, 120, 135, 136, 137, 139, fracción XII, 141, fracciones V, VI, VII, 142, fracciones V, VI, VII, y 155, fracción I, incisos a) y b), de la Ley de Hacienda del Municipio de Benito Juárez del Estado de Quintana Roo; 1, 4, 5, fracciones II, V y VII, 11, 18, 19, 30, 33, fracciones I, II, III, IV, XI y XII, 40, 42, fracciones II y IV, 43, 45, 48, 51, fracción I, y 52 del Código Fiscal Municipal del Estado de Quintana Roo; 37  de la Ley para la Prevención y la Gestión integral de Residuos del Estado de Quintana Roo; 7, 22, fracción II, 35, fracciones II, III, XXV, XXVI, XXVII, XXVIII, XXXI y XLVI, y 36, fracción V, del  Reglamento Orgánico de la Administración Pública Centralizada del Municipio de Benito Juárez, Quintana Roo; 2, fracciones II y VI, 7, 9, 10, fracción I, inciso e), 12, 13, fracciones I y IV, y 22, fracciones II, III, IV, V, VIII, IX, XII, XIII, XV y XVIII, del Reglamento Interior de la Tesorería Municipal de Benito Juárez, todos ordenamientos jurídicos vigentes; expide la presente ORDEN DE INSPECCIÓN, para tal efecto se designa, autoriza y comisiona a los C._________________________________________, Inspector, Verificador y Notificador – Ejecutor adscritos a la Dirección de Fiscalización de la Tesorería Municipal del H. Ayuntamiento Benito Juárez, Quintana Roo, quienes podrán actuar conjunta o individualmente y deberán acreditar ese carácter con su identificación con fotografía y sello oficial vigente, expedida por el Lic. Marcelo José Guzmán, en su carácter de Tesorero Municipal del Municipio de Benito Juárez Quintana Roo, con fundamento en el artículo 11, fracción XI, del Reglamento Interior de la Tesorería Municipal de Benito Juárez; para que se presente en el domicilio del establecimiento arriba señalado y realice la inspección que corresponda, debiendo verificar que cumpla con el giro y horario de operación de dicho establecimiento comercial, que tenga a la vista la documentación vigente que acredite su correcto funcionamiento y que se encuentre al corriente del pago de sus contribuciones municipales, por lo que, se le requiere que permita al Inspector, Verificador y Notificador–Ejecutor el acceso y recorrido a su establecimiento y le exhiba el original de los documentos aplicables a su giro comercial y actividades, según sea el caso, entre otros, los consistentes en: <b>Recibos Oficiales del Pago del Impuesto Predial vigente; Permiso para la presentación de Espectáculos Públicos; Recibos Oficiales del pago del Impuesto sobre Diversiones, Video Juegos, Cines y Espectáculos Públicos vigente; Recibos Oficiales del Pago del Impuesto a Músicos y Cancioneros Profesionales vigente; Constancia de Autorización de Uso de Suelo vigente; Licencia de Funcionamiento para el Ejercicio Fiscal 2019; Recibos Oficiales del Pago de Derechos de Horario Extraordinario vigente; Recibos Oficiales del Pago de Derechos para el Uso de Anuncios, Carteles y Publicidad vigente; Recibos Oficiales del Pago de Derechos de Servicios de Recolección, Transportación, Tratamiento y Destino Final de Residuos Sólidos vigente; Recibo Oficial del pago de los Planes de Manejo de Residuos Sólidos Urbanos vigente; Recibo Oficial de Pago de Derechos de Anuencia en materia de Protección Civil vigente; Anuencia materia de Protección Civil vigente; Alta ante el Registro Federal de Contribuyentes para efecto de verificar la fecha de inicio de actividades del establecimiento; Constancia vigente de no adeudo de uso, goce y/o aprovechamiento de la Zona Federal Marítimo Terrestre (ZOFEMAT); Recibo de pago por instalación de módulo de prestación de servicios y/o cajero automático de institución bancaria vigente; Recibo de pago de derechos para la degustación con venta en general vigente; Recibo de pago de derechos por exposiciones de productos, Expo-Ferias y servicios en general; Recibo de pago por estructuras temporales y Expo-Ferias mayores a 50 m2 donde se comercialicen artículos diversos para su venta al público en general;</b> lo anterior, para que se conozca su situación fiscal y administrativa, levantándose al efecto el Acta de Inspección en la que se deje constancia de lo aquí ordenado, apercibido que en caso de no hacerlo será sancionado según su conducta en términos de los artículos 505, 506, 507 y 509, fracción IV y VII, del Bando de Gobierno y Policía del Municipio de Benito Juárez, Quintana Roo y 68, fracciones I,III,V, X, XI y XV, del Código Fiscal Municipal del Estado de Quintana Roo, vigentes; autorizándose en su caso la intervención y acceso de elementos de la Fuerza Pública Municipal para su cumplimiento. Para el caso de prolongarse la realización de la diligencia aquí ordenada, con fundamento en lo dispuesto por el  artículo 18 del Código Fiscal Municipal del Estado de Quintana Roo, se habilita el horario comprendido de las 18:01 a las 24:00 horas del día _____ de __________ del año _______, así como de las 00:00 a las 07:29 horas del día _____ de _________ del año ______ en el cual podrá iniciarse o continuarse hasta su conclusión.</p>

		<p><b>Cancún, Municipio de Benito Juárez, Quintana Roo,  a _____ de _________ de ______. </b></p>
		<br>
		<br>

		<p class="mb-0 text-uppercase atte"><b>A T E N T A M E N T E</b></p>

		<table class="table-firma">
			<tr>
				<td class="td-datos-encargado">
					@if(is_object($inspeccion->formavalorada))
						<p class="mb-0 text-uppercase"><b>{{ $inspeccion->formavalorada->configuracion->nombre }} {{ $inspeccion->formavalorada->configuracion->apellidopaterno }} {{ $inspeccion->formavalorada->configuracion->apellidomaterno }}</b></p>
						<p class="mb-0 text-uppercase"><b>{{ $inspeccion->formavalorada->configuracion->puesto }}</b></p>
					@endif
				</td>
				<td >
					<div class="firma">
						<p class="mb-0 text-uppercase"><b>Firma: </b>____________________________________________________</p>
						<p class="mb-0 text-uppercase"><b>Nombre: </b>__________________________________________________</p>
						<p class="mb-0 text-uppercase"><b>Fecha:</b>____________________________________________________</p>
						<br>
						<p class="mb-0">Constancia de recepción de la presente Orden de Inspección. Los datos de identificación de la persona que recibe deberán quedar asentados en el Acta de Inspección que se realizará.</p>
					</div>
				</td>
			</tr>
		</table>

		
		
	</div>
		
	<div class="page_break"></div>
	@endforeach




	


	
</body>
</html>