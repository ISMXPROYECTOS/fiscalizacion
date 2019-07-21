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
		{{ $inspeccion->folio }}
		<img src="{{ asset('img/header-acta-inspeccion.png') }}" width="100%" class="mb-2">
		<div class="container">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore ipsam ratione velit eveniet debitis inventore alias voluptatibus facere maiores fuga sint tempore aliquid fugiat voluptatum quam molestias accusantium, doloremque dolorum.</p>
		</div>
		<div class="page_break"></div>
	@endforeach




	


	
</body>
</html>