@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-light font-weight-bold" style="background:#263572;">
                        Detalles del empleado
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8 p-3 boxshadow">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Nombre</label>
                                                    <br>
                                                    {{ $empleado->nombre }}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>A. Paterno</label>
                                                    <br>
                                                    {{ $empleado->apaterno }}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>A. Materno</label>
                                                    <br>
                                                    {{ $empleado->amaterno }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Fecha de Nacimiento</label>
                                                    <br>
                                                    {{ $empleado->fecha_nacimiento }}
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>estado de Nacimiento</label>
                                                    <br>
                                                    {{ $empleado->estado_nacimiento }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Número de Seguro Social</label>
                                                    <br>
                                                    {{ $empleado->nss }}
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Registro Federal de Causantes</label>
                                                    <br>
                                                    {{ $empleado->rfc }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>CódigoPostal</label>
                                                <br>
                                                {{ $empleado->cp }}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Estado</label>
                                                <br>
                                                {{ $empleado->estado }}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Municipio</label>
                                                <br>
                                                {{ $empleado->delegacion }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Colonia</label>
                                                <br>
                                                {{ $empleado->colonia }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Calle y Número</label>
                                                <br>
                                                {{ $empleado->calle_numero }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Teléfono de Casa</label>
                                                <br>
                                                {{ $empleado->telefono_casa }}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Teléfono Celular</label>
                                                <br>
                                                {{ $empleado->telefono_celular }}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Correo Electrónico</label>
                                                <br>
                                                {{ $empleado->email }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 p-3 boxshadow d-flex flex-column">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Estatus</label>
                                                    <br>
                                                    {{ $empleado->estatus }}
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Último proceso</label>
                                                    <br>
                                                    @if (count($empleado->procesos) > 0)
                                                        <a
                                                            href="{{ route('captura_empleado_proceso', base64_encode($empleado->procesos[0]->id)) }}">{{ explode(' ', $empleado->procesos[0]->created_at)[0] }}</a>
                                                    @else
                                                        No hay movimientos aún
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Lista negra</label>
                                                    <br>
                                                    @if (count($empleado->lista_negra) > 0)
                                                        SI
                                                    @else
                                                        NO
                                                    @endif
                                                </div>
                                            </div>
                                            @if (count($empleado->lista_negra) > 0)
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Motivo</label>
                                                        <br>
                                                        {{ $empleado->lista_negra[0]->motivo }}
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="container mt-auto">
                                        <div class="row">
                                            @can('Generar proceso de baja')
                                                @if ($empleado->estatus == 'Contrato')
                                                    <div class="col-md-12 p-1">
                                                        <a href="javascript:void(0);"
                                                            onclick="generarBaja({{ $empleado->procesos[0]->id }})"
                                                            class="btn btn-primary btn-block">
                                                            Generar Proceso de Baja
                                                        </a>
                                                    </div>
                                                @endif
                                            @endcan
                                            <div class="col-md-12 p-1">
                                                @if (count($empleado->lista_negra) > 0)
                                                    @can('Quitar empleado de lista negra')
                                                        <a href="javascript:void(0);"
                                                            onclick="quitarListaNegra({{ $empleado->id }});"
                                                            class="btn btn-warning btn-block">
                                                            Quitar Empleado de Lista Negra
                                                        </a>
                                                    @endcan
                                                @else
                                                    @can('Enviar empleado a lista negra')
                                                        <a href="javascript:void(0);"
                                                            onclick="enviarListaNegra({{ $empleado->id }});"
                                                            class="btn btn-warning btn-block">
                                                            Enviar Empleado a Lista Negra
                                                        </a>
                                                    @endcan
                                                @endif
                                            </div>
                                            <div class="col-md-12 p-1">
                                                <a href="javascript:void(0);"
                                                    onclick="eliminarEmpleado({{ $empleado->id }});"
                                                    class="btn btn-danger btn-block">
                                                    Eliminar Empleado del Sistema
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br><br>
                                <div class="row p-3">
                                    @include('empleado.card_seguimiento_documento', [
                                        'model' => $empleado,
                                        'var_documento' => 'doc_solicitud_empleo',
                                        'nombre_documento' => 'Solicitud de Empleo',
                                        'editar_documento' => false,
                                    ])
                                    @include('empleado.card_seguimiento_documento', [
                                        'model' => $empleado,
                                        'var_documento' => 'doc_fotografia',
                                        'nombre_documento' => 'Fotografía',
                                        'editar_documento' => false,
                                    ])
                                    @include('empleado.card_seguimiento_documento', [
                                        'model' => $empleado,
                                        'var_documento' => 'doc_ine',
                                        'nombre_documento' => 'INE',
                                        'editar_documento' => false,
                                    ])
                                    @include('empleado.card_seguimiento_documento', [
                                        'model' => $empleado,
                                        'var_documento' => 'doc_acta_nacimiento',
                                        'nombre_documento' => 'Acta de Nacimiento',
                                        'editar_documento' => false,
                                    ])
                                    @include('empleado.card_seguimiento_documento', [
                                        'model' => $empleado,
                                        'var_documento' => 'doc_nss',
                                        'nombre_documento' => 'Número de Seguro Social',
                                        'editar_documento' => false,
                                    ])
                                    @include('empleado.card_seguimiento_documento', [
                                        'model' => $empleado,
                                        'var_documento' => 'doc_comprobante_domicilio',
                                        'nombre_documento' => 'Comprobante de Domicilio',
                                        'editar_documento' => false,
                                    ])
                                    @include('empleado.card_seguimiento_documento', [
                                        'model' => $empleado,
                                        'var_documento' => 'doc_comprobante_estudios',
                                        'nombre_documento' => 'Comprobante de Estudios',
                                        'editar_documento' => false,
                                    ])
                                    @include('empleado.card_seguimiento_documento', [
                                        'model' => $empleado,
                                        'var_documento' => 'doc_curp',
                                        'nombre_documento' => 'CURP',
                                        'editar_documento' => false,
                                    ])
                                    @include('empleado.card_seguimiento_documento', [
                                        'model' => $empleado,
                                        'var_documento' => 'doc_csf',
                                        'nombre_documento' => 'Constancia de Situación Fiscal',
                                        'editar_documento' => false,
                                    ])
                                    @include('empleado.card_seguimiento_documento', [
                                        'model' => $empleado,
                                        'var_documento' => 'doc_soporte_bancario',
                                        'nombre_documento' => 'Soporte Bancario',
                                        'editar_documento' => false,
                                    ])
                                    @include('empleado.card_seguimiento_documento', [
                                        'model' => $empleado,
                                        'var_documento' => 'doc_contrato',
                                        'nombre_documento' => 'Contrato',
                                        'editar_documento' => false,
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('empleado.valida_rfc_modal')
    @endsection
