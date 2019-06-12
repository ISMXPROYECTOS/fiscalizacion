@extends('layouts.login')
@section('content')
<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">
            <a href="" class="logo"><img src="{{ asset('img/logotipo.png') }}"  width="135"/></a>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse text-right " id="navbarSupportedContent">
            <ul class="mr-auto"></ul>
            <span class="navbar-text ">
                SISTEMA DE FISCALIZACIÓN
            </span>
        </div>
    </div>
    
</nav>
<!-- start: page -->
<section class="body-sign">
    <div class="center-sign">
        <div class="card" id="card-login">
            <div class="card-header text-center">
                <h3><b>BIENVENIDO</b></h3>
                <h5>Porfavor, ingresa tus datos</h5>
            </div>
            <div class="card-body">

                <div class="alert alert-danger" role="alert" id="alert-login">
                  
                </div>
                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}" id="formulario-login">
                    @csrf
                    <div class="form-group mb-3">
                        <label>Usuario</label>
                        <div class="input-group">
                            <input id="usuario-login" name="usuario" type="text" class="form-control form-control-lg{{ $errors->has('usuario') ? ' is-invalid' : '' }}" value="{{ old('usuario') }}" required />
                            <span class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </span>
                            </span>
                            @if ($errors->has('usuario'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('usuario') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="clearfix">
                            <label class="float-left">Contraseña</label>
                            
                        </div>
                        <div class="input-group">
                            <input id="password-login" name="password" type="password" class="form-control form-control-lg{{ $errors->has('password') ? ' is-invalid' : '' }}" required />
                            <span class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </span>
                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary mt-2 btn-block btn-primary-custom text-white" id="btn-login">{{ __('Iniciar Sesión') }}</button>
                            </div>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
        <p class="text-center text-muted mt-3 mb-3">&copy; H. Ayuntamiento de Benito Juárez 2018 - 2021. </p>
    </div>
</section>
<!-- end: page -->
@endsection

@section('scripts')
<script src="{{ asset('js/verificar-usuario.js') }}" defer></script>
@endsection