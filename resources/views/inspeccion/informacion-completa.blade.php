@extends('layouts.app')
@section('content')
<header class="page-header">
	<h2>Folio de Inspección: {{ $inspeccion->folio }}</h2>
</header>

@if ($errors->any())
<div class="alert alert-danger" role="alert">
	{{ $errors->first() }}
</div>
@endif

@if ($errors->has('solicitar'))
<span class="invalid-feedback" role="alert">
	<strong>{{ $errors->first('solicitar') }}</strong>
</span>
@endif

@if (session('status'))
<div class="alert alert-success">
	{{ session('status') }}
</div>
@endif

<h3>Estado de la Inspección</h3>

@if($inspeccion->estatusInspeccion->clave == "A")
	<div>
		<label for="">Estatus: </label>
		<label for=""> <span class="badge badge-pill badge-primary">{{ $inspeccion->estatusInspeccion->nombre }}</span></label>
	</div>
@elseif($inspeccion->estatusInspeccion->clave == "C")
	<div>
		<label for="">Estatus: </label>
		<label for=""> <span class="badge badge-pill badge-warning">{{ $inspeccion->estatusInspeccion->nombre }}</span></label>
	</div>
@elseif($inspeccion->estatusInspeccion->clave == "Cap")
	<div>
		<label for="">Estatus: </label>
		<label for=""> <span class="badge badge-pill badge-success">{{ $inspeccion->estatusInspeccion->nombre }}</span></label>
	</div>
@elseif($inspeccion->estatusInspeccion->clave == "Epc")
	<div>
		<label for="">Estatus: </label>
		<label for=""> <span class="badge badge-pill badge-epc">{{ $inspeccion->estatusInspeccion->nombre }}</span></label>
	</div>
@elseif($inspeccion->estatusInspeccion->clave == "Claus")
	<div>
		<label for="">Estatus: </label>
		<label for=""> <span class="badge badge-pill badge-claus">{{ $inspeccion->estatusInspeccion->nombre }}</span></label>
	</div>
@elseif($inspeccion->estatusInspeccion->clave == "M")
	<div>
		<label for="">Estatus: </label>
		<label for=""> <span class="badge badge-pill badge-multa">{{ $inspeccion->estatusInspeccion->nombre }}</span></label>
	</div>
@elseif($inspeccion->estatusInspeccion->clave == "NA")
	<div>
		<label for="">Estatus: </label>
		<label for=""> <span class="badge badge-pill badge-secondart">{{ $inspeccion->estatusInspeccion->nombre }}</span></label>
	</div>
@elseif($inspeccion->estatusInspeccion->clave == "P")
	<div>
		<label for="">Estatus: </label>
		<label for=""> <span class="badge badge-pill badge-info">{{ $inspeccion->estatusInspeccion->nombre }}</span></label>
	</div>
@elseif($inspeccion->estatusInspeccion->clave == "S")
	<div>
		<label for="">Estatus: </label>
		<label for=""> <span class="badge badge-pill badge-solventada">{{ $inspeccion->estatusInspeccion->nombre }}</span></label>
	</div>
@elseif($inspeccion->estatusInspeccion->clave == "V")
	<div>
		<label for="">Estatus: </label>
		<label for=""> <span class="badge badge-pill badge-danger">{{ $inspeccion->estatusInspeccion->nombre }}</span></label>
	</div>
@endif

@if($inspeccion->fechavence != false)
	@if(date("Y-m-d", strtotime($inspeccion->fechavence."-1 days")) == date("Y-m-d"))
		<div>
			<label for="">Fecha de vencimiento: </label>
			<label for=""> <span class="badge badge-pill badge-warning">{{ date('d/m/Y', strtotime($inspeccion->fechavence)) }}</span> </label>
		</div>
	@elseif($inspeccion->fechavence > date("Y-m-d"))
		
		<div>
			<label for="">Fecha de vencimiento: </label>
			<label for=""> <span class="badge badge-pill badge-success">{{ date('d/m/Y', strtotime($inspeccion->fechavence)) }}</span> </label>
		</div>
	@else
		<div>
			<label for="">Fecha de vencimiento: </label>
			<label for=""> <span class="badge badge-pill badge-danger">{{ date('d/m/Y', strtotime($inspeccion->fechavence)) }}</span> </label>
		</div>
	@endif
@endif

@if($inspeccion->fechaprorroga != false)
	@if($inspeccion->fechaprorroga < date("Y-m-d"))
	<div>
		<label for="">Prorroga vencida</label>
		<label for=""> <span class="badge badge-pill badge-danger">{{ date('d/m/Y', strtotime($inspeccion->fechaprorroga)) }}</span> <span class="badge badge-pill badge-danger">Vencido</span></label>
	</div>
	@else
	<div>
		<label for="">En prorroga</label>
		<label for=""> <span class="badge badge-pill badge-warning">{{ date('d/m/Y', strtotime($inspeccion->fechaprorroga)) }}</span> </label>
	</div>
	@endif
@endif

<h4 >Inspector: <b id="nombre-inspector">{{ $inspeccion->inspector->nombre }} {{ $inspeccion->inspector->apellidopaterno }} {{ $inspeccion->inspector->apellidomaterno }}</b></h4>
<button type="button" class="btn btn-primary btn-sm cambiar-inspector" id="{{ $inspeccion->id }}">
	<i class="fas fa-exchange-alt"></i> Cambiar Inspector
</button>

<form method="POST" action="{{ route('actualizar-informacion-inspeccion') }}">
	@csrf
	<input type="hidden" name="inspeccion-id" value="{{ $inspeccion->id }}">
	<h3>Datos del Comercio</h3>
	<hr>
	@if(is_object($inspeccion->comercio))
	<input type="hidden" name="establecimiento" value="{{ $inspeccion->comercio->id }}">
	<div class="form-group">
		<label for="nombrelocal">{{ __('Nombre Establecimiento') }}</label>
		<input id="nombrelocal" type="text" name="nombrelocal" class="form-control" value="{{ $inspeccion->comercio->nombreestablecimiento }}" required>
	</div>
	<div class="row mb-3">
		<div class="col-lg-6">
			<div class="form-group">
				<label for="domicilio">{{ __('Domicilio') }}</label>
				<input id="domicilio" type="text" name="domicilio" class="form-control" value="{{ $inspeccion->comercio->domiciliofiscal }}" required>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="form-group">
				<label for="clavecatastral">{{ __('Clave catastral') }}</label>
				<input id="clavecatastral" type="number" name="clavecatastral" class="form-control" value="{{ $inspeccion->comercio->clavecatastral }}" required>
			</div>
		</div>
	</div>
	@else
	<div class="form-group">
		<label>Buscar negocio por razón social o nombre comercial</label>
		<div class="input-group">
			<input type="text" class="form-control" name="calle" id="calle" placeholder="Nombre comercial del negocio">
			<div class="input-group-append">
				<button class="btn btn-outline-secondary" type="button" id="buscar-sm">Buscar</button>
			</div>
		</div>
		<p class="text-danger mb-0" id="error-sm">{{ $errors->first('calle') }}</p>
	</div>
	<div id="comercios" class="hidden mt-3 mb-3">
		<p class="text-danger mb-0" id="error-comercios"></p>
		<p class=" mb-0" id="error-results"></p>
		<table class="table table-sm" id="tabla-comercios">
			<thead class="thead-dark">
				<tr>
					<th></th>
					<th>LICENCIA DE FUNCIONAMIENTO</th>
					<th>RAZÓN SOCIAL</th>
					<th>NOMBRE COMERCIAL</th>
					<th>UBICACIÓN</th>
				</tr>
			</thead>
			<tbody id="tbody-comercios"></tbody>
		</table>
	</div>
	@endif
	@if ($is_edit == 'true')
	<div class="form-group ">
		<label for="encargado">{{ __('Nombre del encargado') }}</label>
		<input id="encargado" type="text" class="form-control" name="encargado" value="{{ $inspeccion->nombreencargado }}">
	</div>
	<div class="row mb-3">
		<div class="col-lg-4">
			<div class="form-group ">
				<label for="cargo">{{ __('Puesto del encargado') }}</label>
				<input id="cargo" type="text" class="form-control" name="cargo" value="{{ $inspeccion->cargoencargado }}">
			</div>
		</div>
		<div class="col-lg-4">
			<div class="form-group ">
				<label for="identificacion">{{ __('Identificación del encargado') }}</label>
				<input id="identificacion" type="text" class="form-control" name="identificacion" value="{{ $inspeccion->identificacion }}">
			</div>
		</div>
		<div class="col-lg-4">
			<div class="form-group ">
				<label for="folioidentificacion">{{ __('Folio de Identificación del encargado') }}</label>
				<input id="folioidentificacion" type="text" class="form-control" name="folioidentificacion" value="{{ $inspeccion->folioidentificacion }}">
			</div>
		</div>
	</div>
	@if ($is_edit == 'true' && auth()->user()->role == 'ROLE_ADMIN')
	<div class="row">
		<div class="col-md-4">
			<div class="form-group ">
				<label for="fecharealizada">{{ __('Fecha en que se realizó la inspección') }}</label>
				<input id="fecharealizada" type="date" class="form-control" name="fecha" value="{{ $inspeccion->fecharealizada }}" required >
				@if ($errors->has('hora'))
				<span class="invalid-feedback" role="alert">
					<strong>{{ $errors->first('hora') }}</strong>
				</span>
				@endif
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group ">
				<label for="horarealizada">{{ __('Hora en que se realizó la inspección') }}</label>
				<input id="horarealizada" type="time" class="form-control" name="hora" value="{{ date('H:i', strtotime($inspeccion->horarealizada)) }}" required>
				@if ($errors->has('hora'))
				<span class="invalid-feedback" role="alert">
					<strong>{{ $errors->first('hora') }}</strong>
				</span>
				@endif
			</div>
		</div>
	</div>
	@else
	<div class="row">
		<div class="col-md-4">
			<div class="form-group ">
				<label for="fecharealizada">{{ __('Fecha en que se realizó la inspección') }}</label>
				<p>{{ $inspeccion->fecharealizada }}</p>
				@if ($errors->has('hora'))
				<span class="invalid-feedback" role="alert">
					<strong>{{ $errors->first('hora') }}</strong>
				</span>
				@endif
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group ">
				<label for="horarealizada">{{ __('Hora en que se realizó la inspección') }}</label>
				<p>{{ date('H:i', strtotime($inspeccion->horarealizada)) }}</p>
				@if ($errors->has('hora'))
				<span class="invalid-feedback" role="alert">
					<strong>{{ $errors->first('hora') }}</strong>
				</span>
				@endif
			</div>
		</div>
	</div>
	@endif
	@else
	<div class="form-group ">
		<label for="encargado">{{ __('Nombre del encargado') }}</label>
		<input id="encargado" type="text" class="form-control" name="encargado" value="{{ old('encargado') }}">
	</div>
	<div class="row mb-3">
		<div class="col-lg-4">
			<div class="form-group ">
				<label for="cargo">{{ __('Puesto del encargado') }}</label>
				<input id="cargo" type="text" class="form-control" name="cargo" value="{{ old('cargo') }}">
			</div>
		</div>
		<div class="col-lg-4">
			<div class="form-group ">
				<label for="identificacion">{{ __('Identificación del encargado') }}</label>
				<input id="identificacion" type="text" class="form-control" name="identificacion" value="{{ old('identificacion') }}">
			</div>
		</div>
		<div class="col-lg-4">
			<div class="form-group ">
				<label for="folioidentificacion">{{ __('Folio de Identificación del encargado') }}</label>
				<input id="folioidentificacion" type="text" class="form-control" name="folioidentificacion"
				value="{{ old('folioidentificacion') }}">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
			<div class="form-group ">
				<label for="fecharealizada">{{ __('Fecha en que se realizó la inspección') }}</label>
				<input id="fecharealizada" type="date" class="form-control" name="fecha" value="{{ old('hora') }}" required >
				
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
				<input id="horarealizada" type="time" class="form-control" name="hora" value="{{ old('hora') }}" required >
				@if ($errors->has('hora'))
				<span class="invalid-feedback" role="alert">
					<strong>{{ $errors->first('hora') }}</strong>
				</span>
				@endif
			</div>
		</div>
	</div>
	@endif
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
			<tr>
				<th class="seleccionar-todos-option text-right">Seleccionar todos</th>
				<th class="text-center"><input class="form-check-input" type="checkbox" id="seleccionar-todos-solicitado"></td>
				<th class="text-center"><input class="form-check-input" type="checkbox" id="seleccionar-todos-exhibido"></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($documentos as $documento)
			<tr>
				<th class="documento-requerido-nombre">{{ $documento->documentacionRequerida->nombre }}</th>
				<td class="text-center"><input class="form-check-input check-solicitado" @if($documento->solicitado == 1) checked @endif type="checkbox" id="solicitado-{{ $documento->documentacionRequerida->id }}" value="{{ $documento->documentacionRequerida->id }}" name="solicitado[]"></td>
				<td class="text-center"><input class="form-check-input check-exhibido" @if($documento->exhibido == 1) checked @endif type="checkbox" id="exhibido-{{ $documento->documentacionRequerida->id }}" value="{{ $documento->documentacionRequerida->id }}"  name="exhibido[]"></td>
				<td><input class="form-control form-control-sm" type="text" value="{{ $documento->observaciones }}" name="observaciones[]"></td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<div class="form-group">
		<label for="observacion">Observaciones</label>
		<textarea class="form-control" id="observacion" rows="3"  name="observacion">{{ $inspeccion->comentario }}</textarea>
	</div>
	<div class="row">
		<div class="col-lg-4">
			<h3>Gestor a cargo</h3>
			<hr>
			@if(is_object($inspeccion->gestor))
			<div class="form-group">
				<label for="gestor">{{ __('Gestor') }}</label>
				<select name="gestor" id="gestor" class="form-control{{ $errors->has('gestor') ? ' is-invalid' : '' }}"
					value="{{ old('gestor') }}">
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
				<select name="gestor" id="gestor" class="form-control{{ $errors->has('gestor') ? ' is-invalid' : '' }}" value="{{ old('gestor') }}">
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
		<div class="col-lg-8">
			<h3>Prorroga </h3>
			<hr>
			<p>Historial de Prorrogas</p>
			<div class="historial-prorrogas">
				@if ($historial_prorroga->isEmpty())
					<p>No hay resultados</p>
				@else
					<table class="table table-sm">
					  <thead>
					    <tr>
					      <th scope="col">Usuario</th>
					      <th scope="col">Multa en UMAS</th>
					      <th scope="col">Dias</th>
					      <th scope="col">Observaciones</th>
					    </tr>
					  </thead>
					  <tbody>
					    @foreach($historial_prorroga as $historial)
							<tr> 
						      <td>{{ $historial->usuario->usuario}}</td>
						      <td>{{ $historial->multa->montoMulta }}</td>
						      <td>{{ $historial->diasdeprorroga }}</td>
						      <td>{{ $historial->observaciones }}</td>
						    </tr>
						@endforeach
					  </tbody>
					</table>
				@endif
			</div>
			<br>
			<button type="button" class="btn btn-primary btn-sm prorroga">
				 Agregar prorroga
			</button>
		</div>
	</div>
	<br>
	<button type="submit" class="btn btn-primary btn-lg btn-primary-custom">Actualizar Información</button>
	@if ($inspeccion->estatusInspeccion->clave == 'M' || $multa == 'true')
		<button type="button" class="btn btn-primary btn-lg btn-primary-custom multa"> Generar Multa</button>
	@endif
	
	@if ($inspeccion->estatusInspeccion->clave == 'V')
	<a href="{{ route('descargar-clausura', $inspeccion->id) }}" class="btn btn-primary btn-lg btn-primary-custom">Generar orden de clausura</a>
	@endif

	@if(is_object($ultima_multa))
		@if ($ultima_multa->fechavence < date('Y-m-d'))
			<a href="{{ route('descargar-clausura', $inspeccion->id) }}" class="btn btn-primary btn-lg btn-primary-custom">Generar orden de clausura</a>
		@endif
	@endif

	@if (auth()->user()->role == 'ROLE_ADMIN')
		<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#alerta-confirmacion-limpieza">
		  Limpiar Inspección
		</button>
		
	@endif
</form>

<!-- Modal para cambiar de Inspector -->
<div class="modal fade" id="cambiar-inspector" tabindex="-1" role="dialog" aria-labelledby="modal-cambiar-inspector" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="modal-cambiar-inspector">Cambiar de Inspector</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="formulario-cambiar-inspector" role="form">
					@csrf
					<input type="hidden" id="id-cambio-inspector">
					<div class="form-group">
						<label for="inspector-edit">{{ __('Inspector') }}</label>
						<select id="inspector-edit" class="form-control">
							<option value="">Seleccionar</option>
							<option value="">Ninguno</option>
							@foreach($inspectores as $inspector)
								<option value="{{ $inspector->id }}">{{ $inspector->nombre }} {{ $inspector->apellidopaterno }} 
									{{ $inspector->apellidomaterno }}</option>
							@endforeach
						</select>
						<p class="text-danger" id="error-inspector-edit"></p>
					</div>
					<hr>
					<div class="form-group row mb-0">
						<div class="col-md-6">
							<button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cancelar</button>
						</div>
						<div class="col-md-6">
							<button type="button" class="btn btn-primary btn-block btn-primary-custom" id="btn-cambiar-inspector">{{ __('Guardar') }}</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Alerta de actualización -->
<div class="modal fade" id="actualizacion-correcta" tabindex="-1" role="dialog" aria-labelledby="modal-actualizacion-correcta" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="modal-actualizacion-correcta">Actualización Exitosa</h3>
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
						<h4>Actualización Exitosa</h4>
						<p>La información se ha actualizado correctamente.</p>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal para agregar prorroga -->
<div class="modal fade" id="agregar-prorroga" tabindex="-1" role="dialog" aria-labelledby="modal-agregar-prorroga" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="modal-agregar-prorroga">Agregar Prorroga</h3>
			</div>
			<div class="modal-body">
				<form class="formulario-prorroga" role="form">
					@csrf
					<input type="hidden" id="id-agregar-prorroga" value="{{ $inspeccion->id }}">
					<div class="form-group">
						<label for="folio-multa">{{ __('Folio Multa') }}</label>
						<input id="folio-multa" type="text" class="form-control"><br>
						<p class="text-danger" id="error-folio-multa"></p>
					</div>
					<div class="form-group">
						<label for="prorroga">{{ __('Dias de Prorroga') }}</label>
						<input id="prorroga" type="number" class="form-control"><br>
						<p class="text-danger" id="error-prorroga"></p>
					</div>
					<div class="form-group">
						<label for="observacion-prorroga">Observaciones</label>
						<textarea class="form-control" id="observacion-prorroga" rows="2"></textarea>
						<p class="text-danger" id="error-observacion-prorroga"></p>
					</div>
					<hr>
					<div class="form-group row mb-0">
						<div class="col-md-6">
							<button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cancelar</button>
						</div>
						<div class="col-md-6">
							<button type="button" class="btn btn-primary btn-block btn-primary-custom" id="btn-agregar-prorroga">{{ __('Guardar') }}</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modal para agregar multa -->
<div class="modal fade" id="agregar-multa" tabindex="-1" role="dialog" aria-labelledby="modal-agregar-multa" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="modal-agregar-multa">Asignar Multa</h3>
			</div>
			<div class="modal-body">
				<form class="formulario-multa" role="form">
					@csrf
					<input type="hidden" id="id-agregar-multa" value="{{ $inspeccion->id }}">
					<div class="form-group">
						<label for="cantidad-multa">{{ __('Monto de la multa en UMAS') }}</label>
						<input id="cantidad-multa" type="number" class="form-control"><br>
						<p class="text-danger" id="error-cantidad-multa"></p>
					</div>
					<hr>
					<div class="form-group row mb-0">
						<div class="col-md-6">
							<button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cancelar</button>
						</div>
						<div class="col-md-6">
							<button type="button" class="btn btn-primary btn-block btn-primary-custom" id="btn-agregar-multa">{{ __('Generar multa') }}</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Alerta de error  -->
<div class="modal fade" id="ocurrio-un-error" tabindex="-1" role="dialog" aria-labelledby="modal-ocurrio-un-error" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="modal-ocurrio-un-error">Ocurrio un error</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="modal-wrapper">
					<div class="modal-icon">
						<i class="fas fa-times-circle"></i>
					</div>
					<div class="modal-text">
						<h4>Lo sentimos</h4>
						<p>Algo salio mal durante el proceso. Intentalo de nuevo.</p>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">OK</button>
			</div>
		</div>
	</div>
</div>

<!-- Alerta de actualización -->
<div class="modal fade" id="alerta-confirmacion-limpieza" tabindex="-1" role="dialog" aria-labelledby="modal-alerta-confirmacion-limpieza" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="modal-alerta-confirmacion-limpieza">¡Cuidado!</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="modal-wrapper">
					<div class="modal-icon">
						<i class="fas fa-exclamation-circle"></i>
					</div>
					<div class="modal-text">
						<h4>¿Limpiar Inspeccion?</h4>
						<p>¿Estas seguro que deseas limpiar esta inspección?</p>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<a href="{{ route('limpiar-inspeccion', $inspeccion->id) }}" class="btn btn-lg ">Si</a>
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/inspeccion-completa.js') }}" ></script>
@endsection