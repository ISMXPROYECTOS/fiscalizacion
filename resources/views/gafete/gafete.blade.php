<!DOCTYPE html>
<html lang="en" style="margin: 0px">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Gafete Inspector</title>
		<link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
	</head>
	<body>		
			<img src="{{ asset('img/header-gafete.jpg') }}" alt="" class="mb-2">
	
			<table >
			  <tr>
			    <td style="width: 33%"> </td>
			    <td style="width: 33%">
			    	<div class="div-imagen-inspector">
						<img src="{{ asset('img/inspectores/'. $gafete->imageninspector) }}" alt="" class="img-inspector"></td>
					</div>
			    </td>
			    <td style="width: 33%"> </td>
			  </tr>
			</table>

			@if(is_object($gafete->inspector))
			<h6><b>{{ $gafete->inspector->nombre }} {{ $gafete->inspector->apellidopaterno }} {{ $gafete->inspector->apellidomaterno }}</b></h6>
			@endif
			<h6>Inspector</h6>

			<table >
			  <tr>
			    <td>Aqui ira QR</td>
			    <td>
			    	<h6>Expedido: {{ $gafete->vigencia }} </h6>
					<h6>Vigencia: {{ $gafete->vigencia }} </h6>
			    </td>
			  </tr>
			</table>
			
			<h6>@if(is_object($gafete->inspector)) Estatus: {{ $gafete->inspector->estatus }} @endif</h6>
			
	
	</body>
</html>