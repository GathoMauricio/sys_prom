@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-light font-weight-bold" style="background:#263572;">
                        <div class="float-right">[SysProm]</div>
                        Seguimiento de Empleado
                    </div>
                    <form action="{{ route('update_empleado', $empleado->id) }}" id="form_actualizar_empleado" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT');
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nombre">Nombre(s) <span class="text-danger">*</span></label>
                                            <input type="text" name="nombre" value="{{ $empleado->nombre }}"
                                                class="form-control text-only-input" readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="apaterno">A. Paterno <span class="text-danger">*</span></label>
                                            <input type="text" name="apaterno" value="{{ $empleado->apaterno }}"
                                                class="form-control text-only-input" readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="amaterno">A. Materno <span class="text-danger">*</span></label>
                                            <input type="text" name="amaterno" value="{{ $empleado->amaterno }}"
                                                class="form-control text-only-input" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fecha_nacimiento">Fecha de nacimiento <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" name="fecha_nacimiento"
                                                value="{{ $empleado->fecha_nacimiento }}" class="form-control" readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="estado_nacimiento">Estado de nacimiento <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" value="{{ $empleado->estado_nacimiento }}"
                                                class="form-control" readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nss">NSS <span class="text-danger">*</span></label>
                                            <input type="text" name="nss" value="{{ $empleado->nss }}" id="nss_input"
                                                class="form-control" readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="rfc">RFC <span class="text-danger">*</span></label>
                                            <input type="text" name="rfc" value="{{ $empleado->rfc }}"
                                                class="form-control" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="cp">Código Postal <span class="text-danger">*</span></label>
                                            <input type="text" onkeyup="getSepomex(this.value);" name="cp"
                                                value="{{ $empleado->cp }}" id="cp_input" class="form-control" readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="estado">Estado <span class="text-danger">*</span></label>
                                            <input type="text" id="txt_estado_sepomex" name="estado"
                                                class="form-control" readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="delegacion">Delegación/Municipio <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="txt_delegacion_numicipio_sepomex" name="delegacion"
                                                class="form-control" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="colonia">Colonia <span class="text-danger">*</span></label>
                                            <input type="text" value="{{ $empleado->colonia }}" class="form-control"
                                                readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="calle_numero">Calle y Número <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="calle_numero"
                                                value="{{ $empleado->calle_numero }}"
                                                class="form-control alphanumeric-input" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="banco">Banco <span class="text-danger">*</span></label>
                                            <input type="text" value="{{ $empleado->banco }}" class="form-control"
                                                readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="numero_cuenta">Número de cuenta<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="txt_numero_cuenta" name="numero_cuenta"
                                                value="{{ $empleado->numero_cuenta }}" class="form-control" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="telefono_casa">Teléfono de casa</label>
                                            <input type="text" name="telefono_casa"
                                                value="{{ $empleado->telefono_casa }}"
                                                class="form-control telefono-input" readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="telefono_celular">Teléfono celular <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="telefono_celular"
                                                value="{{ $empleado->telefono_celular }}"
                                                class="form-control telefono-input" readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="email">Correo electrónico <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" name="email" value ="{{ $empleado->email }}"
                                                class="form-control" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cc">Centro de Costos <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" value="{{ $centros->find($empleado->cc)->CC }}"
                                                class="form-control" readonly />
                                            <input type="hidden" name="cc" value="{{ $empleado->cc }}"
                                                id="hidden_cc" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pp">Plan Promocional <span
                                                    class="text-danger">*</span></label>
                                            @if (Auth::user()->hasRole(['Administracion', 'Ejecutivo']))
                                                <select name="pp" id="cbo_pp" class="form-select select2"
                                                    required>
                                                    <option value>--Seleccione una opción--</option>
                                                </select>
                                            @else
                                                <input type="text" value="{{ $plan->NCUENTA }}" class="form-control"
                                                    readonly />
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (Auth::user()->hasRole(['Administracion', 'Ejecutivo']))
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fecha_ingreso">Fecha de ingreso <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" name="fecha_ingreso"
                                                min="{{ Carbon\Carbon::now()->subDays(3)->toDateString() }}"
                                                value="{{ $empleado->fecha_ingreso ? $empleado->fecha_ingreso : Carbon\Carbon::now()->toDateString() }}"
                                                class="form-control" required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fecha_imss">Fecha de alta imss <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" name="fecha_imss"
                                                min="{{ Carbon\Carbon::now()->subDays(3)->toDateString() }}"
                                                value="{{ $empleado->fecha_imss ? $empleado->fecha_imss : Carbon\Carbon::now()->toDateString() }}"
                                                class="form-control" required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="puesto">Puesto <span class="text-danger">*</span></label>
                                            <select name="puesto" id="cbo_puesto"
                                                onchange="obtenerIdPuesto(this.value);" class="form-select select2"
                                                required>
                                                <option value>--Seleccione una opción--</option>
                                                @foreach ($puestos as $puesto)
                                                    <option value="{{ $puesto->Puesto_ID }}-{{ $puesto->Descripcion }}"
                                                        @if ($puesto->Puesto_ID == $empleado->id_puesto) selected @endif>
                                                        {{ $puesto->Descripcion }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="id_puesto" value="{{ $empleado->id_puesto }}"
                                                id="txt_id_puesto">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sueldo_diario">Sueldo diario <span
                                                    class="text-danger">*</span></label>
                                            <select name="tipo_sueldo_diario" id="cbo_calcula_sueldos"
                                                onchange="calculaSueldos()" class="form-select" required>
                                                <option value>--Seleccione una opción--</option>
                                                <option value="Resto del país"
                                                    @if ($empleado->tipo_sueldo_diario == 'Resto del país') selected @endif>Resto del país
                                                </option>
                                                <option value="Frontera" @if ($empleado->tipo_sueldo_diario == 'Frontera') selected @endif>
                                                    Frontera</option>
                                            </select>
                                            <input type="text" name="sueldo_diario" id="txt_sueldo_diario"
                                                value="{{ $empleado->sueldo_diario }}" class="form-control" readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="premio_puntualidad">Premio por putualidad<span
                                                    class="text-danger">*</span></label>
                                            <select name="premio_puntualidad" onchange="calculaSueldos()"
                                                id="cbo_premio_puntualidad" class="form-select">
                                                <option value="SI" @if ($empleado->premio_puntualidad == 'SI') selected @endif>SI
                                                </option>
                                                <option value="NO" @if ($empleado->premio_puntualidad == 'NO') selected @endif>NO
                                                </option>
                                            </select>
                                            <input type="text" name="premio_puntualidad_cant"
                                                id="txt_premio_puntualidad_cant"
                                                value="{{ $empleado->premio_puntualidad_cant }}" class="form-control"
                                                readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="premio_asistencia">Premio por asistencia<span
                                                    class="text-danger">*</span></label>
                                            <select name="premio_asistencia" onchange="calculaSueldos()"
                                                id="cbo_premio_asistencia" class="form-select">
                                                <option value="SI" @if ($empleado->premio_asistencia == 'SI') selected @endif>SI
                                                </option>
                                                <option value="NO" @if ($empleado->premio_asistencia == 'NO') selected @endif>NO
                                                </option>
                                            </select>
                                            <input type="text" name="premio_asistencia_cant"
                                                id="txt_premio_asistencia_cant"
                                                value="{{ $empleado->premio_asistencia_cant }}" class="form-control"
                                                readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="despensa">Vales de despensa<span
                                                    class="text-danger">*</span></label>
                                            <select name="despensa" onchange="calculaSueldos()" id="cbo_despensa"
                                                class="form-select">
                                                <option value="SI" @if ($empleado->despensa == 'SI') selected @endif>SI
                                                </option>
                                                <option value="NO" @if ($empleado->despensa == 'NO') selected @endif>
                                                    NO
                                                </option>
                                            </select>
                                            <input type="text" name="despensa_cant" id="txt_despensa_cant"
                                                value="{{ $empleado->despensa_cant }}" class="form-control" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="reembolso_gasolina">Reembolso por gasolina<span
                                                    class="text-danger">*</span></label>
                                            <select name="reembolso_gasolina" class="form-select"
                                                onchange="reembolsoGasolina()" id="cbo_reembolso_gasolina">
                                                <option value="SI" @if ($empleado->reembolso_gasolina == 'SI') selected @endif>
                                                    SI
                                                </option>
                                                <option value="NO" @if ($empleado->reembolso_gasolina == 'NO') selected @endif>
                                                    NO
                                                </option>
                                            </select>
                                            <input type="text" name="reembolso_gasolina_cant"
                                                id="txt_reembolso_gasolina_cant"
                                                value="{{ $empleado->reembolso_gasolina_cant }}" class="form-control"
                                                readonly />
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-md-right">
                                Actualizar información
                            </button>
                            <label>Los campos marcados con (<span class="text-danger">*</span>) son obligatorios</label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-light font-weight-bold" style="background:#263572;">
                        Documentación
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                @include('empleado.card_seguimiento_documento', [
                                    'model' => $empleado,
                                    'var_documento' => 'doc_solicitud_empleo',
                                    'nombre_documento' => 'Solicitud de Empleo',
                                    'editar_documento' => true,
                                ])
                                @include('empleado.card_seguimiento_documento', [
                                    'model' => $empleado,
                                    'var_documento' => 'doc_fotografia',
                                    'nombre_documento' => 'Fotografía',
                                    'editar_documento' => true,
                                ])
                                @include('empleado.card_seguimiento_documento', [
                                    'model' => $empleado,
                                    'var_documento' => 'doc_ine',
                                    'nombre_documento' => 'INE',
                                    'editar_documento' => true,
                                ])
                                @include('empleado.card_seguimiento_documento', [
                                    'model' => $empleado,
                                    'var_documento' => 'doc_acta_nacimiento',
                                    'nombre_documento' => 'Acta de Nacimiento',
                                    'editar_documento' => true,
                                ])
                                @include('empleado.card_seguimiento_documento', [
                                    'model' => $empleado,
                                    'var_documento' => 'doc_nss',
                                    'nombre_documento' => 'Número de Seguro Social',
                                    'editar_documento' => true,
                                ])
                                @include('empleado.card_seguimiento_documento', [
                                    'model' => $empleado,
                                    'var_documento' => 'doc_comprobante_domicilio',
                                    'nombre_documento' => 'Comprobante de Domicilio',
                                    'editar_documento' => true,
                                ])
                                @include('empleado.card_seguimiento_documento', [
                                    'model' => $empleado,
                                    'var_documento' => 'doc_comprobante_estudios',
                                    'nombre_documento' => 'Comprobante de Estudios',
                                    'editar_documento' => true,
                                ])
                                @include('empleado.card_seguimiento_documento', [
                                    'model' => $empleado,
                                    'var_documento' => 'doc_curp',
                                    'nombre_documento' => 'CURP',
                                    'editar_documento' => true,
                                ])
                                @include('empleado.card_seguimiento_documento', [
                                    'model' => $empleado,
                                    'var_documento' => 'doc_csf',
                                    'nombre_documento' => 'Constancia de Situación Fiscal',
                                    'editar_documento' => true,
                                ])
                                @include('empleado.card_seguimiento_documento', [
                                    'model' => $empleado,
                                    'var_documento' => 'doc_soporte_bancario',
                                    'nombre_documento' => 'Soporte Bancario',
                                    'editar_documento' => true,
                                ])
                                @include('empleado.card_seguimiento_documento', [
                                    'model' => $empleado,
                                    'var_documento' => 'doc_contrato',
                                    'nombre_documento' => 'Contrato',
                                    'editar_documento' => true,
                                ])
                            </div>


                            {{--  <table class="table table-striped table-bordered">
                                <tbody>
                                    @include('empleado.tr_seguimiento_documento', [
                                        'model' => $empleado,
                                        'var_documento' => 'doc_solicitud_empleo',
                                        'nombre_documento' => 'Solicitud de Empleo',
                                        'editar_documento' => true,
                                    ])
                                    @include('empleado.tr_seguimiento_documento', [
                                        'model' => $empleado,
                                        'var_documento' => 'doc_fotografia',
                                        'nombre_documento' => 'Fotografía',
                                        'editar_documento' => true,
                                    ])
                                    @include('empleado.tr_seguimiento_documento', [
                                        'model' => $empleado,
                                        'var_documento' => 'doc_ine',
                                        'nombre_documento' => 'INE',
                                        'editar_documento' => true,
                                    ])
                                    @include('empleado.tr_seguimiento_documento', [
                                        'model' => $empleado,
                                        'var_documento' => 'doc_acta_nacimiento',
                                        'nombre_documento' => 'Acta de Nacimiento',
                                        'editar_documento' => true,
                                    ])
                                    @include('empleado.tr_seguimiento_documento', [
                                        'model' => $empleado,
                                        'var_documento' => 'doc_nss',
                                        'nombre_documento' => 'Número de Seguro Social',
                                        'editar_documento' => true,
                                    ])
                                    @include('empleado.tr_seguimiento_documento', [
                                        'model' => $empleado,
                                        'var_documento' => 'doc_comprobante_domicilio',
                                        'nombre_documento' => 'Comprobante de Domicilio',
                                        'editar_documento' => true,
                                    ])
                                    @include('empleado.tr_seguimiento_documento', [
                                        'model' => $empleado,
                                        'var_documento' => 'doc_comprobante_estudios',
                                        'nombre_documento' => 'Comprobante de Estudios',
                                        'editar_documento' => true,
                                    ])
                                    @include('empleado.tr_seguimiento_documento', [
                                        'model' => $empleado,
                                        'var_documento' => 'doc_curp',
                                        'nombre_documento' => 'CURP',
                                        'editar_documento' => true,
                                    ])
                                    @include('empleado.tr_seguimiento_documento', [
                                        'model' => $empleado,
                                        'var_documento' => 'doc_csf',
                                        'nombre_documento' => 'Constancia de Situación Fiscal',
                                        'editar_documento' => true,
                                    ])
                                    @include('empleado.tr_seguimiento_documento', [
                                        'model' => $empleado,
                                        'var_documento' => 'doc_soporte_bancario',
                                        'nombre_documento' => 'Soporte Bancario',
                                        'editar_documento' => true,
                                    ])
                                    @include('empleado.tr_seguimiento_documento', [
                                        'model' => $empleado,
                                        'var_documento' => 'doc_contrato',
                                        'nombre_documento' => 'Contrato',
                                        'editar_documento' => true,
                                    ])
                                </tbody>
                            </table>  --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-light font-weight-bold" style="background:#263572;">
                        Último proceso
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div style="width: 100%;overflow:hidden;overflow-x:scroll;">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Autor</th>
                                            <th>Tipo</th>
                                            <th>Etapa</th>
                                            <th>Documentación</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ explode(' ', $empleado->procesos[0]->created_at)[0] }}</td>
                                            <td>{{ $empleado->procesos[0]->autor->name }}</td>
                                            <td>{{ $empleado->procesos[0]->tipo }}</td>
                                            <td>{{ $empleado->procesos[0]->estatus }}</td>
                                            <td>{{ $empleado->procesos[0]->estatus_documentacion }}</td>
                                            <td>
                                                @can('Agregar seguimiento')
                                                    <a href="javascript:void(0);"
                                                        onclick="createSeguimiento({{ $empleado->procesos[0]->id }})"
                                                        title="Seguiumientos del proceso" style="text-decoration: none;">
                                                        <span class="icon icon-bubble">
                                                            {{ $empleado->procesos[0]->seguimientos->count() }}
                                                            Seguimientos</span>
                                                    </a>
                                                    <br>
                                                @endcan
                                                @can('Ver captura empleado')
                                                    <a href="{{ route('captura_empleado_proceso', base64_encode($empleado->procesos[0]->id)) }}"
                                                        target="_BLANK" title="Enviar a ejecutivo"
                                                        style="text-decoration: none;">
                                                        <span class="icon icon-user"> Captura del empleado</span>
                                                    </a>
                                                    <br>
                                                @endcan
                                                @can('Aprobar proceso')
                                                    <a href="javascript:void(0);"
                                                        onclick="aprobarProceso({{ $empleado->procesos[0]->id }});"
                                                        title="Aprobar proceso" style="text-decoration: none;">
                                                        <span class="icon icon-checkmark2"> Aprobar proceso</span>
                                                    </a>
                                                    <br>
                                                @endcan
                                                @can('Rechazar proceso')
                                                    <a href="javascript:void(0);"
                                                        onclick="rechazarProceso({{ $empleado->procesos[0]->id }});"
                                                        title="Rechazar proceso" style="text-decoration: none;">
                                                        <span class="icon icon-cross"> Rechazar proceso</span>
                                                    </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('empleado.seguimiento.create_seguimiento_modal')
@endsection
@section('custom_scripts')
    <script>
        $(document).ready(function() {
            getPlanes($("#hidden_cc").val());
            getSepomex($("#cp_input").val());
            setTimeout(function() {
                $("#cbo_pp").val('{{ $empleado->pp }}').trigger('change');
            }, 2000);
        });
    </script>
@endsection
