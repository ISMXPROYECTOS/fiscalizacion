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

<a class="mb-3 mt-1 mr-1 modal-with-zoom-anim ws-normal btn btn-default" href="#agregarUsuario"><i class="fas fa-user-plus"></i> Agregar Usuario</a>

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
<div id="agregarUsuario" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
    <section class="card">
        <header class="card-header">
            <h2 class="card-title">Agregar Usuario</h2>
        </header>
        <div class="card-body">
            <form class="formulario-usuario">
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
                        <button type="button" class="btn btn-default modal-dismiss btn-block" >Cancelar</button>
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="btn btn-primary modal-confirm btn-block" id="btn-enviar">{{ __('Crear Usuario') }}</button>
                        
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/user.js') }}" defer></script>
@endsection