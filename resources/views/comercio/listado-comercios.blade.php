@extends('layouts.app')
@section('content')
<header class="page-header">
	<h2>Catalogo de Comercios</h2>
</header>
<button type="button" class="btn btn-primary mb-3 btn-primary-custom" data-toggle="modal" data-target="#crear-comercio" data-backdrop="static" data-keyboard="false">
	<i class="fas fa-user-plus"></i> Agregar Comercio
</button>

<a href="{{ route('sincronizar-comercios') }}" role="button" class="btn btn-primary mb-3 btn-primary-custom" id="btn-sincronizar">
	<i class="fas fa-sync-alt"></i> Sincronizar comercios
</a>

<div class="row">
	<div class="col">
		<table class="table table-sm table-responsive-lg table-bordered table-striped mb-0" id="datatable">
			<thead>
				<tr>
					<th>Propietario</th>
					<th>Nombre</th>
					<th>Domicilio</th>
					<th>RFC</th>
					<th>Clave Catastral</th>
					<th>Estatus</th>
					<th>Cambiar Estatus</th>
					<th>Editar</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>

<!-- Modal para Crear -->
<div class="modal fade" id="crear-comercio" tabindex="-1" role="dialog" aria-labelledby="modal-crear-comercio" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="modal-crear-comercio">Agregar Comercio</h3>
			</div>
			<div class="modal-body">
				<form id="formulario-comercio" role="form">
					@csrf
					<div class="form-group">
						<label for="rfc">{{ __('RFC') }}</label>
						<input id="rfc" type="text" class="form-control">
						<p class="text-danger" id="error-rfc"></p>
					</div>
					<div class="form-group">
						<label for="licenciafuncionamiento">{{ __('Licencia de funcionamiento') }}</label>
						<input id="licenciafuncionamiento" type="number" class="form-control">
						<p class="text-danger" id="error-licenciafuncionamiento"></p>
					</div>
					<div class="form-group">
						<label for="propietario">{{ __('Nombre Completo del Propietario') }}</label>
						<input id="propietario" type="text" class="form-control">
						<p class="text-danger" id="error-propietario"></p>
					</div>
					<div class="form-group">
						<label for="clavecatastral">{{ __('Clave catastral') }}</label>
						<input id="clavecatastral" type="text" class="form-control">
						<p class="text-danger" id="error-clavecatastral"></p>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label for="denominacion">{{ __('Denominación') }}</label>
								<input id="denominacion" type="text" class="form-control">
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label for="nombreestablecimiento">{{ __('Nombre del Establecimiento') }}</label>
								<input id="nombreestablecimiento" type="text" class="form-control">
							</div>
						</div>
						<div class="col-lg-12 col-md-6">
							<p class="text-danger" id="error-denominacion"></p>
							<p class="text-danger mb-0" id="error-nombreestablecimiento"></p>
							<br>
						</div>
					</div>
					<div class="form-group">
						<label for="domiciliofiscal">{{ __('Dimicilio Fiscal') }}</label>
						<input id="domiciliofiscal" type="text" class="form-control">
						<p class="text-danger" id="error-domiciliofiscal"></p>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label for="nointerior">{{ __('Número Interior') }}</label>
								<input id="nointerior" type="text" class="form-control">
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label for="noexterior">{{ __('Número Exterior') }}</label>
								<input id="noexterior" type="text" class="form-control">
							</div>
						</div>
						<div class="col-lg-12 col-md-6">
							<p class="text-danger mb-0" id="error-nointerior"></p>
							<p class="text-danger mb-0" id="error-noexterior"></p>
							<br>
						</div>
					</div>
					<hr>
					<div class="form-group row mb-0">
						<div class="col-md-6">
							<button type="button" class="btn btn-default btn-block" data-dismiss="modal" id="btn-cancelar">Cancelar</button>
						</div>
						<div class="col-md-6">
							<button type="button" class="btn btn-primary btn-block btn-primary-custom" id="btn-enviar">{{ __('Crear Comercio') }}</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modal para Editar -->
<div class="modal fade" id="editar-comercio" tabindex="-1" role="dialog" aria-labelledby="modal-editar-comercio" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="modal-editar-comercio">Editar Comercio</h3>
			</div>
			<div class="modal-body">
				<form class="formulario-editar-comercio" role="form">
					@csrf
					<input type="hidden" id="id-edit">
					<div class="form-group">
						<label for="rfc-edit">{{ __('RFC') }}</label>
						<input id="rfc-edit" type="text" class="form-control">
						<p class="text-danger" id="error-rfc-edit"></p>
					</div>
					<div class="form-group">
						<label for="licenciafuncionamiento-edit">{{ __('Licencia de funcionamiento') }}</label>
						<input id="licenciafuncionamiento-edit" type="number" class="form-control">
						<p class="text-danger" id="error-licenciafuncionamiento-edit"></p>
					</div>
					<div class="form-group">
						<label for="propietario-edit">{{ __('Nombre Completo del Propietario') }}</label>
						<input id="propietario-edit" type="text" class="form-control">
						<p class="text-danger" id="error-propietario-edit"></p>
					</div>
					<div class="form-group">
						<label for="clavecatastral-edit">{{ __('Clave catastral') }}</label>
						<input id="clavecatastral-edit" type="text" class="form-control">
						<p class="text-danger" id="error-clavecatastral-edit"></p>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label for="denominacion-edit">{{ __('Denominación') }}</label>
								<input id="denominacion-edit" type="text" class="form-control">
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label for="nombreestablecimiento-edit">{{ __('Nombre del Establecimiento') }}</label>
								<input id="nombreestablecimiento-edit" type="text" class="form-control">
							</div>
						</div>
						<div class="col-lg-12 col-md-6">
							<p class="text-danger" id="error-denominacion-edit"></p>
							<p class="text-danger mb-0" id="error-nombreestablecimiento-edit"></p>
							<br>
						</div>
					</div>
					<div class="form-group">
						<label for="domiciliofiscal-edit">{{ __('Dimicilio Fiscal') }}</label>
						<input id="domiciliofiscal-edit" type="text" class="form-control">
						<p class="text-danger" id="error-domiciliofiscal-edit"></p>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label for="nointerior-edit">{{ __('Número Interior') }}</label>
								<input id="nointerior-edit" type="text" class="form-control">
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label for="noexterior-edit">{{ __('Número Exterior') }}</label>
								<input id="noexterior-edit" type="text" class="form-control">
							</div>
						</div>
						<div class="col-lg-12 col-md-6">
							<p class="text-danger mb-0" id="error-nointerior-edit"></p>
							<p class="text-danger mb-0" id="error-noexterior-edit"></p>
							<br>
						</div>
					</div>
					<hr>
					<div class="form-group row mb-0">
						<div class="col-md-6">
							<button type="button" class="btn btn-default btn-block" data-dismiss="modal" id="btn-cancelar">Cancelar</button>
						</div>
						<div class="col-md-6">
							<button type="button" class="btn btn-primary btn-block btn-primary-custom" id="btn-editar">{{ __('Guardar') }}</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modal para Editar Estatus -->
<div class="modal fade" id="editar-estatus" tabindex="-1" role="dialog" aria-labelledby="modal-editar-estatus" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-editar-estatus">Estatus Comercio</h3>
            </div>
            <div class="modal-body">
                <form class="formulario-estatus" role="form">
                    @csrf
                    <input type="hidden" id="id-edit-estatus">
                    <div class="form-group">
                        <label for="estatus-edit">{{ __('Estatus') }}</label>
                        <select id="estatus-edit" class="form-control">
                            <option value="">Seleccionar</option>
                            <option value="A">Activo</option>
                            <option value="B">Baja</option>
                            <option value="S">Suspendido</option>
                            <option value="V">Vigente</option>
                        </select>
                        <p class="text-danger" id="error-estatus-edit"></p>
                    </div>
                    <hr>
                    <div class="form-group row mb-0">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-default btn-block" data-dismiss="modal" id="btn-cancelar">Cancelar</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary btn-block btn-primary-custom" id="btn-estatus">{{ __('Guardar') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Alerta de registro -->
<div class="modal fade" id="registro-correcto" tabindex="-1" role="dialog" aria-labelledby="modal-registro-exitoso" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="modal-registro-correcto">Registro Exitoso</h3>
			</div>
			<div class="modal-body">
				<div class="modal-wrapper">
					<div class="modal-icon">
						<i class="fas fa-check"></i>
					</div>
					<div class="modal-text">
						<h4>Registro Exitoso</h4>
						<p>Se ha registrado el comercio correctamente.</p>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
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

<!-- Alerta de sincronizacion -->
@if (session('status'))
<div class="modal fade" id="sincronizacion-correcta" tabindex="-1" role="dialog" aria-labelledby="modal-sincronizacion-correcta" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="modal-sincronizacion-correcta">Sincronización Exitosa</h3>
			</div>
			<div class="modal-body">
				<div class="modal-wrapper">
					<div class="modal-icon">
						<i class="fas fa-check"></i>
					</div>
					<div class="modal-text">
						<h4>Sincronización Exitosa</h4>
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

@endsection
@section('scripts')
<script>
	$('#sincronizacion-correcta').modal('show')
</script>
<script src="{{ asset('js/comercio.js') }}" defer></script>
@endsection