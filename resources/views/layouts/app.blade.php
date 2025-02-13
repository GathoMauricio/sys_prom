<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/font.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
    <link href="{{ asset('css/alertify.css') }}" rel="stylesheet">
    <link href="{{ asset('css/semantic.css') }}" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed layout-fixed sidebar-collapse ">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand text-light" style="background:#263572;">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-light" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-light" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" data-widget="control-sidebar" data-slide="true" href="#"
                        role="button">
                        <i class="fa fa-user"></i><i class="fa fa-caret-down"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar" style="background:#1a7db9;">
            <!-- Brand Logo -->
            <a href="{{ route('/') }}" class="brand-link" style="text-decoration: none;padding-left:20px;">

                <img src="{{ asset('img/brand.png') }}" alt="logo_prom" class="img-circle p-1" width="40"
                    style="background-color:white;">

                <span
                    class="brand-text font-weight-bold text-light"><strong>{{ config('app.name', 'Laravel') }}</strong></span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{ route('/') }}"
                                class="text-light nav-link @if (Route::currentRouteName() == '/') active @endif">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>inicio</p>
                            </a>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                @if (Session::has('message'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('message') }}
                    </div>
                @endif
                <br>
                @yield('content')
            </div>
        </div>
        <!-- /.content-wrapper -->
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                @if (@Auth::user()->hasPermissionTo('Roles y permisos'))
                    <a href="{{ route('roles_permisos') }}">
                        <i class="icon-key"></i> Roles y permisos
                    </a><br /><br />
                @endif
                <a href="#"
                    onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                    <i class="icon-exit"></i> Cerrar sesión
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                {{ Auth::user()->Nombre }}
            </div>

            <!-- Default to the left -->
            <strong>Copyright &copy; {{ date('Y') }} All rights reserved. | Laravel
                v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </footer>
    </div>
    <!-- ./wrapper -->
    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('js/alertify.js') }}" type="text/javascript"></script>
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.1.2/dist/select2-bootstrap-5-theme.min.css"
        rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/manuelmhtr/validate-rfc@latest/dist/index.js" type="text/javascript"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @yield('custom_scripts')
    <!-- Ajax Routes -->
    <input type="hidden" id="r_empleados_sysprom" value="{{ route('empleados_sysprom') }}">
    <input type="hidden" id="r_validar_rfc_sat" value="{{ route('validar_rfc_sat') }}">
    <input type="hidden" id="r_ajax_configuraciones" value="{{ route('ajax_configuraciones') }}">
    <input type="hidden" id="r_validar_rfc_sat" value="{{ route('validar_rfc_sat') }}">
    <input type="hidden" id="r_validar_rfc_sistema" value="{{ route('validar_rfc_sistema') }}">
    <input type="hidden" id="r_alta_empleado" value="{{ route('alta_empleado') }}">
    <input type="hidden" id="r_seguimiento_empleado" value="{{ route('seguimiento_empleado') }}">
    <input type="hidden" id="r_reingreso_sicoss_empleado" value="{{ route('reingreso_sicoss_empleado') }}">
    <input type="hidden" id="r_reingreso_sysprom_empleado" value="{{ route('reingreso_sysprom_empleado') }}">
    <input type="hidden" id="r_get_sepomex" value="{{ route('get_sepomex') }}">
    <input type="hidden" id="r_get_planes" value="{{ route('get_planes') }}">
    <input type="hidden" id="r_validar_nss_alta" value="{{ route('validar_nss_alta') }}">
    <input type="hidden" id="r_get_seguimientos" value="{{ route('get_seguimientos') }}">
    <input type="hidden" id="r_aprobar_documentacion" value="{{ route('aprobar_documentacion') }}">
    <input type="hidden" id="r_aprobar_documento" value="{{ route('aprobar_documento') }}">
    <input type="hidden" id="r_rechazar_documento" value="{{ route('rechazar_documento') }}">
    <input type="hidden" id="r_aprobar_proceso" value="{{ route('aprobar_proceso') }}">
    <input type="hidden" id="r_rechazar_proceso" value="{{ route('rechazar_proceso') }}">
    <input type="hidden" id="r_actualizar_movimiento" value="{{ route('actualizar_movimiento') }}">
    <input type="hidden" id="r_generar_baja" value="{{ route('generar_baja') }}">
    <input type="hidden" id="r_enviar_lista_negra" value="{{ route('enviar_lista_negra') }}">
    <input type="hidden" id="r_quitar_lista_negra" value="{{ route('quitar_lista_negra') }}">
    <input type="hidden" id="r_eliminar_empleado" value="{{ route('eliminar_empleado') }}">
    <input type="hidden" id="r_validar_importacion" value="{{ route('validar_importacion') }}">
    <input type="hidden" id="r_importar_empleado" value="{{ route('importar_empleado') }}">
</body>

</html>
