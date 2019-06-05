@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if(isset($gestor) && is_object($gestor))
                    <div class="card-header">{{ __('Editar Gestor') }}</div>
                @else
                    <div class="card-header">{{ __('Agregar Gestor') }}</div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ isset($gestor) ? route('gestor-update') : route('gestor-create') }}">
                        @csrf

                        @if(isset($gestor) && is_object($gestor))
                            <input type="hidden" name="id" value="{{ $gestor->id }}">
                        @endif

                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ $gestor->nombre or '' }}" required autofocus>

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
                                <input id="apellidopaterno" type="text" class="form-control{{ $errors->has('apellidopaterno') ? ' is-invalid' : '' }}" name="apellidopaterno" value="{{ $gestor->apellidopaterno or '' }}" required autofocus>

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
                                <input id="apellidomaterno" type="text" class="form-control{{ $errors->has('apellidomaterno') ? ' is-invalid' : '' }}" name="apellidomaterno" value="{{ $gestor->apellidomaterno or '' }}" required autofocus>

                                @if ($errors->has('apellidomaterno'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('apellidomaterno') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telefono" class="col-md-4 col-form-label text-md-right">{{ __('Teléfono') }}</label>

                            <div class="col-md-6">
                                <input id="telefono" type="number" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono" value="{{ $gestor->telefono or '' }}" required autofocus>

                                @if ($errors->has('telefono'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('telefono') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="celular" class="col-md-4 col-form-label text-md-right">{{ __('Celular') }}</label>

                            <div class="col-md-6">
                                <input id="celular" type="number" class="form-control{{ $errors->has('celular') ? ' is-invalid' : '' }}" name="celular" value="{{ $gestor->celular or '' }}" required autofocus>

                                @if ($errors->has('celular'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('celular') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="correoelectronico" class="col-md-4 col-form-label text-md-right">{{ __('E-mail') }}</label>

                            <div class="col-md-6">
                                <input id="correoelectronico" type="correoelectronico" class="form-control{{ $errors->has('correoelectronico') ? ' is-invalid' : '' }}" name="correoelectronico" value="{{ $gestor->correoelectronico or '' }}" required>

                                @if ($errors->has('correoelectronico'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('correoelectronico') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ine" class="col-md-4 col-form-label text-md-right">{{ __('INE') }}</label>

                            <div class="col-md-6">
                                <input id="ine" type="text" class="form-control{{ $errors->has('ine') ? ' is-invalid' : '' }}" name="ine" value="{{ $gestor->ine or '' }}" required autofocus>

                                @if ($errors->has('ine'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('ine') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="estatus" class="col-md-4 col-form-label text-md-right">{{ __('Estatus') }}</label>

                            <div class="col-md-6">
                                <select name="estatus" id="estatus" class="form-control{{ $errors->has('estatus') ? ' is-invalid' : '' }}" value="{{ $gestor->estatus or '' }}" required autofocus>
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
