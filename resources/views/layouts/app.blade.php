<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Sistema de Fiscalización') }}</title>
        <link href="{{ asset('vendor/fontawesome/css/all.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    </head>
    <body class="admin-body">
        <div id="main">
            <div class="headerbar">
                <div class="headerbar-left">
                    <a href="" class="logo"><img src="{{ asset('img/logotipo.png') }}" /></a>
                </div>
                <nav class="navbar-custom">
                    <ul class="list-inline float-right mb-0">
                        
                        <li class="list-inline-item dropdown notif">
                            <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <p>{{ Auth::user()->usuario }}</p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                                
                                <div class="dropdown-item noti-title">
                                    <h5 class="text-overflow"><small>ADMINISTRADOR</small> </h5>
                                </div>
                                
                                <a class="dropdown-item notify-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="fa fa-power-off"></i> <span>{{ __('Logout') }}</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                
                            </div>
                        </li>
                    </ul>
                    
                </nav>
            </div>
            <div class="left main-sidebar">
                <div class="sidebar-inner leftscroll">
                    <div id="sidebar-menu">
                        <ul>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('listado-inspectores') }}">
                                    <i class="fas fa-clipboard-list"></i>
                                    <span>Catalogo de Inspectores</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('listado-gestores') }}">
                                    <i class="fas fa-folder-open"></i>
                                    <span>Catalogo de Gestores</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('listado-usuarios') }}">
                                    <i class="fas fa-users"></i>
                                    <span>Catalogo de Usuarios</span>
                                </a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="content-page">

                <div class="content">
                    @yield('content')
                    
                </div>
                
                <footer class="footer">
                    <span class="text-right">
                        Copyright <a target="_blank" href="#">Your Website</a>
                    </span>
                    <span class="float-right">
                        Powered by <a target="_blank" href="https://www.pikeadmin.com"><b>Pike Admin</b></a>
                    </span>
                </footer>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        
        
        @yield('scripts')
    </body>
</html>