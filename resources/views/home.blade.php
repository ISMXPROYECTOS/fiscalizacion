@extends('layouts.app')

@section('content')

<div class="container">
    <div class="jumbotron bg-white">

    <div class="row text-center">
        <div class="col-lg-6">
            <img src="{{ asset('img/logotipo-bienvenida.jpg') }}" width="80%" />
        </div>
        <div class="col-lg-6">
            <h1 class="display-4 mt-4" style="color: #4b1617"><b>BIENVENIDO</b></h1>
            <p class="lead" style="color: #4b1617">Has iniciado sesión correctamente</p>
        </div>
        
    </div>
  
  
</div>
</div>


<!--
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bienvenido</div>

                <div class="card-body">
                    {{ Session::get('error')}}
                    {{ session('status') }}
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                             {{ Session::get('error')}}
                        </div>
                    @endif

                   Haz iniciado sesión correctamente 
                </div>
            </div>
        </div>
    </div>
</div>-->
@endsection
