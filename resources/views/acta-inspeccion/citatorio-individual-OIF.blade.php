<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>CITATORIO 2019-2021</title>
		<link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.css') }}" />
		<style>
			body{
				font-family: Arial, Helvetica, sans-serif !important;
				max-width: 98%;
				display:block;
				margin:auto;
			}
			.page_break{
				page-break-after: always;
			}
		</style>
	</head>
	<body>
		
		<img src="{{ asset('img/header-citatorio.jpg') }}" width="100%" class="mb-5">

		@if($inspeccion->comercio == null)
			<p class="mb-0 mt-0"><b>NOMBRE DEL CONTRIBUYENTE: </b>_______________________________________________________________________</p>
			<p class="mb-0 mt-0"><b>DOMICILIO DEL ESTABLECIMIENTO: </b>____________________________________________________________________</p>
			<p class="mb-0 mt-0"><b>NOMBRE COMERCIAL DEL ESTABLECIMIENTO: </b>__________________________________________________________</p>
			<p class="mb-3 mt-0"><b>NO. ORDEN DE INSPECCIÓN: </b>__________________________________________________________________________</p>
		@else
			<p class="mb-0 mt-0"><b>NOMBRE DEL CONTRIBUYENTE: </b>{{ $inspeccion->comercio->propietarionombre }}</p>
			<p class="mb-0 mt-0"><b>DOMICILIO DEL ESTABLECIMIENTO: </b>{{ $inspeccion->comercio->domiciliofiscal }}</p>
			<p class="mb-0 mt-0"><b>NOMBRE COMERCIAL DEL ESTABLECIMIENTO: </b>{{ $inspeccion->comercio->nombreestablecimiento }}</p>
			<p class="mb-3 mt-0"><b>NO. ORDEN DE INSPECCIÓN:</b> {{ $inspeccion->folio }}</p>
		@endif
		<p class="text-justify mb-5" style="font-size:.90em;">En la ciudad de Cancún, Quintrana Roo, siendo las ______ horas del @if($inspeccion->comercio == null) día ____ del mes de __________________ del año _________, @else {{ $fecha_hoy }}, @endif el @if($inspeccion->inspector == null) C._________________________________________, @else <b>C. {{ $inspeccion->inspector->nombre }} {{ $inspeccion->inspector->apellidopaterno }} {{ $inspeccion->inspector->apellidomaterno }},</b> @endif en mi carácter de inspector, notificador-ejecutor, identificándome con Credencial número ____________, de fecha ________________, vigente hasta el __________________________, expedido por el Tesorero Municipal del Municipio de Benito Juárez, Q. Roo, con fundamento en lo dispuesto en el artículo 11 fracción XI del Reglamento Interior de la Tesorería del Municipio de Benito Juárez, Quintana Roo, mismo que tuvo a la vista y devuelve al identificado la persona con quien se entiende la diligencia, me constituí en el domicilio ubicado en @if(is_object($inspeccion->comercio)) {{ $inspeccion->comercio->domiciliofiscal }} {{ $inspeccion->comercio->cp }} @else ________________________________________________ @endif cerciorándome por medio de ____________________________________________________ que es el domicilio de la persona buscada, procedo en este acto a requerir la presencia de la persona citada al rubro o su representante legal, presentándose una persona quien dice llamarse _____________________________________________________ en su carácter de ___________________________________________________, quien se identifica con ____________________________________________________, manifestando que la persona buscada no se encuentra, por lo que con fundamento en los artículos 44 fracción II, primer párrafo y 111 del Código Fiscal Municipal del Estado de Quintana Roo, y en virtud de que ni la persona buscada, ni su representante se encontraban en el domicilio, se procede a dejar en poder de la persona que atiende la diligencia <b>citatorio</b>, para el efecto de que la persona interesada o su representante legal esperen la autoridad fiscal en su domicilio a las _____ horas con _____ minutos del día ___________________________, con finalidad de recibir la <b>Orden de Inspección con número folio: {{ $inspeccion->folio }}</b>, de fecha _____________________________, constante de <b>______ foja(s)</b>, emitido por el Director de Fiscalización del Municipio de Benito Juárez, Quintana Roo, con el apercibimiento de que para el caso de no atender dicho citatorio, con fundamento en el artículo 44 fracción II, segundo párrafo del Código Fiscal Municipal del Estado de Quintana Roo, la visita se iniciará con quien se encuentre en el lugar visitado, para lo cual firma al calce, comprometiéndose a entregar el presente citatorio a la persona indicada, cerrándose la presente a las _____ horas con ______ minutos del día en que se actúa.</p>
		<table class="text-uppercase" style="width: 100%;">
			<tr>
			<td class="text-center" style="width: 50%;">
				<b>RECIBE</b>
				<p>_________________________________</p>
				<p><b>NOMBRE Y FIRMA</b></p>
			</td>
			<td class="text-center" style="width: 50%;">
				<b>INSPECTOR, NOTIFICADOR-EJECUTOR</b>
				<p>_________________________________</p>
				<p><b>NOMBRE Y FIRMA</b></p>
			</td>
			</tr>
		</table>
	</body>
</html>