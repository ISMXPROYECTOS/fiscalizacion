@extends('layouts.app')
@section('content')
<header class="page-header">
    <h2>Catalogo de Fiscales</h2>
</header>
<button type="button" class="btn btn-primary mb-3 btn-primary-custom" data-toggle="modal" data-target="#crear-inspector" data-backdrop="static" data-keyboard="false">
    <i class="fas fa-user-plus"></i> Agregar Fiscal
</button>
<div class="row">
    <div class="col">
        
        <table class="table table-responsive-lg table-bordered table-striped mb-0" id="datatable">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Clave</th>
                    <th>Estatus</th>
                    <th>Editar</th>
                    <th>Cambiar Estatus</th>
                    <th>Gafete</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        
    </div>
</div>


<!-- Modal para Crear -->
<div class="modal fade" id="crear-inspector" tabindex="-1" role="dialog" aria-labelledby="modal-crear-inspector" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-crear-inspector">Agregar Fiscal</h3>
            </div>
            <div class="modal-body">
                <form id="formulario-inspector" role="form">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">{{ __('Nombre Completo') }}</label>
                        <input id="nombre" type="text" class="form-control">
                        <p class="text-danger" id="error-nombre"></p>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="apellidopaterno">{{ __('Apellido Paterno') }}</label>
                                <input id="apellidopaterno" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="apellidomaterno">{{ __('Apellido Materno') }}</label>
                                <input id="apellidomaterno" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-6">
                            <p class="text-danger mb-0" id="error-apellidopaterno"></p>
                            <p class="text-danger mb-0" id="error-apellidomaterno"></p>
                            <br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="clave">{{ __('Clave') }}</label>
                        <input id="clave" type="text" class="form-control" >
                        <p class="text-danger" id="error-clave"></p>
                    </div>
                    <div class="form-group">
                        <label for="estatus">{{ __('Estatus') }}</label>
                        <select id="estatus" class="form-control" >
                            <option value="">Seleccionar</option>
                            <option value="A">Activo</option>
                            <option value="B">Baja</option>
                            <option value="S">Suspendido</option>
                            <option value="V">Vigente</option>
                        </select>
                        <p class="text-danger" id="error-estatus"></p>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="vigenciainicio">{{ __('Vigencia: Fecha Inicio') }}</label>
                                <input id="vigenciainicio" type="date" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="vigenciafin">{{ __('Vigencia: Fecha Fin') }}</label>
                                <input id="vigenciafin" type="date" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-6">
                            <p class="text-danger mb-0" id="error-vigenciainicio"></p>
                            <p class="text-danger mb-0" id="error-vigenciafin"></p>
                            <br>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row mb-0">

                        <div class="col-md-6">
                            <button type="button" class="btn btn-default btn-block" data-dismiss="modal" id="btn-cancelar">Cancelar</button>
                        </div>
                        <div class="col-md-6">

                            <button type="button" class="btn btn-primary btn-block btn-primary-custom" id="btn-enviar">
                                {{ __('Crear Fiscal') }} 
                            </button>
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Editar -->
<div class="modal fade" id="editar-inspector" tabindex="-1" role="dialog" aria-labelledby="modal-editar-inspector" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-editar-inspector">Editar Fiscal</h3>
            </div>
            <div class="modal-body">
                <form class="formulario-gestor" role="form">
                    @csrf
                    <input type="hidden" id="id-edit">
                    <div class="form-group">
                        <label for="nombre-edit">{{ __('Nombre Completo') }}</label>
                        <input id="nombre-edit" type="text" class="form-control" required>
                        <p class="text-danger" id="error-nombre-edit"></p>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="apellidopaterno-edit">{{ __('Apellido Paterno') }}</label>
                                <input id="apellidopaterno-edit" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="apellidomaterno-edit">{{ __('Apellido Materno') }}</label>
                                <input id="apellidomaterno-edit" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6">
                            <p class="text-danger mb-0" id="error-apellidopaterno-edit"></p>
                            <p class="text-danger mb-0" id="error-apellidomaterno-edit"></p>
                            <br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="clave-edit">{{ __('Clave') }}</label>
                        <input id="clave-edit" type="text" class="form-control">
                        <p class="text-danger" id="error-clave-edit"></p>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="vigenciainicio-edit">{{ __('Vigencia: Fecha Inicio') }}</label>
                                <input id="vigenciainicio-edit" type="date" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="vigenciafin-edit">{{ __('Vigencia: Fecha Fin') }}</label>
                                <input id="vigenciafin-edit" type="date" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6">
                            <p class="text-danger mb-0" id="error-vigenciainicio-edit"></p>
                            <p class="text-danger mb-0" id="error-vigenciafin-edit"></p>
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
                <h3 class="modal-title" id="modal-editar-estatus">Estatus Fiscal</h3>
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

<!-- Modal para Generar Gafete -->
<div class="modal fade" id="generar-gafete" tabindex="-1" role="dialog" aria-labelledby="modal-generar-gafete" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-generar-gafete">Generar Gafete</h3>
            </div>
            <div class="modal-body">
                <form id="formulario-generar-gafete" role="form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="gafete-id" id="gafete-id">
                    <div class="form-group">
                        <p class="mb-0">Nombre Completo: <b id="gafete-nombre"></b></p>
                        <p class="mb-0">Apellido Paterno: <b id="gafete-apellidopaterno"></b></p>
                        <p class="mb-0">Apellido Materno: <b id="gafete-apellidomaterno"></b></p>
                        <p class="mb-0">Clave de Fiscal: <b id="gafete-clave"></b></p>
                    </div>

                    <div class="form-group">
                        <label for="gafete-image">Foto del Fiscal (110px x 132px)</label>
                        <input  name="gafete-image" type="file" class="form-control-file" >
                        <p class="text-danger" id="error-gafete-image"></p>
                    </div>
                    <hr>
                    <div class="form-group row mb-0">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-default btn-block" data-dismiss="modal" id="btn-cancelar">Cancelar</button>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary btn-block btn-primary-custom" id="btn-generar-gafete">{{ __('Crear Gafete') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Imprimir Gafete (PDF) -->
<div class="modal fade" id="imprimir-gafete" tabindex="-1" role="dialog" aria-labelledby="modal-imprimir-gafete" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-imprimir-gafete">Imprimir Gafete</h3>
            </div>
            <div class="modal-body">
                <div class="modal-wrapper">
                    <div class="modal-icon">
                        <i class="far fa-address-card"></i>
                    </div>
                    <div class="modal-text">
                        <h4>Este usuario ya cuenta con un gafete</h4>
                        <p>Para generar nuevamente el gafete, da click en el boton "Descargar"</p>
                    </div>
                </div>    
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="btn-cancelar">Cancelar</button>
                <button type="button" class="btn btn-success btn-primary-custom" id="btn-descargar" data-dismiss="modal">
                    Descargar
                </button>
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
                        <p>Se ha registrado al fiscal correctamente.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<!-- Alerta de Generando PDF -->
<div class="modal fade" id="creando-gafete" tabindex="-1" role="dialog" aria-labelledby="modal-registro-exitoso" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-registro-correcto">El gafete ha sido creado</h3>
            </div>
            <div class="modal-body">
                <div class="modal-wrapper">
                    <div class="modal-icon">
                        <div class="spinner-border text-success" role="status">
                          <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <div class="modal-text">
                        <h4>El gafete se creo correctamente</h4>
                        <p>En breve el archivo PDF sera descargado</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<!-- Alerta de Descargando PDF -->
<div class="modal fade" id="descargando-gafete" tabindex="-1" role="dialog" aria-labelledby="modal-registro-exitoso" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-registro-correcto">El gafete se esta descargando</h3>
            </div>
            <div class="modal-body">
                <div class="modal-wrapper">
                    <div class="modal-icon">
                        <div class="spinner-border text-success" role="status">
                          <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <div class="modal-text">
                        <h4>Descarga en proceso</h4>
                        <p>En breve el archivo PDF sera descargado</p>
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

@endsection
@section('scripts')
<script src="{{ asset('js/inspectores.js') }}" defer></script>
<script src="{{ asset('js/gafetes.js') }}" defer></script>
@endsection