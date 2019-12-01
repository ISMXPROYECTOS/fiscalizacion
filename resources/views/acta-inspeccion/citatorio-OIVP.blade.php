<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>INSPECCION 2019-2021</title>
		<link rel="stylesheet" href="{{ asset('css/acta-inspeccion-oivp.css') }}" />
	</head>
	<body>
		@foreach($inspecciones as $inspeccion)
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
		@endforeach
	</body>
</html>