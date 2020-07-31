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
			}
			.page_break{
				page-break-after: always;
			}
		</style>
	</head>
	<body>
		@foreach($formavalorada->inspeccion as $inspeccion)
		<img src="{{ asset('img/header-orden-inspeccion.jpg') }}" width="100%" class="mb-3">
		<h5 class="text-right mb-3">FOLIO: {{ $inspeccion->folio }}</h5>
		@if($inspeccion->comercio == null)
		<p class="mb-0 mt-0"><b>NOMBRE DEL CONTRIBUYENTE: </b>___________________</p>
		<p class="mb-0 mt-0"><b>NOMBRE COMERCIAL DEL ESTABLECIMIENTO: </b>_______________________________________________________</p>
		<p class="mb-0 mt-0"><b>DOMICILIO DEL ESTABLECIMIENTO: </b>_____________________________________________</p>
		<p class="mb-0 mt-0"><b>NÚMERO DE PADRÓN MUNICIPAL: </b>__________________________________________________________</p>
		@else
		<p class="mb-0 mt-0"><b>NOMBRE DEL CONTRIBUYENTE: </b>{{ $inspeccion->comercio->propietarionombre }}</p>
		<p class="mb-0 mt-0"><b>NOMBRE COMERCIAL DEL ESTABLECIMIENTO: </b>{{ $inspeccion->comercio->nombreestablecimiento }}</p>
		<p class="mb-0 mt-0"><b>DOMICILIO DEL ESTABLECIMIENTO: </b>{{ $inspeccion->comercio->domiciliofiscal }}</p>
		<p class="mb-0 mt-0"><b>NÚMERO DE PADRÓN MUNICIPAL: </b></p>
		@endif
		

		<div class="page_break"></div>
		@endforeach
	</body>
</html>