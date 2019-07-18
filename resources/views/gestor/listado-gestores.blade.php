@extends('layouts.app')
@section('content')
<header class="page-header">
    <h2>Catalogo de Gestores</h2>
    
  
</header>
<button type="button" class="btn btn-primary mb-3 btn-primary-custom" data-toggle="modal" data-target="#crear-gestor" data-backdrop="static" data-keyboard="false">
<i class="fas fa-user-plus"></i> Agregar Gestor
</button>
<div class="row">
    <div class="col">
        
        <table class="table table-responsive-lg table-bordered table-striped mb-0" id="datatable">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Teléfono</th>
                    <th>Celular</th>
                    <th>E-mail</th>
                    <th>INE</th>
                    <th>Estatus</th>
                    <th>Editar</th>
                    <th>Cambiar Estatus</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        
    </div>
</div>
<!-- Modal para Crear -->
<div class="modal fade" id="crear-gestor" tabindex="-1" role="dialog" aria-labelledby="moda-crear-gestor" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-crear-gestor">Agregar Gestor</h3>
            </div>
            <div class="modal-body">
                <form id="formulario-gestor" role="form">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">{{ __('Nombre Completo') }}</label>
                        <input id="nombre" type="text" class="form-control" required>
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
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="telefono">{{ __('Teléfono') }}</label>
                                <input id="telefono" type="number" class="form-control">
                                
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="celular">{{ __('Celular') }}</label>
                                <input id="celular" type="number" class="form-control">
                                
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-6">
                            <p class="text-danger mb-0" id="error-telefono"></p>
                            <p class="text-danger mb-0" id="error-celular"></p>
                            <br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="correoelectronico">{{ __('Correo Electrónico') }}</label>
                        <input id="correoelectronico" type="email" class="form-control">
                        <p class="text-danger" id="error-correoelectronico"></p>
                    </div>
                    <div class="form-group">
                        <label for="ine">{{ __('INE') }}</label>
                        <input id="ine" type="text" class="form-control">
                        <p class="text-danger" id="error-ine"></p>
                    </div>
                    <div class="form-group">
                        <label for="estatus">{{ __('Estatus') }}</label>
                        <select id="estatus" class="form-control">
                            <option value="">Seleccionar</option>
                            <option value="A">Activo</option>
                            <option value="B">Baja</option>
                            <option value="S">Suspendido</option>
                            <option value="V">Vigente</option>
                        </select>
                        <p class="text-danger" id="error-estatus"></p>
                    </div>
                    <hr>
                    <div class="form-group row mb-0">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-default btn-block" data-dismiss="modal" id="btn-cancelar">Cancelar</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary btn-block btn-primary-custom" id="btn-enviar">{{ __('Crear Gestor') }}</button>
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Editar -->
<div class="modal fade" id="editar-gestor" tabindex="-1" role="dialog" aria-labelledby="modal-editar-gestor" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-editar-gestor">Editar Gestor</h3>
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
                    
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="telefono-edit">{{ __('Teléfono') }}</label>
                                <input id="telefono-edit" type="number" class="form-control">
                                
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="celular-edit">{{ __('Celular') }}</label>
                                <input id="celular-edit" type="number" class="form-control">
                                
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6">
                            <p class="text-danger mb-0" id="error-telefono-edit"></p>
                            <p class="text-danger mb-0" id="error-celular-edit"></p>
                            <br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="correoelectronico-edit">{{ __('Correo Electrónico') }}</label>
                        <input id="correoelectronico-edit" type="email" class="form-control">
                        <p class="text-danger" id="error-correoelectronico-edit"></p>
                    </div>
                    <div class="form-group">
                        <label for="ine-edit">{{ __('INE') }}</label>
                        <input id="ine-edit" type="text" class="form-control">
                        <p class="text-danger" id="error-ine-edit"></p>
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
                <h3 class="modal-title" id="modal-editar-estatus">Estatus Inspector</h3>
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
                        <p>Se ha registrado al gestor correctamente.</p>
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
<script src="{{ asset('js/gestores.js') }}" defer></script>
@endsection