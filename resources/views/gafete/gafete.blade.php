<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Gafete Inspector</title>
		<link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
	</head>
	<body>
		<div class="gafete">
			<img src="{{ asset('img/header-gafete.jpg') }}" alt="" class="mb-4">
			<table>
				<tr>
					<th><img src="{{ asset('img/inspectores/'. $gafete->imageninspector) }}" alt="" class="img-inspector ml-2 mt-3"></th>
					<th><h6><b>Inspector</b></h6>
					@if(is_object($gafete->inspector))
					<h6>{{ $gafete->inspector->nombre }}</h6>
					<h6>{{ $gafete->inspector->apellidopaterno }} {{ $gafete->inspector->apellidomaterno }}</h6>
					@endif
					<hr>
					
					<h6>Vencimiento: {{ $gafete->vigencia }} @if(is_object($gafete->inspector)) Estatus: {{ $gafete->inspector->estatus }} @endif</h6></th>
					<th><img src="{{ asset('img/qrs/'.$gafete->codigoqr.'.png') }}" alt="" class="qr mt-4 mr-2"></th>
				</tr>
			</table>
		</div>
	</body>
</html>