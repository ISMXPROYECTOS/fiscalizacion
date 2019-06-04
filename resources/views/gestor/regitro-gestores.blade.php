@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Agregar Gestor') }}</div>

                <div class="card-body">
                    <form method="POST" action="">
                        @csrf

                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ old('nombre') }}" required autofocus>

                                @if ($errors->has('nombre'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="apellidoPaterno" class="col-md-4 col-form-label text-md-right">{{ __('Apellido Paterno') }}</label>

                            <div class="col-md-6">
                                <input id="apellidoPaterno" type="text" class="form-control{{ $errors->has('apellidoPaterno') ? ' is-invalid' : '' }}" name="apellidoPaterno" value="{{ old('apellidoPaterno') }}" required autofocus>

                                @if ($errors->has('apellidoPaterno'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('apellidoPaterno') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="apellidoMaterno" class="col-md-4 col-form-label text-md-right">{{ __('Apellido Materno') }}</label>

                            <div class="col-md-6">
                                <input id="apellidoMaterno" type="text" class="form-control{{ $errors->has('apellidoMaterno') ? ' is-invalid' : '' }}" name="apellidoMaterno" value="{{ old('apellidoMaterno') }}" required autofocus>

                                @if ($errors->has('apellidoMaterno'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('apellidoMaterno') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telefono" class="col-md-4 col-form-label text-md-right">{{ __('Teléfono') }}</label>

                            <div class="col-md-6">
                                <input id="telefono" type="number" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono" value="{{ old('telefono') }}" required autofocus>

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
                                <input id="celular" type="number" class="form-control{{ $errors->has('celular') ? ' is-invalid' : '' }}" name="celular" value="{{ old('celular') }}" required autofocus>

                                @if ($errors->has('celular'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('celular') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ine" class="col-md-4 col-form-label text-md-right">{{ __('INE') }}</label>

                            <div class="col-md-6">
                                <input id="ine" type="text" class="form-control{{ $errors->has('ine') ? ' is-invalid' : '' }}" name="ine" value="{{ old('ine') }}" required autofocus>

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
                                <select name="estatus" id="estatus" class="form-control{{ $errors->has('estatus') ? ' is-invalid' : '' }}" value="{{ old('estatus') }}" required autofocus>
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
                                    {{ __('Registrar') }}
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
