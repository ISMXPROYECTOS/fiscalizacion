@extends('layouts.app')
@section('content')
<header class="page-header">
	<h2>Folio de Inspección: {{ $inspeccion->folio }}</h2>
</header>

@if ($errors->any())
<p>{{ $errors }}</p>
@endif

@if (session('status'))
<div class="alert alert-success">
	{{ session('status') }}
</div>
@endif

<div class="card">
	<div class="card-body">
		<h3>Estado de la Inspección</h3>
		<div>
			<label for="">Estatus: </label>
			<label for=""> <span class="badge badge-pill badge-secondary">{{ $inspeccion->estatusInspeccion->nombre }}</span></label>
		</div>
	</div>
</div>

<form method="POST" action="{{ route('actualizar-informacion-inspeccion') }}">
	@csrf
	<input type="hidden" name="inspeccion-id" value="{{ $inspeccion->id }}">
	<div class="card">
		<div class="card-body">
			<h3>Datos del Comercio</h3>
			<hr>
			@if(is_object($inspeccion->comercio))
			<input type="hidden" name="establecimiento" value="{{ $inspeccion->comercio->id }}">
			<div class="form-group">
				<label for="nombrelocal">{{ __('Nombre Establecimiento') }}</label>
				<input id="nombrelocal" type="text" name="nombrelocal" class="form-control" value="{{ $inspeccion->comercio->nombreestablecimiento }}" required autofocus>
			</div>
			<div class="row mb-3">
				<div class="col-lg-6">
					<div class="form-group">
						<label for="domicilio">{{ __('Domicilio') }}</label>
						<input id="domicilio" type="text" name="domicilio" class="form-control" value="{{ $inspeccion->comercio->domiciliofiscal }}" required autofocus>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label for="clavecatastral">{{ __('Clave catastral') }}</label>
						<input id="clavecatastral" type="number" name="clavecatastral" class="form-control" value="{{ $inspeccion->comercio->clavecatastral }}" required autofocus>
					</div>
				</div>
			</div>
			@else
			<div class="form-group">
				<label for="establecimiento">{{ __('Establecimiento') }}</label>
				<select name="establecimiento" id="establecimiento" class="form-control{{ $errors->has('establecimiento') ? ' is-invalid' : '' }}" value="{{ old('establecimiento') }}" required>
					<option value="">Seleccionar</option>
					@foreach($comercios as $comercio)
					<option value="{{ $comercio->id }}">{{ $comercio->nombreestablecimiento }}</option>
					@endforeach
				</select>
				@if ($errors->has('establecimiento'))
				<span class="invalid-feedback" role="alert">
					<strong>{{ $errors->first('establecimiento') }}</strong>
				</span>
				@endif
			</div>
			@endif
			@if ($is_edit == 'true')
			<div class="form-group ">
				<label for="encargado">{{ __('Nombre del encargado') }}</label>
				<input id="encargado" type="text" class="form-control" name="encargado" value="{{ $inspeccion->nombreencargado }}" autofocus>
			</div>
			<div class="row mb-3">
				<div class="col-lg-4">
					<div class="form-group ">
						<label for="cargo">{{ __('Puesto del encargado') }}</label>
						<input id="cargo" type="text" class="form-control" name="cargo" value="{{ $inspeccion->cargoencargado }}" autofocus>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group ">
						<label for="identificacion">{{ __('Identificación del encargado') }}</label>
						<input id="identificacion" type="text" class="form-control" name="identificacion" value="{{ $inspeccion->identificacion }}" autofocus>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group ">
						<label for="folioidentificacion">{{ __('Folio de Identificación del encargado') }}</label>
						<input id="folioidentificacion" type="text" class="form-control" name="folioidentificacion" value="{{ $inspeccion->folioidentificacion }}" autofocus>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group ">
						<label for="fecharealizada">{{ __('Fecha en que se realizó la inspección') }}</label>
						<input id="fecharealizada" type="date" class="form-control" name="fecha" value="{{ $inspeccion->fecharealizada }}" required autofocus>
						
						@if ($errors->has('hora'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('hora') }}</strong>
						</span>
						@endif
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group ">
						<label for="horarealizada">{{ __('Hora en que se realizó la inspección') }}</label>
						<input id="horarealizada" type="time" class="form-control" name="hora" value="{{ date('H:i', strtotime($inspeccion->horarealizada)) }}" required autofocus>
						@if ($errors->has('hora'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('hora') }}</strong>
						</span>
						@endif
					</div>
				</div>
			</div>
			@else
			<div class="form-group ">
				<label for="encargado">{{ __('Nombre del encargado') }}</label>
				<input id="encargado" type="text" class="form-control" name="encargado" value="{{ old('encargado') }}" autofocus>
			</div>
			<div class="row mb-3">
				<div class="col-lg-4">
					<div class="form-group ">
						<label for="cargo">{{ __('Puesto del encargado') }}</label>
						<input id="cargo" type="text" class="form-control" name="cargo" value="{{ old('cargo') }}" autofocus>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group ">
						<label for="identificacion">{{ __('Identificación del encargado') }}</label>
						<input id="identificacion" type="text" class="form-control" name="identificacion" value="{{ old('identificacion') }}" autofocus>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group ">
						<label for="folioidentificacion">{{ __('Folio de Identificación del encargado') }}</label>
						<input id="folioidentificacion" type="text" class="form-control" name="folioidentificacion" value="{{ old('folioidentificacion') }}" autofocus>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group ">
						<label for="fecharealizada">{{ __('Fecha en que se realizó la inspección') }}</label>
						<input id="fecharealizada" type="date" class="form-control" name="fecha" value="{{ old('hora') }}" required autofocus>
						
						@if ($errors->has('hora'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('hora') }}</strong>
						</span>
						@endif
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group ">
						<label for="horarealizada">{{ __('Hora en que se realizó la inspección') }}</label>
						<input id="horarealizada" type="time" class="form-control" name="hora" value="{{ old('hora') }}" required autofocus>
						@if ($errors->has('hora'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('hora') }}</strong>
						</span>
						@endif
					</div>
				</div>
			</div>
			@endif
		</div>
	</div>
	<div class="card">
		<div class="card-body">
			<h3>Documentación Presentada</h3>
			<hr>
			<table class="table table-sm">
				<thead class="thead-dark">
					<tr class="text-center">
						<th scope="col" class="documento-requerido-t">Documento Requerido</th>
						<th scope="col" class="solicitado-t">Solicitiado</th>
						<th scope="col" class="exhibido-t">Exhibido</th>
						<th scope="col" class="observaciones-t">Observaciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach($documentos as $documento)
					<tr>
						<th class="documento-requerido-nombre">{{ $documento->documentacionRequerida->nombre }}</th>
						<td class="text-center"><input class="form-check-input " @if($documento->solicitado == 1) checked @endif type="checkbox" id="solicitado" value="{{ $documento->documentacionrequerida_id  }}" name="solicitado[]"></td>
						<td class="text-center"><input class="form-check-input " @if($documento->exhibido == 1) checked @endif type="checkbox" id="exhibido" value="{{ $documento->documentacionrequerida_id }}" name="exhibido[]"></td>
						<td><input class="form-control form-control-sm" type="text" value="{{ $documento->observaciones  }}" name="observaciones[]"></td>
					</tr>
					@endforeach
				</tbody>
			</table>
			<div class="form-group">
				<label for="observacion">Observaciones</label>
				<textarea class="form-control" id="observacion" rows="3"  name="observacion">{{ $inspeccion->comentario }}</textarea>
			</div>
		</div>
	</div>
	<div class="card mb-3">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-6">
					<h3>Gestor a cargo</h3>
					<hr>
					@if(is_object($inspeccion->gestor))
					<div class="form-group">
						<label for="gestor">{{ __('Gestor') }}</label>
						<select name="gestor" id="gestor" class="form-control{{ $errors->has('gestor') ? ' is-invalid' : '' }}" value="{{ old('gestor') }}" autofocus>
							<option value="">Seleccionar</option>
							@foreach($gestores as $gestor)
							<option value="{{ $gestor->id }}" @if($inspeccion->gestor->id == $gestor->id) selected @endif>
								{{ $gestor->nombre }} {{ $gestor->apellidopaterno }} {{ $gestor->apellidomaterno }}
							</option>
							@endforeach
						</select>
						@if ($errors->has('gestor'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('gestor') }}</strong>
						</span>
						@endif
					</div>

					<div id="datos-gestor">
						<p class="mb-0">Telefono: <b id="telefono-gestor"> {{$inspeccion->gestor->telefono}}</b></p>
						<p class="mb-0">Celular: <b id="celular-gestor"> {{$inspeccion->gestor->celular}}</b></p>
						<p class="mb-0">Correo: <b id="correo-gestor"> {{$inspeccion->gestor->correoelectronico}}</b></p>
						<p class="mb-0">Identificación (INE): <b id="identificacion-gestor"> {{$inspeccion->gestor->ine}}</b></p>
						<p class="mb-0">Estado: 
							<b id="estatus-gestor">
								@if($inspeccion->gestor->estatus == 'A')
								Activo
								@endif
							</b>
						</p>
					</div>
					@else
					<div class="form-group">
						<label for="gestor">{{ __('Gestor') }}</label>
						<select name="gestor" id="gestor" class="form-control{{ $errors->has('gestor') ? ' is-invalid' : '' }}" value="{{ old('gestor') }}" autofocus>
							<option value="">Seleccionar</option>
							@foreach($gestores as $gestor)
							<option value="{{ $gestor->id }}">
								{{ $gestor->nombre }} {{ $gestor->apellidopaterno }} {{ $gestor->apellidomaterno }}
							</option>
							@endforeach
						</select>
						@if ($errors->has('gestor'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('gestor') }}</strong>
						</span>
						@endif
					</div>
					@endif
				</div>
				<div class="col-lg-6">
					<h3>Prorroga </h3>
					<hr>
					<div class="form-group ">
						<label for="prorroga">{{ __('Dias de Prorroga') }}</label>
						<input id="prorroga" type="text" class="form-control" name="prorroga" value="{{ old('prorroga') }}" autofocus>
						@if ($errors->has('prorroga'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('prorroga') }}</strong>
						</span>
						@endif
						@if($inspeccion->fechavence != null)
						<div class="alert alert-warning" role="alert">
							La prorroga vence el: {{ $inspeccion->fechavence }}
						</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
	<button type="submit" class="btn btn-primary btn-lg btn-primary-custom">Actualizar Información</button>
</form>
@endsection