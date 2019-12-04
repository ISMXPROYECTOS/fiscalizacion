<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>INSPECCION 2019-2021</title>
		<link rel="stylesheet" href="{{ asset('css/acta-inspeccion-oivp.css') }}" />
	</head>
	<body>
		@foreach($inspecciones as $inspeccion)
		<img src="{{ asset('img/header-orden-inspeccion.jpg') }}" width="100%">
		<div class="container">
			@if($inspeccion->comercio == null)
				<p class="oi-header-datos mbt-0"><b>NOMBRE DEL CONTRIBUYENTE: </b>________________________________________________________________________________________________</p>
				<p class="oi-header-datos mbt-0"><b>DOMICILIO DEL ESTABLECIMIENTO: </b>_____________________________________________________________________________________________</p>
				<p class="oi-header-datos mbt-0"><b>NOMBRE COMERCIAL DEL ESTABLECIMIENTO: </b>___________________________________________________________________________________</p>
				<p class="oi-header-datos mbt-0"><b>NO. ORDEN DE INSPECCIÓN: </b>______________________________________________________________________________________________</p>
			@else
				<p class="oi-header-datos mbt-0"><b>NOMBRE DEL CONTRIBUYENTE: </b>{{ $inspeccion->comercio->propietarionombre }}</p>
				<p class="oi-header-datos mbt-0"><b>DOMICILIO DEL ESTABLECIMIENTO: </b>{{ $inspeccion->comercio->domiciliofiscal }}</p>
				<p class="oi-header-datos mbt-0"><b>NOMBRE COMERCIAL DEL ESTABLECIMIENTO: </b>{{ $inspeccion->comercio->nombreestablecimiento }}</p>
				<p class="oi-header-datos mbt-0"><b>NO. ORDEN DE INSPECCIÓN:</b> {{ $inspeccion->folio }}</p>
			@endif
			
			<p class="c-contenido-general">En la ciudad de Cancún, Quintrana Roo, siendo las _____ horas del día ____, del mes de _______________________________ del año _______________, el C. __________________________________________________ en mi carácter de inspector, notificador-ejecutor, identificándome con Credencial número ____________, de fecha ________________, vigente hasta el _____________________________________, expedido por el Tesorero Municipal del Municipio de Benito Juárez, Q. Roo, con fundamento en lo dispuesto en el artículo 11 fracción XI del Reglamento Interior de la Tesorería del Municipio de Benito Juárez, Quintana Roo, mismo que tuvo a la vista y devuelve al identificado la persona con quien se entiende la diligencia, me constituí en el domicilio ubicado en @if(is_object($inspeccion->comercio)) {{ $inspeccion->comercio->domiciliofiscal }} {{ $inspeccion->comercio->cp }} @else ________________________________________________ @endif cerciorándome por medio de ______________________________________________________________________________________ que es el domicilio de la persona buscada, procedo en este acto a requerir la presencia de la persona citada al rubro o su representante legal, presentándose una persona quien dice llamarse ________________________________________________________________ en su carácter de _______________________________________________________, quien se identifica con ____________________________________________________, manifestando que la persona buscada no se encuentra, por lo que con fundamento en los artículos 44 fracción II, primer párrafo y  111  del Código Fiscal Municipal del Estado de Quintana Roo, y en virtud de que ni la persona buscada, ni su representante se encontraban en el domicilio, se procede a dejar en poder de la persona que atiende la diligencia <b>citatorio</b>, para el efecto de que la persona interesada o su representante legal esperen la autoridad fiscal en su domicilio a las ____________ horas con ___________ minutos del día ___________________________, con finalidad de recibir la <b>orden de inspección con número folio: {{ $inspeccion->folio }}</b>, de fecha _____________________________, constante de <b>una foja</b>, emitido por el Director de Fiscalización del Municipio de Benito Juárez, Quintana Roo, con el apercibimiento de que para el caso de no atender dicho citatorio, con fundamento en el artículo 44 fracción II, segundo párrafo del Código Fiscal Municipal del Estado de Quintana Roo, la visita se iniciará con quien se encuentre en el lugar visitado, para lo cual firma al calce, comprometiéndose a entregar el presente citatorio a la persona indicada, cerrándose la presente a las _______ horas con _________ minutos del día en que se actúa.</p>

			<table style="width:100%">
			  <tr>
			    <td>
			    	RECIBE
			    	<p>_________________________________</p>
			    	<p>NOMBRE Y FIRMA</p>
			    </td>
			    <td>
			    	INSPECTOR, NOTIFICADOR-EJECUTOR
			    	<p>_________________________________</p>
			    	<p>NOMBRE Y FIRMA</p>
			    </td>
			  </tr>
			</table>

		</div>
		@endforeach
	</body>
</html>