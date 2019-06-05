@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="card mb-4 py-3 border-left-primary-custom">
        <div class="card-body">
            <h3 class="m-0 font-weight-bold text-primary-color">{{ __('Catalogo de Usuarios') }}</h3>
        </div>
    </div>
 
    <button type="button" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-success btn-icon-split mb-4 " >
    <span class="icon text-white-50">
        <i class="fas fa-user-plus"></i>
    </span>
    <span class="text">Agregar Usuario</span>
    </button>
    
    <div class="card shadow mb-4 border-bottom-primary-custom">
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="table-head">
                        <tr>
                            <th>Usuario</th>
                            <th>Activo</th>
                            <th>Rol</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tfoot class="table-footer">
                    <tr>
                        <th>Usuario</th>
                        <th>Activo</th>
                        <th>Rol</th>
                        <th>Acción</th>
                    </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                        @if($usuario->id != Auth::user()->id)
                        <tr>
                            <td>{{ $usuario->usuario }}</td>
                            <td>{{ $usuario->activo }}</td>
                            <td>
                                @if ($usuario->role == 'ROLE_ADMIN')
                                <span class="badge badge-success">Administrador</span>
                                @elseif ($usuario->role == 'ROLE_INSPECTOR')
                                <span class="badge badge-warning">Inspector</span>
                                @elseif ($usuario->role == 'ROLE_VENTANILLA')
                                <span class="badge badge-info">Ventanilla</span>
                                @endif
                            </td>
                            <td>
                                <a href="#" class="btn btn-edit btn-sm"><i class="fas fa-edit"></i> </a>
                                <a href="#" class="btn btn-delete btn-sm"><i class="fas fa-trash-alt"></i>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Agregar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('create-usuario') }}" aria-label="{{ __('Registrar') }}">
                        @csrf
                        <div class="form-group">
                            <label for="usuario">{{ __('Nombre de Usuario') }}</label>
                            <input id="usuario" type="text" class="form-control{{ $errors->has('usuario') ? ' is-invalid' : '' }}" name="usuario" value="{{ old('usuario') }}" required autofocus>
                            @if ($errors->has('usuario'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('usuario') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="role">{{ __('Tipo de Usuario') }}</label>
                            <select name="role" id="role" class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" value="{{ old('role') }}" required autofocus>
                                    <option value="">Seleccionar</option>
                                    <option value="ROLE_ADMIN">Administrador</option>
                                    <option value="ROLE_INSPECTOR">Inspector</option>
                                    <option value="ROLE_VENTANILLA">Ventanilla</option>
                                </select>
                            @if ($errors->has('role'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('role') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="password">{{ __('Contraseña') }}</label>
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}" required autofocus>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="password-confirm">{{ __('Confirmar Contraseña') }}</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required >
                                    
                                </div>
                            </div>
                        </div>
                        

                     
                        
                        <hr>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 ">
                                <button type="button" class="btn btn-secondary " data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">{{ __('Crear Usuario') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection