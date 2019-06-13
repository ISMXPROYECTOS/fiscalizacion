@extends('layouts.app')
@section('content')
<header class="page-header">
    <h2>Catalogo de Usuarios</h2>
    
    
</header>
<button type="button" class="btn btn-primary mb-3 btn-primary-custom" data-toggle="modal" data-target="#crear-usuario">
<i class="fas fa-user-plus"></i> Agregar Usuario
</button>
<div class="row">
    <div class="col">
        
        <table class="table table-bordered table-striped mb-0" id="datatable-usuarios">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Activo</th>
                    <th>Rol</th>
                    <th>Acción</th>
                </tr>
            </thead>
        <tbody></tbody>
    </table>
    
</div>
</div>
<!-- Modal para Crear -->
<div class="modal fade" id="crear-usuario" tabindex="-1" role="dialog" aria-labelledby="modal-crear-usuario" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="modal-crear-usuario">Agregar Usuario</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="formulario-usuario" role="form">
                @csrf
                <div class="form-group">
                    <label for="usuario">{{ __('Nombre Usuario') }}</label>
                    <input id="usuario" type="text" class="form-control" required>
                    <p class="text-danger  " id="error-usuario"></p>
                </div>
                <div class="form-group">
                    <label for="role">{{ __('Tipo de Usuario') }}</label>
                    <select id="role" class="form-control">
                        <option value="">Seleccionar</option>
                        <option value="ROLE_ADMIN">Administrador</option>
                        <option value="ROLE_INSPECTOR">Inspector</option>
                        <option value="ROLE_VENTANILLA">Ventanilla</option>
                    </select>
                    <p class="text-danger  " id="error-role"></p>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="password">{{ __('Contraseña') }}</label>
                            <input id="password" type="password" class="form-control" name="password">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="password-confirm">{{ __('Confirmar Contraseña') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-6">
                        <p class="text-danger " id="error-password"></p>
                    </div>
                </div>
                <hr>
                <div class="form-group row mb-0">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cancelar</button>
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="btn btn-primary btn-block btn-primary-custom" id="btn-enviar">{{ __('Crear Usuario') }}</button>
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
                    <h4>Registro Exitoso</h4>
                    <p>Se ha registrado al usuario correctamente.</p>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
        </div>
    </div>
</div>
</div>
<!-- Modal para Editar -->
<div class="modal fade" id="editar-usuario" tabindex="-1" role="dialog" aria-labelledby="modal-editar-usuario" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="modal-editar-usuario">Editar Usuario</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form class="formulario-usuario" role="form">
                @csrf
                <input type="hidden" id="id-edit">
                <div class="form-group">
                    <label for="usuario-edit">{{ __('Nombre Usuario') }}</label>
                    <input id="usuario-edit" type="text" class="form-control">
                    <p class="text-danger" id="error-usuario-edit"></p>
                </div>
                <div class="form-group">
                    <label for="role-edit">{{ __('Tipo de Usuario') }}</label>
                    <select id="role-edit" class="form-control">
                        <option value="">Seleccionar</option>
                        <option value="ROLE_ADMIN">Administrador</option>
                        <option value="ROLE_INSPECTOR">Inspector</option>
                        <option value="ROLE_VENTANILLA">Ventanilla</option>
                    </select>
                    <p class="text-danger" id="error-role-edit"></p>
                </div>
                <div class="form-group">
                    <label for="activo-edit">{{ __('Estatus') }}</label>
                    <select id="activo-edit" class="form-control">
                        <option value="">Seleccionar</option>
                        <option value="1">Activo</option>
                        <option value="2">Inactivo</option>
                    </select>
                    <p class="text-danger" id="error-activo-edit"></p>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="password-edit">{{ __('Contraseña') }}</label>
                            <input id="password-edit" type="password" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="password-confirm-edit">{{ __('Confirmar Contraseña') }}</label>
                            <input id="password-confirm-edit" type="password" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-6">
                        <p class="text-danger" id="error-password-edit"></p>
                    </div>
                </div>
                <hr>
                <div class="form-group row mb-0">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cancelar</button>
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
<!-- Modal para Eliminar -->
<div class="modal fade" id="desea-eliminar" tabindex="-1" role="dialog" aria-labelledby="modal-desea-eliminar" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="modal-desea-eliminar">¡Cuidado!</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="modal-wrapper">
                <div class="modal-icon">
                    <i class="fas fa-question-circle"></i>
                </div>
                <div class="modal-text">
                    <h4>Eliminar registro</h4>
                    <p>¿Estas seguro que deseas eliminar este registro?</p>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <div class="col-md-12 text-right">
                <button class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button class="btn btn-warning delete-confirm">Si, eliminar</button>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Alerta de eliminación -->
<div class="modal fade" id="eliminacion-correcta" tabindex="-1" role="dialog" aria-labelledby="modal-eliminacion-correcta" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="modal-eliminacion-correcta">Eliminación Exitosa</h3>
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
                    <h4>Eliminación Exitosa</h4>
                    <p>La información se ha eliminado correctamente.</p>
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
<script src="{{ asset('js/user.js') }}" defer></script>
@endsection