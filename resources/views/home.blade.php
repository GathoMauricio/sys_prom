@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-light font-weight-bold" style="background:#263572;">
                        Inicio
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                @can('Reclutar empleado')
                                    <div class="col-md-4">
                                        <a href="javascript:void(0);" onclick="procesoAltaReingreso();">
                                            <div class="small-box" style="background-color: #1a7db9">
                                                <div class="inner">
                                                    <h3 class="text-light">
                                                        Iniciar proceso
                                                    </h3>
                                                    <p style="color:white;">de Alta / Reingreso</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="icon icon-user-plus"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endcan
                                @can('Ver procesos')
                                    <div class="col-md-4">
                                        <a href="{{ route('procesos') }}">
                                            <div class="small-box" style="background-color: #1a7db9">
                                                <div class="inner">
                                                    <h3 class="text-light">
                                                        {{ $procesos }} Procesos
                                                    </h3>
                                                    <p style="color:white;">En etapa de precontratación</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="icon icon-quotes-left"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endcan
                                @can('Ver movimientos')
                                    <div class="col-md-4">
                                        <a href="{{ route('movimientos') }}">
                                            <div class="small-box" style="background-color: #1a7db9">
                                                <div class="inner">
                                                    <h3 class="text-light">
                                                        {{ $movimientos }} Movimientos
                                                    </h3>
                                                    <p style="color:white;">TXT por procesar</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="icon icon-download"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endcan
                                @can('Ver empleados sysprom')
                                    <div class="col-md-4">
                                        <a href="{{ route('empleados_sysprom') }}">
                                            <div class="small-box" style="background-color: #1a7db9">
                                                <div class="inner">
                                                    <h3 class="text-light">
                                                        {{ number_format($empleados_sysprom) }}
                                                    </h3>
                                                    <p style="color:white;">Empleados SysProm</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="icon  icon-address-book"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endcan
                                @can('Ver empleados sicoss')
                                    <div class="col-md-4">
                                        <a href="{{ route('empleados_sicoss') }}">
                                            <div class="small-box" style="background-color: #1a7db9">
                                                <div class="inner">
                                                    <h3 class="text-light">
                                                        {{ number_format($empleados_sicoss) }}
                                                    </h3>
                                                    <p style="color:white;">Empleados SICOSS</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="icon icon-address-book"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endcan
                                @can('Ver usuarios')
                                    <div class="col-md-4">
                                        <a href="{{ route('user') }}">
                                            <div class="small-box" style="background-color: #1a7db9">
                                                <div class="inner">
                                                    <h3 class="text-light">
                                                        {{ number_format($usuarios_sysprom) }}
                                                    </h3>
                                                    <p style="color:white;">Usuarios</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="icon icon-users"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endcan
                                @can('Ver configuracion')
                                    <div class="col-md-4">
                                        <a href="{{ route('configuracion') }}">
                                            <div class="small-box" style="background-color: #1a7db9">
                                                <div class="inner">
                                                    <h3 class="text-light">
                                                        Configuración
                                                    </h3>
                                                    <p style="color:white;">Del Sistema</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="icon icon-cog"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('empleado.valida_rfc_modal')
@endsection
