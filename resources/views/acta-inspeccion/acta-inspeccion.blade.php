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
		<p class="mb-2"><b>Contribuyente:</b> C. Propietario, poseedor, posesionario y/o representante legal __________________________________________</p>
		<p>______________________________________________________________________________________________________________________________</p>
		<p class="mb-2"><b>Nombre comercial:</b> _________________________________________________________________________________________________________</p>
		<p class="mb-2"><b>Domicilio:</b> ___________________________________________________________________________________________________________________</p>
		<p class="text-justify">Municipio de Benito Juárez, Quintana Roo. Siendo las ________ horas del dia ____ del mes de ____________ del presente año. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse tristique, magna vel ultricies eleifend, sapien augue vestibulum nulla, nec sollicitudin enim nisl sit amet ante. <b>Phasellus ac neque at enim ultricies varius quis at turpis. Etiam et tortor posuere, ornare orci et, congue velit. Proin id magna vel lorem convallis vulputate vitae quis neque. Donec ut luctus leo, eu ultrices mi.</b> Aliquam id ipsum tellus. Duis volutpat turpis eget placerat condimentum. Donec non arcu metus. Nulla eget elementum arcu, in faucibus leo. Curabitur vulputate euismod aliquam. Fusce accumsan diam a erat blandit, nec interdum nibh commodo. Nulla ac finibus dui. Sed faucibus et justo quis dapibus. Quisque malesuada nisi a arcu egestas lacinia. Pellentesque viverra et lacus nec dictum. <b>In vel purus mi. Nunc nec porttitor odio, ac pellentesque nisi. Pellentesque feugiat suscipit lacus, eget scelerisque ligula auctor nec. Nulla nunc quam, rutrum in rutrum et, ornare et felis. Sed fermentum lacus nec sapien vehicula hendrerit. Duis ut orci consectetur, consequat ex sed, imperdiet urna. Phasellus ut eleifend dolor, vitae tincidunt nisl. Curabitur ornare, ligula id hendrerit lacinia, metus nisl interdum nibh, eget tristique augue sem ac nisi. Ut in tristique velit. Vivamus a urna ipsum. In euismod, odio a condimentum rhoncus, libero erat facilisis massa, nec scelerisque ipsum ligula ac ligula. Nulla et tempus libero. Sed vehicula risus ac molestie commodo. Cras in tortor dictum, rutrum risus et, euismod turpis. Etiam non nisi eget est porta finibus.</b></p>
	</div>
		
	<div class="page_break"></div>
	@endforeach




	


	
</body>
</html>