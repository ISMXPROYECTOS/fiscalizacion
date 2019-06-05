@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if(isset($inspector) && is_object($inspector))
                    <div class="card-header">{{ __('Editar Inspector') }}</div>
                @else
                    <div class="card-header">{{ __('Agregar Inspector') }}</div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ isset($inspector) ? route('inspector-update') : route('inspector-create') }}">
                        @csrf
                        
                        @if(isset($inspector) && is_object($inspector))
                            <input type="hidden" name="id" value="{{ $inspector->id }}">
                        @endif

                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ $inspector->nombre or '' }}" required autofocus>

                                @if ($errors->has('nombre'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="apellidopaterno" class="col-md-4 col-form-label text-md-right">{{ __('Apellido Paterno') }}</label>

                            <div class="col-md-6">
                                <input id="apellidopaterno" type="text" class="form-control{{ $errors->has('apellidopaterno') ? ' is-invalid' : '' }}" name="apellidopaterno" value="{{ $inspector->apellidopaterno or '' }}" required autofocus>

                                @if ($errors->has('apellidopaterno'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('apellidopaterno') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="apellidomaterno" class="col-md-4 col-form-label text-md-right">{{ __('Apellido Materno') }}</label>

                            <div class="col-md-6">
                                <input id="apellidomaterno" type="text" class="form-control{{ $errors->has('apellidomaterno') ? ' is-invalid' : '' }}" name="apellidomaterno" value="{{ $inspector->apellidopaterno or '' }}" required autofocus>

                                @if ($errors->has('apellidomaterno'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('apellidomaterno') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="clave" class="col-md-4 col-form-label text-md-right">{{ __('Clave') }}</label>

                            <div class="col-md-6">
                                <input id="clave" type="text" class="form-control{{ $errors->has('clave') ? ' is-invalid' : '' }}" name="clave" value="{{ $inspector->clave or '' }}" required autofocus>

                                @if ($errors->has('clave'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('clave') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="estatus" class="col-md-4 col-form-label text-md-right">{{ __('Estatus') }}</label>

                            <div class="col-md-6">
                                <select name="estatus" id="estatus" class="form-control{{ $errors->has('estatus') ? ' is-invalid' : '' }}" value="{{ $inspector->estatus or '' }}" required autofocus>
                                    <option value="">Seleccionar</option>
                                    <option value="A">Activo</option>
                                    <option value="B">Baja</option>
                                    <option value="S">Suspendido</option>
                                    <option value="V">Vigente</option>
                                </select>

                                @if ($errors->has('estatus'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('estatus') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Guardar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
