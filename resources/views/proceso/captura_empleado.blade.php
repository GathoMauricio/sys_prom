@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-light font-weight-bold" style="background:#263572;">
                        <div class="float-right">Última actualización:
                            {{ $proceso->updated_at->format('d/m/Y \a \l\a\s H:i') }}
                            Hrs.
                        </div>
                        Captura de Empleado
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre">Nombre(s) </label>
                                        <input type="text" name="nombre" value="{{ $empleado->nombre }}"
                                            class="form-control text-only-input" readonly />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="apaterno">A. Paterno </label>
                                        <input type="text" name="apaterno" value="{{ $empleado->apaterno }}"
                                            class="form-control text-only-input" readonly />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="amaterno">A. Materno </label>
                                        <input type="text" name="amaterno" value="{{ $empleado->amaterno }}"
                                            class="form-control text-only-input" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="fecha_nacimiento">Fecha de nacimiento</label>
                                        <input type="date" name="fecha_nacimiento"
                                            value="{{ $empleado->fecha_nacimiento }}" class="form-control" readonly />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="estado_nacimiento">Estado de nacimiento</label>
                                        <input type="text" value="{{ $empleado->estado_nacimiento }}"
                                            class="form-control" readonly />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nss">NSS </label>
                                        <input type="text" name="nss" value="{{ $empleado->nss }}" id="nss_input"
                                            class="form-control" readonly />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="rfc">RFC </label>
                                        <input type="text" name="rfc" value="{{ $empleado->rfc }}"
                                            class="form-control" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cp">Código Postal </label>
                                        <input type="text" onkeyup="getSepomex(this.value);" name="cp"
                                            value="{{ $empleado->cp }}" id="cp_input" class="form-control" readonly />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="estado">Estado </label>
                                        <input type="text" id="txt_estado_sepomex" name="estado" class="form-control"
                                            readonly />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="delegacion">Delegación/Municipio </label>
                                        <input type="text" id="txt_delegacion_numicipio_sepomex" name="delegacion"
                                            class="form-control" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="colonia">Colonia </label>
                                        <input type="text" value="{{ $empleado->colonia }}" class="form-control"
                                            readonly />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="calle_numero">Calle y Número</label>
                                        <input type="text" name="calle_numero" value="{{ $empleado->calle_numero }}"
                                            class="form-control alphanumeric-input" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="banco">Banco </label>
                                        <input type="text" value="{{ $empleado->banco }}" class="form-control"
                                            readonly />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="numero_cuenta">Número de cuenta</label>
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
                                            value="{{ $empleado->telefono_casa }}" class="form-control telefono-input"
                                            readonly />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="telefono_celular">Teléfono celular</label>
                                        <input type="text" name="telefono_celular"
                                            value="{{ $empleado->telefono_celular }}" class="form-control telefono-input"
                                            readonly />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">Correo electrónico</label>
                                        <input type="email" name="email" value ="{{ $empleado->email }}"
                                            class="form-control" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cc">Centro de Costos </label>
                                        <input type="text" value="{{ $centros->find($empleado->cc)->CC }}"
                                            class="form-control" readonly />
                                        <input type="hidden" name="cc" value="{{ $empleado->cc }}" id="hidden_cc"
                                            class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pp">Plan Promocional </label>
                                        <input type = "text" value="{{ $plan->NCUENTA }}" class="form-control"
                                            readonly>
                                        {{--  <select name="pp" id="cbo_pp" class="form-select select2" required>
                                            <option value>--Seleccione una opción--</option>
                                        </select>  --}}
                                    </div>
                                </div>
                            </div>
                            {{--  Esto solo lo puede ver el ejecutivo  --}}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fecha_ingreso">Fecha de ingreso </label>
                                        <input type="date" name="fecha_ingreso"
                                            min="{{ Carbon\Carbon::now()->subDays(3)->toDateString() }}"
                                            value="{{ $empleado->fecha_ingreso ? $empleado->fecha_ingreso : Carbon\Carbon::now()->toDateString() }}"
                                            class="form-control" readonly />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fecha_imss">Fecha de alta imss </label>
                                        <input type="date" name="fecha_imss"
                                            min="{{ Carbon\Carbon::now()->subDays(3)->toDateString() }}"
                                            value="{{ $empleado->fecha_imss ? $empleado->fecha_imss : Carbon\Carbon::now()->toDateString() }}"
                                            class="form-control" readonly />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="puesto">Puesto </label>
                                        <input value="{{ $empleado->puesto }}" class="form-control" readonly />
                                        <input type="hidden" name="id_puesto" value="{{ $empleado->id_puesto }}"
                                            id="txt_id_puesto">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="sueldo_diario">Sueldo diario </label>
                                        <select name="tipo_sueldo_diario" id="cbo_calcula_sueldos"
                                            onchange="calculaSueldos()" class="form-select" disabled>
                                            <option value>--Seleccione una opción--</option>
                                            <option value="Resto del país"
                                                @if ($empleado->tipo_sueldo_diario == 'Resto del país') selected @endif>Resto del país</option>
                                            <option value="Frontera" @if ($empleado->tipo_sueldo_diario == 'Frontera') selected @endif>
                                                Frontera</option>
                                        </select>
                                        <input type="text" name="sueldo_diario" id="txt_sueldo_diario"
                                            value="{{ $empleado->sueldo_diario }}" class="form-control" readonly />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="premio_puntualidad">Premio por putualidad</label>
                                        <select name="premio_puntualidad" onchange="calculaSueldos()"
                                            id="cbo_premio_puntualidad" class="form-select" disabled>
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
                                        <label for="premio_asistencia">Premio por asistencia</label>
                                        <select name="premio_asistencia" onchange="calculaSueldos()"
                                            id="cbo_premio_asistencia" class="form-select" disabled>
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
                                        <label for="despensa">Vales de despensa</label>
                                        <select name="despensa" onchange="calculaSueldos()" id="cbo_despensa"
                                            class="form-select" disabled>
                                            <option value="SI" @if ($empleado->despensa == 'SI') selected @endif>SI
                                            </option>
                                            <option value="NO" @if ($empleado->despensa == 'NO') selected @endif>NO
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
                                        <label for="reembolso_gasolina">Reembolso por gasolina</label>
                                        <select name="reembolso_gasolina" class="form-select"
                                            onchange="reembolsoGasolina()" id="cbo_reembolso_gasolina" disabled>
                                            <option value="SI" @if ($empleado->reembolso_gasolina == 'SI') selected @endif>SI
                                            </option>
                                            <option value="NO" @if ($empleado->reembolso_gasolina == 'NO') selected @endif>NO
                                            </option>
                                        </select>
                                        <input type="text" name="reembolso_gasolina_cant"
                                            id="txt_reembolso_gasolina_cant"
                                            value="{{ $empleado->reembolso_gasolina_cant }}" class="form-control"
                                            readonly />
                                    </div>
                                </div>
                            </div>
                            {{--  Hasta aquì --}}
                        </div>
                    </div>
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
