<?php

set_time_limit(0);
ini_set("memory_limit",-1);
ini_set('max_execution_time', 0);

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>INSPECCION 2019-2021</title>
		<link rel="stylesheet" href="{{ asset('css/citatorio.css') }}" />
	</head>
	<body>
		<img src="{{ asset('img/header-citatorio.jpg') }}" width="100%">
		<div class="container mt-5">
			@if($inspeccion->comercio == null)
				<p class="ci-header-datos mbt-0"><b>NOMBRE DEL CONTRIBUYENTE: </b>_______________________________________________________________________________________</p>
				<p class="ci-header-datos mbt-0"><b>DOMICILIO DEL ESTABLECIMIENTO: </b>____________________________________________________________________________________</p>
				<p class="ci-header-datos mbt-0"><b>NOMBRE COMERCIAL DEL ESTABLECIMIENTO: </b>__________________________________________________________________________</p>
				<p class="ci-header-datos mbt-0"><b>NO. ORDEN DE INSPECCIÓN: </b>__________________________________________________________________________________________</p>
			@else
				<p class="ci-header-datos mbt-0"><b>NOMBRE DEL CONTRIBUYENTE: </b>{{ $inspeccion->comercio->propietarionombre }}</p>
				<p class="ci-header-datos mbt-0"><b>DOMICILIO DEL ESTABLECIMIENTO: </b>{{ $inspeccion->comercio->domiciliofiscal }}</p>
				<p class="ci-header-datos mbt-0"><b>NOMBRE COMERCIAL DEL ESTABLECIMIENTO: </b>{{ $inspeccion->comercio->nombreestablecimiento }}</p>
				<p class="ci-header-datos mbt-0"><b>NO. ORDEN DE INSPECCIÓN:</b> {{ $inspeccion->folio }}</p>
			@endif
			<p class="ci-contenido-general">En la ciudad de Cancún, Quintrana Roo, siendo las _____ horas del @if($inspeccion->comercio == null) día ____ del mes de __________________ del año _________, @else {{ $fecha_hoy }}, @endif el @if($inspeccion->inspector == null) C._________________________________________, @else <b>C. {{ $inspeccion->inspector->nombre }} {{ $inspeccion->inspector->apellidopaterno }} {{ $inspeccion->inspector->apellidomaterno }},</b> @endif en mi carácter de inspector, notificador-ejecutor, identificándome con Credencial número ____________, de fecha ________________, vigente hasta el __________________________, expedido por el Tesorero Municipal del Municipio de Benito Juárez, Q. Roo, con fundamento en lo dispuesto en el artículo 11 fracción XI del Reglamento Interior de la Tesorería del Municipio de Benito Juárez, Quintana Roo, mismo que tuvo a la vista y devuelve al identificado la persona con quien se entiende la diligencia, me constituí en el domicilio ubicado en @if(is_object($inspeccion->comercio)) {{ $inspeccion->comercio->domiciliofiscal }} {{ $inspeccion->comercio->cp }} @else ________________________________________________ @endif cerciorándome por medio de ____________________________________________________ que es el domicilio de la persona buscada, procedo en este acto a requerir la presencia de la persona citada al rubro o su representante legal, presentándose una persona quien dice llamarse _____________________________________________________ en su carácter de ___________________________________________________, quien se identifica con ____________________________________________________, manifestando que la persona buscada no se encuentra, por lo que con fundamento en los artículos 44 fracción II, primer párrafo y  111  del Código Fiscal Municipal del Estado de Quintana Roo, y en virtud de que ni la persona buscada, ni su representante se encontraban en el domicilio, se procede a dejar en poder de la persona que atiende la diligencia <b>citatorio</b>, para el efecto de que la persona interesada o su representante legal esperen la autoridad fiscal en su domicilio a las _____ horas con _____ minutos del día ___________________________, con finalidad de recibir la <b>Orden de Inspección con número folio: {{ $inspeccion->folio }}</b>, de fecha _____________________________, constante de <b>______ foja(s)</b>, emitido por el Director de Fiscalización del Municipio de Benito Juárez, Quintana Roo, con el apercibimiento de que para el caso de no atender dicho citatorio, con fundamento en el artículo 44 fracción II, segundo párrafo del Código Fiscal Municipal del Estado de Quintana Roo, la visita se iniciará con quien se encuentre en el lugar visitado, para lo cual firma al calce, comprometiéndose a entregar el presente citatorio a la persona indicada, cerrándose la presente a las _____ horas con ______ minutos del día en que se actúa.</p>
			<br>
			<table class="firma-citatorio">
			  <tr>
			    <td class="ci-citatorio-recibe text-center">
			    	<b>RECIBE</b>
			    	<p class="mbt-0">_________________________________</p>
			    	<p class="mbt-0"><b>NOMBRE Y FIRMA</b></p>
			    </td>
			    <td class="ci-citatorio-inspector text-center">
			    	<b>INSPECTOR, NOTIFICADOR-EJECUTOR</b>
			    	<p class="mbt-0">_________________________________</p>
			    	<p class="mbt-0"><b>NOMBRE Y FIRMA</b></p>
			    </td>
			  </tr>
			</table>
		</div>
	</body>
</html>