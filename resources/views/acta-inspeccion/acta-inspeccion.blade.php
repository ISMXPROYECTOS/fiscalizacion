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
		<h6 class="float-right">FOLIO No: <b>{{ $inspeccion->folio }}</b></h6><br><br><br>
		<p class="mb-1"><b>Nombre del Contribuyente:</b> ________________________________________________________________________________________________</p>
		<p class="mb-1"><b>Nombre comercial del establecimiento:</b> ___________________________________________________________________________________</p>
		<p class="mb-1"><b>Domicilio del establecimiento:</b> _____________________________________________________________________________________________</p>
		<p class="mb-1"><b>Giro:</b> ________________________________________________________________________________________________________________________</p>
		<p class="mb-2"><b>Número de padron municipal:</b> _______________________________________________________________________________________________</p>
		<p class="text-justify">Esta Dirección de Fiscalización dependiente de la Tesorería Municipal del Ayuntamiento de Benito Juárez, Quintana Roo, con fundamento en los Articulos 16 y 115, fracción V, inciso f, de la Contitución Política de los Estado Unidos Mexicanos; 1, 2, 3, 4, 126, 127 y 128, fracción VI, de la Constitución Política del Estado Libre y Soberano de Quintana Roo</b></p>
	</div>
		
	<div class="page_break"></div>
	@endforeach




	


	
</body>
</html>