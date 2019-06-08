@extends('layouts.app')
@section('content')
<header class="page-header">
    <h2>Catalogo de Usuarios</h2>
    
    <div class="right-wrapper text-right">
        <ol class="breadcrumbs">
            <li>
                <a href="index.html">
                    <i class="fas fa-home"></i>
                </a>
            </li>
            <li><span>Pages</span></li>
            <li><span>Blank Page</span></li>
        </ol>
        <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fas fa-chevron-left"></i></a>
    </div>
</header>


<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#crear-usuario">
    <i class="fas fa-user-plus"></i> Agregar Usuario
</button>

<div class="row">
    <div class="col">
        <table class="table table-bordered table-striped mb-0" id="datatable-default">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Activo</th>
                    <th>Rol</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody id="tbody">
                
            </tbody>
        </table>
        
    </div>
</div>


<div class="modal fade" id="crear-usuario" tabindex="-1" role="dialog" aria-labelledby="modal-crear-usuario" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-crear-usuario">Crear Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formulario-usuario">
                @csrf
                <div class="form-group">
                    <label for="usuario">{{ __('Nombre de Usuario') }}</label>
                    <input id="usuario" type="text" class="form-control">
                    
                </div>
                <div class="form-group">
                    <label for="role">{{ __('Tipo de Usuario') }}</label>
                    <select id="role" class="form-control" >
                        <option value="">Seleccionar</option>
                        <option value="ROLE_ADMIN">Administrador</option>
                        <option value="ROLE_INSPECTOR">Inspector</option>
                        <option value="ROLE_VENTANILLA">Ventanilla</option>
                    </select>
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
                            <input id="password-confirm" type="password" class="form-control">
                        </div>
                    </div>
                </div>
                
                <hr>
                <div class="form-group row mb-0">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-default  btn-block" data-dismiss="modal">Cancelar</button>
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="btn btn-primary  btn-block" id="btn-enviar">{{ __('Crear Usuario') }}</button>
                        
                    </div>
                </div>
            </form>
      </div>
    </div>
  </div>
</div>


@endsection
@section('scripts')
<script src="{{ asset('js/user.js') }}" defer></script>
@endsection