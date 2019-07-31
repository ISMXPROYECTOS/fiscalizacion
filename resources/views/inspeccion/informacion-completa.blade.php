@extends('layouts.app')
@section('content')
<header class="page-header">
    <h2>Folio de Inspección: {{ $inspeccion->folio }}</h2>
</header>
<h3>Estado de la Inspección</h3>
<div>
    <label for="">Estatus: </label>
    <label for="">{{ $inspeccion->estatusInspeccion->nombre }}</label>
</div>
<form method="POST" action="">
    @csrf
    <div class="card">
        <div class="card-body">
            <h3>Datos del Comercio</h3>
            <hr>
            <div class="form-group ">
                <label for="nombre">{{ __('Nombre del Local') }}</label>
                <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ old('nombre') }}" required autofocus>
                @if ($errors->has('nombre'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('nombre') }}</strong>
                </span>
                @endif
            </div>
            <div class="row mb-3">
                <div class="col-lg-6">
                    <div class="form-group ">
                        <label for="domicilio">{{ __('Domicilio') }}</label>
                        <input id="domicilio" type="text" class="form-control{{ $errors->has('domicilio') ? ' is-invalid' : '' }}" name="domicilio" value="{{ old('domicilio') }}" required autofocus>
                        @if ($errors->has('domicilio'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('domicilio') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="colonia">{{ __('Colonia') }}</label>
                        <select name="colonia" id="colonia" class="form-control{{ $errors->has('colonia') ? ' is-invalid' : '' }}" value="{{ old('colonia') }}" required autofocus>
                            <option value="">Seleccionar</option>
                        </select>
                        @if ($errors->has('colonia'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('colonia') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group ">
                <label for="encargado">{{ __('Nombre del encargado') }}</label>
                <input id="encargado" type="text" class="form-control{{ $errors->has('encargado') ? ' is-invalid' : '' }}" name="encargado" value="{{ old('encargado') }}" autofocus>
                @if ($errors->has('encargado'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('encargado') }}</strong>
                </span>
                @endif
            </div>
            <div class="row mb-3">
                <div class="col-lg-4">
                    <div class="form-group ">
                        <label for="cargo">{{ __('Puesto del encargado') }}</label>
                        <input id="cargo" type="text" class="form-control{{ $errors->has('cargo') ? ' is-invalid' : '' }}" name="cargo" value="{{ old('cargo') }}" autofocus>
                        @if ($errors->has('cargo'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('cargo') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group ">
                        <label for="identificacion">{{ __('Identificación del encargado') }}</label>
                        <input id="identificacion" type="text" class="form-control{{ $errors->has('identificacion') ? ' is-invalid' : '' }}" name="identificacion" value="{{ old('identificacion') }}" autofocus>
                        @if ($errors->has('identificacion'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('identificacion') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group ">
                        <label for="folioidentifiacion">{{ __('Folio de Identificación del encargado') }}</label>
                        <input id="folioidentifiacion" type="text" class="form-control{{ $errors->has('folioidentifiacion') ? ' is-invalid' : '' }}" name="folioidentifiacion" value="{{ old('folioidentifiacion') }}" autofocus>
                        @if ($errors->has('folioidentifiacion'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('folioidentifiacion') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group ">
                        <label for="hora">{{ __('Hora en que se realizo la inspección') }}</label>
                        <input id="hora" type="text" class="form-control{{ $errors->has('hora') ? ' is-invalid' : '' }}" name="hora" value="{{ old('hora') }}" required autofocus>
                        @if ($errors->has('hora'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('hora') }}</strong>
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
            <div>
                <label for="comentario">Comentarios</label>
                <textarea id="comentario" cols="20" rows="5"></textarea>
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
                        <label for="gestor">{{ __('Gestor') }}</label>
                        <select name="gestor" id="gestor" class="form-control{{ $errors->has('gestor') ? ' is-invalid' : '' }}" value="{{ old('gestor') }}" required autofocus>
                            <option value="">Seleccionar</option>
                            @foreach($gestores as $gestor)
                            <option value="{{ $gestor->id}}">{{ $gestor->nombre }} {{ $gestor->apellidopaterno }} {{ $gestor->apellidomaterno }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('gestor'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('gestor') }}</strong>
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