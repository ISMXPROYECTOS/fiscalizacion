@extends('layouts.app')
@section('content')
<header class="page-header">
	<h2>Agregar Inspecciones Por Zona</h2>
</header>

<div class="row">
	<div class="col-md-4">
		<h4 >Folio inicio: <b id="folio-inicio"></b></h4>
	</div>
	<div class="col-md-4">
		<h4 >Folio fin: <b id="folio-fin"></b></h4>
	</div>
</div>
<hr>
<form method="POST" action="{{ route('crear-inspeccion-por-sm') }}" id="formulario-crear-inspeccion-por-sm">
	@csrf
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<label>Tipo de Inspección</label>
				<select name="tipoinspeccion" class="form-control" id="tipoinspeccion">
					<option value="">Seleccionar</option>
					@foreach($tiposInspecciones as $tipoInspeccion)
					<option value="{{ $tipoInspeccion->id}}">{{ $tipoInspeccion->nombre }}</option>
					@endforeach
				</select>
				<p class="text-danger mb-0">{{ $errors->first('tipoinspeccion') }}</p>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label>Ejercicio Fiscal</label>
				<select name="ejerciciofiscal" class="form-control" id="ejerciciofiscal" >
					<option value="">Seleccionar</option>
					@foreach($ejerciciosFiscales as $ejercicioFiscal)
					@if($ejercicioFiscal->activo == 1)
					<option value="{{ $ejercicioFiscal->id}}">{{ $ejercicioFiscal->anio }}</option>
					@endif
					@endforeach
				</select>
				<p class="text-danger mb-0">{{ $errors->first('ejerciciofiscal') }}</p>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label>Encargado</label>
				<select name="encargadoGob" class="form-control" id="encargadoGob">
					<option value="">Seleccionar</option>
					@foreach($encargadosGob as $encargadoGob)
					@if($encargadoGob->activo == 1)
					<option value="{{ $encargadoGob->id}}">{{ $encargadoGob->nombre }} {{ $encargadoGob->apellidopaterno }} {{ $encargadoGob->apellidomaterno }} </option>
					@endif
					@endforeach
				</select>
				<p class="text-danger mb-0">{{ $errors->first('encargadoGob') }}</p>   
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label>Buscar por Supermanzana</label>
				<div class="input-group">
					<input type="text" class="form-control" name="calle" id="calle" placeholder="ej. SM-095">
					<div class="input-group-append">
						<button class="btn btn-outline-secondary" type="button" id="buscar-sm">Buscar</button>
					</div>
				</div>
				<p class="text-danger mb-0" id="error-sm">{{ $errors->first('calle') }}</p>
			</div>
		</div>
	</div>
	<div id="comercios" class="hidden mt-3">
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label>Buscar por:</label>
					<select name="buscar-por" class="form-control" id="buscar-por">
						<option value="0">Seleccionar</option>
						<option value="1">Nombre Comercial</option>
						<option value="2">Razón Social</option>
						<option value="3">Giro comercial</option>
					</select>
				</div>
			</div>
			<div class="col-md-3" id="filtro-palabras">
				<div class="form-group">
					<label>Ingresar </label>
					<div class="input-group">
						<input type="text" class="form-control" name="valor" id="valor" >
						
					</div>
					<p class="text-danger mb-0" id="error-sm">{{ $errors->first('valor') }}</p>
				</div>
			</div>
			<div class="col-md-3" id="filtro-select">
				<div class="form-group">
					<label>Seleccionar Giro </label>
					<div class="input-group">
						<select name="giros" id="giros" class="form-control">
							<option value="0">Seleccionar</option>
							@foreach($giros as $giro)
								<option value="{{ $giro->id}}">{{ $giro->nombre }}</option>
							@endforeach
						</select>
					</div>
					<p class="text-danger mb-0" id="error-sm">{{ $errors->first('valor') }}</p>
				</div>
			</div>
			<div class="input-group-append">
				<button class="btn btn-outline-secondary" type="button" id="buscar-valor">Aplicar filtro</button>
			</div>
		</div><br>

		<p class="text-danger mb-0" id="error-comercios"></p>
		<p class=" mb-0" id="error-results"></p>
		<br>
		<table class="table table-sm" id="tabla-comercios">
			<thead class="thead-dark">
				<tr>
					<th>
						<div class="form-check">
						  <input class="form-check-input" type="checkbox" id="seleccionar-todos">
					  </div>
					</th>
					<th>RAZÓN SOCIAL</th>
					<th>NOMBRE COMERCIAL</th>
					<th>UBICACIÓN</th>
					<th>GIRO</th>
					<th>LICENCIA DE FUNCIONAMIENTO</th>
			  </tr>
		  </thead>
		  <tbody id="tbody-comercios"></tbody>
	  </table>
  </div>
  <br>
  <div class="form-group row mb-0">
	<div class="col-md-4">
		<button type="submit" class="btn btn-primary btn-block btn-primary-custom" id="btn-enviar">{{ __('Crear Inspecciones') }}</button>
	</div>
</div>
</form>
@endsection

@if (session('status'))
	<!-- Alerta de creacion correcta -->
	<div class="modal fade" id="creacion-inspecciones-correcta" tabindex="-1" role="dialog" aria-labelledby="modal-creacion-inspecciones-correcta" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="modal-creacion-inspecciones-correcta">Creación Exitosa</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="modal-wrapper">
						<div class="modal-icon">
							<i class="fas fa-check"></i>
						</div>
						<div class="modal-text">
							<h4>Creación Exitosa</h4>
							<p>{{ session('status') }}</p>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>
@endif

@section('scripts')
<script>
	$('#creacion-inspecciones-correcta').modal('show')
</script>
<script src="{{ asset('js/agregar-inspeccion-por-sm.js') }}" defer></script>
@endsection