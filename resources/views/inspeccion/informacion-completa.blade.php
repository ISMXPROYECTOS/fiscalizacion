@extends('layouts.app')
@section('content')
<header class="page-header">
    <h2>Folio de Inspección: {{ $inspeccion->folio }}</h2>
</header>
<h3>Estado de la Inspección</h3>
@if(is_object($inspeccion->estatusInspeccion))
<div>
    <label for="">Estatus: </label>
    <label for="">{{ $inspeccion->estatusInspeccion->nombre }}</label>
</div>
@endif
<form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
    @csrf
    <div class="card">
        <div class="card-body">
            <h3>Datos del Comercio</h3>
            <hr>
            <div class="form-group ">
                <label for="usuario">{{ __('Nombre del Local') }}</label>
                <input id="usuario" type="text" class="form-control{{ $errors->has('usuario') ? ' is-invalid' : '' }}" name="usuario" value="{{ old('usuario') }}" required autofocus>
                @if ($errors->has('usuario'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('usuario') }}</strong>
                </span>
                @endif
            </div>
            <div class="row mb-3">
                <div class="col-lg-6">
                    <div class="form-group ">
                        <label for="usuario">{{ __('Domicilio') }}</label>
                        <input id="usuario" type="text" class="form-control{{ $errors->has('usuario') ? ' is-invalid' : '' }}" name="usuario" value="{{ old('usuario') }}" required autofocus>
                        @if ($errors->has('usuario'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('usuario') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="role">{{ __('Colonia') }}</label>
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
                </div>
            </div>
            <div class="form-group ">
                <label for="usuario">{{ __('Nombre del encargado') }}</label>
                <input id="usuario" type="text" class="form-control{{ $errors->has('usuario') ? ' is-invalid' : '' }}" name="usuario" value="{{ old('usuario') }}" required autofocus>
                @if ($errors->has('usuario'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('usuario') }}</strong>
                </span>
                @endif
            </div>
            <div class="row mb-3">
                <div class="col-lg-4">
                    <div class="form-group ">
                        <label for="usuario">{{ __('Puesto del encargado') }}</label>
                        <input id="usuario" type="text" class="form-control{{ $errors->has('usuario') ? ' is-invalid' : '' }}" name="usuario" value="{{ old('usuario') }}" required autofocus>
                        @if ($errors->has('usuario'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('usuario') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group ">
                        <label for="usuario">{{ __('Identificación del encargado') }}</label>
                        <input id="usuario" type="text" class="form-control{{ $errors->has('usuario') ? ' is-invalid' : '' }}" name="usuario" value="{{ old('usuario') }}" required autofocus>
                        @if ($errors->has('usuario'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('usuario') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group ">
                        <label for="usuario">{{ __('Folio de Identificación del encargado') }}</label>
                        <input id="usuario" type="text" class="form-control{{ $errors->has('usuario') ? ' is-invalid' : '' }}" name="usuario" value="{{ old('usuario') }}" required autofocus>
                        @if ($errors->has('usuario'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('usuario') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group ">
                        <label for="usuario">{{ __('Hora en que se realizo la inspección') }}</label>
                        <input id="usuario" type="text" class="form-control{{ $errors->has('usuario') ? ' is-invalid' : '' }}" name="usuario" value="{{ old('usuario') }}" required autofocus>
                        @if ($errors->has('usuario'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('usuario') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h3>Documentación Presentada</h3>
            <hr>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    Aqui ira la documentación
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    Aqui ira la documentación
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    Aqui ira la documentación
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    Aqui ira la documentación
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    Aqui ira la documentación
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    Aqui ira la documentación
                </label>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Gestor a cargo</h3>
                    <hr>
                    <div class="form-group">
                        <label for="role">{{ __('Gestor') }}</label>
                        <select name="role" id="role" class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" value="{{ old('role') }}" required autofocus>
                            <option value="">Seleccionar</option>
                            @foreach($gestores as $gestor)
                            <option value="{{ $gestor->id}}">{{ $gestor->nombre }} {{ $gestor->apellidopaterno }} {{ $gestor->apellidomaterno }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('role'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('role') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div id="datos-gestor">
                        <p class="mb-0">Telefono: <b id="telefono-gestor"></b></p>
                        <p class="mb-0">Celular: <b id="celular-gestor"></b></p>
                        <p class="mb-0">Correo: <b id="correo-gestor"></b></p>
                        <p class="mb-0">Identificación (INE): <b id="identificacion-gestor"></b></p>
                        <p class="mb-0">Estado: <b id="estatus-gestor"></b></p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h3>Prorroga </h3>
                    <hr>
                    <div class="form-group ">
                        <label for="usuario">{{ __('Dias de Prorroga') }}</label>
                        <input id="usuario" type="text" class="form-control{{ $errors->has('usuario') ? ' is-invalid' : '' }}" name="usuario" value="{{ old('usuario') }}" required autofocus>
                        @if ($errors->has('usuario'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('usuario') }}</strong>
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