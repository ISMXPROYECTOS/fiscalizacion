<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>GAFETE</title>
	<link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.css') }}" />
	<!-- <link rel="stylesheet" href="{{ asset('css/gafete.css') }}" /> -->
	<style>
		body{
			font-family: Arial, Helvetica, sans-serif !important;
		}

	</style>
</head>
<body style="background-image: url({{ asset('img/pattern.png') }});">
	<img src="{{ asset('img/header-gafete.png') }}" width="100%">
	<div class="container text-center">


		<div class="img-container">
			<img src="{{ asset('img/inspectores/'. $gafete->imageninspector) }}" width="21%" class="mt-3">
		</div>

		@if(is_object($gafete->inspector))
			<h6><b>{{ $gafete->inspector->nombre }} {{ $gafete->inspector->apellidopaterno }} {{ $gafete->inspector->apellidomaterno }}</b></h6>
		@endif

		<h6>Fiscal</h6>

		<table style="width: 100%;">
			<tr>
				<td>
					<img src="{{ asset('img/qrs/'.$gafete->codigoqr.'.png') }}" style="width: 100px;">
					<p class="em-6">Verifica con tu celular</p>
				</td>
				<td>
					@if(is_object($gafete->inspector))
						<h6 class="text-center">CLAVE: <b>{{ $gafete->inspector->clave }}</b></h6>
					@endif
					<h6 class=" text-center">Expedido: {{ date('j/m/Y', strtotime($gafete->created_at)) }} </h6>
					<h6 class=" text-center">Vigencia: {{ date('j/m/Y', strtotime($gafete->vigencia)) }} </h6>
				</td>
			</tr>
		</table>
	</div>	
	<img src="{{ asset('img/footer-gafete.jpg') }}" width="100%" >
</body>
</html>