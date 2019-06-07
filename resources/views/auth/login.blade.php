@extends('layouts.login')

@section('content')

<div class="container">

  <!-- Outer Row -->
  <div class="row justify-content-center">

    <img src="{{ asset('img/logotipo-oficial.jpeg') }}" class="logotipo-login" alt="">

    <div class="col-lg-5">

      <div class="card o-hidden border-0 shadow-sm mtb-50">

        <div class="card-header">
          <div class="text-center">
            <h1 class="h4 text-white">Ingresa tus datos</h1>
          </div>
        </div>
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">


            <div class="col-lg-12 col-md-12">
              <div class="p-5">



                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                  @csrf

                  <div class="form-group">
                    <input id="usuario" type="text" class="form-control{{ $errors->has('usuario') ? ' is-invalid' : '' }}" name="usuario" value="{{ old('usuario') }}" required autofocus placeholder="Nombre de usuario">

                    @if ($errors->has('usuario'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('usuario') }}</strong>
                        </span>
                    @endif
                  </div>

                  <div class="form-group">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Contraseña">

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                  </div>

                  <!--<div class="form-group row">
                      <div class="col-md-6 offset-md-4">
                          <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                              <label class="form-check-label" for="remember">
                                  {{ __('Remember Me') }}
                              </label>
                          </div>
                      </div>
                  </div>-->

                  <div class="form-group row mb-0">
                      <div class="col-md-12 ">
                          <button type="submit" class="btn btn-primary btn-user btn-block">
                              {{ __('Iniciar Sesión') }}
                          </button>
                      </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="text-center">
        <p>Sistema de Fiscalización <br> 2019 &copy; H. Ayuntamiento de Benito Juárez </p>
      </div>
    </div>
  </div>
</div>
@endsection
