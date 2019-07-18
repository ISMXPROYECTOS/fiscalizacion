<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Gafete Inspector</title>

	<link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.css') }}" />

	<style>
		.gafete{
			background-color: white;
			box-shadow: 3px 10px 60px;
			width: 425px;
			height: 283px;
		}

		.qr{
			width: 90%;
			box-shadow: 1px 2px 3px 0px;
		}

	</style>
</head>
<body>

	<div class="gafete">
		<img src="{{ asset('img/header-gafete.jpg') }}" alt="" class="mb-4">

		<div class="row">
			<div class="col-md-3">
				<img src="{{ asset('img/inspectores/'. $gafete->imageninspector) }}" alt="" class="ml-2">
			</div>
			<div class="col-md-6">

				<h6><b>Inspector</b></h6>
				@if(is_object($gafete->inspector))
					<h6>{{ $gafete->inspector->nombre }}</h6>
					<h6>{{ $gafete->inspector->apellidopaterno }} {{ $gafete->inspector->apellidomaterno }}</h6>
				@endif

				<hr>
				
				<h6>Vencimiento: {{ $gafete->vigencia }} @if(is_object($gafete->inspector)) Estatus: {{ $gafete->inspector }} @endif</h6>
				
			</div>
			<div class="col-md-3">
				<!--<img src='{{ asset("img/qrs/.png") }}' alt="" class="qr mt-4">-->
			</div>
		</div>
		

	</div>
	
</body>
</html>