<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="fixed">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Sistema de Fiscalización') }}</title>
        <!-- Web Fonts  -->
        <!--<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">-->
        <!-- Vendor CSS -->
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.css') }}" />
        <link rel="stylesheet" href="{{ asset('vendor/animate/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/fontawesome/css/all.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('vendor/magnific-popup/magnific-popup.css') }}" />
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}" />
        <!-- Specific Page Vendor CSS -->
        <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.css') }}" />
        <link rel="stylesheet" href="{{ asset('vendor/select2-bootstrap-theme/select2-bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('vendor/datatables/media/css/dataTables.bootstrap4.css') }}" />
        <!-- Theme CSS -->
        <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
        <!-- Skin CSS -->
        <link rel="stylesheet" href="{{ asset('css/skins/default.css') }}" />
        <!-- Theme Custom CSS -->
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        <!-- Head Libs -->
        <script src="{{ asset('vendor/modernizr/modernizr.js') }}"></script>
    </head>
    <body>
        <section class="body">
            <!-- start: header -->
            <header class="header">
                <div class="logo-container">
                    <a href="{{ route('home') }}" class="logo"><img src="{{ asset('img/logotipo.png') }}"  width="30%"/></a>
                    <div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
                        <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
                    </div>
                </div>
                
                <!-- start: search & user box -->
                <div class="header-right">
                    <span id="ultima-sesion-dt">Ultima sesion: <b>{{ auth()->user()->ultimasesion->format('D j M Y, h:i:s A') }}</b></span>
                    
                    <span class="separator"></span>
                    
                    <div id="userbox" class="userbox">
                        <a href="#" data-toggle="dropdown">
                            <!--<figure class="profile-picture">
                                <img src="img/!logged-user.jpg" alt="Joseph Doe" class="rounded-circle" data-lock-picture="img/!logged-user.jpg" />
                            </figure>-->
                            <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
                                <span class="name">{{ Auth::user()->usuario }}</span>
                                @if( Auth::user()->role == 'ROLE_ADMIN')
                                <span class="role">Administrador</span>
                                @elseif( Auth::user()->role == 'ROLE_INSPECTOR')
                                <span class="role">Inspector</span>
                                @elseif( Auth::user()->role == 'ROLE_VENTANILLA')
                                <span class="role">Ventanilla</span>
                                @endif
                            </div>
                            
                            <i class="fa custom-caret"></i>
                        </a>
                        
                        <div class="dropdown-menu">
                            <ul class="list-unstyled mb-2">
                                <li class="divider"></li>
                                <li>
                                    <a role="menuitem" tabindex="-1" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        <i class="fas fa-power-off"></i>
                                        <span>{{ __('Cerrar sesión') }}</span>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- end: search & user box -->
            </header>
            <!-- end: header -->
            <div class="inner-wrapper">
                <!-- start: sidebar -->
                <aside id="sidebar-left" class="sidebar-left">
                    
                    <div class="sidebar-header">
                        <div class="sidebar-title">
                            Panel de Control
                        </div>
                        <div class="sidebar-toggle d-none d-md-block" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
                            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
                        </div>
                    </div>
                    
                    <div class="nano">
                        <div class="nano-content">
                            <nav id="menu" class="nav-main" role="navigation">
                                
                                <ul class="nav nav-main">
                                    <li class="nav-parent">
                                        <a class="nav-link" href="#">
                                            <i class="fas fa-th-list"></i>
                                            <span>Catalogos</span>
                                        </a>
                                        <ul class="nav nav-children">
                                            
                                            <li>
                                                <a class="nav-link" href="{{ route('listado-inspectores') }}">
                                                    
                                                    <span>Inspectores</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="nav-link" href="{{ route('listado-gestores') }}">
                                                    
                                                    <span>Gestores</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="nav-link" href="{{ route('listado-inspecciones') }}">
                                                    <span>Inspecciones</span>
                                                </a>
                                            </li>
                                            @if(Auth::user()->role == "ROLE_ADMIN")
                                            <li>
                                                <a class="nav-link" href="{{ route('listado-usuarios') }}">
                                                    <span>Usuarios</span>
                                                </a>
                                            </li>
                                            @endif
                                            <li>
                                                <a class="nav-link" href="{{ route('listado-colonias') }}">
                                                    <span>Colonias</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="nav-link" href="{{ route('listado-tipo-inspecciones') }}">
                                                    
                                                    <span>Tipo de Inspecciones</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="nav-link" href="{{ route('listado-estatus-inspecciones') }}">
                                                    
                                                    <span>Estatus de Inspecciones</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="nav-link" href="{{ route('listado-documentacion') }}">
                                                    
                                                    <span>Documentacion requerida</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="nav-link" href="#">
                                                    
                                                    <span>Giros y Subgiros comerciales</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="{{ route('listado-encargados') }}">
                                            <i class="fas fa-users"></i>
                                            <span>Encargados</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="{{ route('listado-comercios') }}">
                                            <i class="fas fa-store"></i>
                                            <span>Comercios</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="{{ route('listado-ejercicios-fiscales') }}">
                                            <i class="fas fa-calendar-alt"></i>
                                            <span>Años fiscales y dias inhabiles</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="{{ route('vista-agregar-inspecciones') }}">
                                            <i class="fas fa-folder-plus"></i>
                                            <span>Generar Inspección</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="{{ route('vista-agregar-inspecciones-por-zona') }}">
                                            <i class="fas fa-folder-plus"></i>
                                            <span>Generar Inspección Por SM</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="{{ route('vista-asignar-inspecciones') }}">
                                            <i class="fas fa-arrow-alt-circle-right"></i>
                                            <span>Asignar Inspección</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="{{ route('listado-de-inspecciones-para-descargar') }}">
                                            <i class="fas fa-file-pdf"></i>
                                            <span>Descargar Inspecciones</span>
                                        </a>
                                    </li>
                                    <li class="nav-parent">
                                        <a class="nav-link" href="#">
                                            <i class="fas fa-wrench"></i>
                                            <span>Configuración</span>
                                        </a>
                                        <ul class="nav nav-children">
                                            <li>
                                                <a class="nav-link" href="{{ route('cambiar-password') }}">
                                                    Cambiar contraseña
                                                </a>
                                            </li>
                                            <li>
                                                <a class="nav-link" role="menuitem" tabindex="-1" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                                    <span>{{ __('Cerrar sesión') }}</span>
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                                    <ul>
                                    </nav>
                                    <hr class="separator" id="separator" />
                                    
                                    <div class="sidebar-widget widget-tasks" id="ultima-sesion-mv">
                                        <div class="widget-header">
                                            <h6 class="text-white">Ultima sesión</h6>
                                        </div>
                                        <div class="widget-content">
                                            <span class="text-white">{{ auth()->user()->ultimasesion->format('D j M Y, h:i:s A') }}</span>
                                        </div>
                                    </div>
                                    
                                </div>
                                <script>
                                // Maintain Scroll Position
                                if (typeof localStorage !== 'undefined') {
                                if (localStorage.getItem('sidebar-left-position') !== null) {
                                var initialPosition = localStorage.getItem('sidebar-left-position'),
                                sidebarLeft = document.querySelector('#sidebar-left .nano-content');
                                sidebarLeft.scrollTop = initialPosition;
                                }
                                }
                                </script>
                            </div>
                        </aside>
                        <!-- end: sidebar -->
                        <section role="main" class="content-body">
                            <!-- start: page -->
                            @yield('content')
                            <!-- end: page -->
                        </section>
                    </div>
                </section>
                <!-- Vendor -->
                <script src="{{ asset('vendor/jquery/jquery.js') }}"></script>
                <script src="{{ asset('vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
                <script src="{{ asset('vendor/popper/umd/popper.min.js') }}"></script>
                <script src="{{ asset('vendor/bootstrap/js/bootstrap.js') }}"></script>
                <script src="{{ asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
                <script src="{{ asset('vendor/common/common.js') }}"></script>
                <script src="{{ asset('vendor/nanoscroller/nanoscroller.js') }}"></script>
                <script src="{{ asset('vendor/magnific-popup/jquery.magnific-popup.js') }}"></script>
                <script src="{{ asset('vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>
                <!-- Specific Page Vendor -->
                <script src="{{ asset('vendor/select2/js/select2.js') }}"></script>
                <script src="{{ asset('vendor/datatables/media/js/jquery.dataTables.min.js') }}"></script>
                <script src="{{ asset('vendor/datatables/media/js/dataTables.bootstrap4.min.js') }}"></script>
                <script src="{{ asset('vendor/datatables/extras/TableTools/Buttons-1.4.2/js/dataTables.buttons.min.js') }}"></script>
                <script src="{{ asset('vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.bootstrap4.min.js') }}"></script>
                <script src="{{ asset('vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.html5.min.js') }}"></script>
                <script src="{{ asset('vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.print.min.js') }}"></script>
                <script src="{{ asset('vendor/datatables/extras/TableTools/JSZip-2.5.0/jszip.min.js') }}"></script>
                <script src="{{ asset('vendor/datatables/extras/TableTools/pdfmake-0.1.32/pdfmake.min.js') }}"></script>
                <script src="{{ asset('vendor/datatables/extras/TableTools/pdfmake-0.1.32/vfs_fonts.js') }}"></script>
                <!-- Theme Base, Components and Settings -->
                <script src="{{ asset('js/theme.js') }}"></script>
                <!-- Theme Custom -->
                <script src="{{ asset('js/custom.js') }}"></script>
                <!-- Theme Initialization Files -->
                <script src="{{ asset('js/theme.init.js') }}"></script>
                
                <script src="{{ asset('js/examples/examples.modals.js') }} "></script>
                <script src="{{ asset('js/navbar.js') }} "></script>
                @yield('scripts')
            </body>
        </html>