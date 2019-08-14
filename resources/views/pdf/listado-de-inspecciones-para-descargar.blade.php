@extends('layouts.app')
@section('content')
<header class="page-header">
	<h2>Descargar Inspecciones</h2>
</header>
<div class="row">
	<div class="col">
		<table class="table table-responsive-lg table-bordered table-striped mb-0" id="datatable">
			<thead>
				<tr>
					<th>Folio Inicio</th>
					<th>Folio Fin</th>
					<th>Descargar PDF</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>

@endsection
@section('scripts')
<script src="{{ asset('js/descarga-de-inspecciones.js') }}" defer></script>
@endsection