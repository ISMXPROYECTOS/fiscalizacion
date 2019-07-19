<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.css') }}" />
	<style>
		*{
			margin:0;
			padding:0
		}

		.qr{
			width: 100px;
		}

		.qr-vigencia{
			width: 100%;
		}

		.text-left{
			text-align: left !important;
		}

		.em-8{
			font-size: .8em;
			
		}

		.em-6{
			font-size: .6em
		}

	</style>
</head>
<body>

	<div class="container text-center">

		
		<img src="{{ asset('img/header-gafete.jpg') }}" width="100%" class="mb-4">

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
					<h6 class="em-8 text-left">Expedido: {{ date('j/m/Y', strtotime($gafete->created_at)) }} </h6>
					<h6 class="em-8 text-left">Vigencia: {{ date('j/m/Y', strtotime($gafete->vigencia)) }} </h6>
				</td>
			</tr>
		</table>

		<img src="{{ asset('img/footer-gafete.jpg') }}" width="100%">

	</div>

	
	
</body>
</html>