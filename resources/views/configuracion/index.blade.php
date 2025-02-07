@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-light font-weight-bold" style="background:#263572;">
                        Configuracion
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                @can('Roles y permisos')
                                    <div class="col-md-4">
                                        <a href="{{ route('roles_permisos') }}">
                                            <div class="small-box" style="background-color: #1a7db9">
                                                <div class="inner">
                                                    <h3 class="text-light">
                                                        Roles y permisos
                                                    </h3>
                                                    <p style="color:white;">
                                                        Asignación de permisos
                                                    </p>
                                                </div>
                                                <div class="icon">
                                                    <i class="icon icon-key"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endcan
                                @can('Ver procesos')
                                    <div class="col-md-4">
                                        <a href="{{ route('inputs') }}">
                                            <div class="small-box" style="background-color: #1a7db9">
                                                <div class="inner">
                                                    <h3 class="text-light">
                                                        Inputs
                                                    </h3>
                                                    <p style="color:white;">Configuración de "inputs"</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="icon icon-notification"></i>
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
