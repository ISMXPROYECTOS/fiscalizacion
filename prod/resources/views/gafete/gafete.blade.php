<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.css') }}" />
	<link rel="stylesheet" href="{{ asset('css/gafete.css') }}" />
	
</head>
<body>
	<img src="{{ asset('img/header-gafete.png') }}" width="100%">
	<div class="container text-center">


		<div class="img-container">
			<img src="{{ asset('img/inspectores/'. $gafete->imageninspector) }}" alt="" class="img-inspector mt-3 ">
		</div>

		@if(is_object($gafete->inspector))
			<h6><b>{{ $gafete->inspector->nombre }} {{ $gafete->inspector->apellidopaterno }} {{ $gafete->inspector->apellidomaterno }}</b></h6>
		@endif

		<h6>Fiscal</h6>

		<table class="qr-vigencia">
			<tr>
				<td>
					<img src="{{ asset('img/qrs/'.$gafete->codigoqr.'.png') }}" alt="" class="qr mt-3">
					<p class="em-6">Verifica con tu celular</p>
				</td>
				<td>
					@if(is_object($gafete->inspector))
						<h6 class="text-left">CLAVE: <b>{{ $gafete->inspector->clave }}</b></h6>
					@endif
					<h6 class="em-8 text-left">Expedido: {{ date('j/m/Y', strtotime($gafete->created_at)) }} </h6>
					<h6 class="em-8 text-left">Vigencia: {{ date('j/m/Y', strtotime($gafete->vigencia)) }} </h6>
				</td>
			</tr>
		</table>
	</div>	
	<img src="{{ asset('img/footer-gafete.jpg') }}" width="100%" class="footer-img">
</body>
</html>