@extends('layouts.app')
@section('content')
<header class="page-header">
    <h2>Cambiar Contraseña</h2>
</header>
<form method="POST" action="{{ route('actualizar-password') }}">
    @csrf
    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>
        <div class="col-md-6">
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña') }}</label>
        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>
    </div>
    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary btn-primary-custom">
                {{ __('Guardar') }}
            </button>
        </div>
    </div>
</form>
@endsection
@section('scripts')
<script src="{{ asset('js/user.js') }}" defer></script>
@endsection