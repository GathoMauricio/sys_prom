@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-light font-weight-bold" style="background:#263572;">
                        <div class="float-right">[SysProm]</div>
                        Reclutamiento: Seguimiento de empleado
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
                                                class="form-control text-only-input" required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="apaterno">A. Paterno <span class="text-danger">*</span></label>
                                            <input type="text" name="apaterno" value="{{ $empleado->apaterno }}"
                                                class="form-control text-only-input" required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="amaterno">A. Materno <span class="text-danger">*</span></label>
                                            <input type="text" name="amaterno" value="{{ $empleado->amaterno }}"
                                                class="form-control text-only-input" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fecha_nacimiento">Fecha de nacimiento <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" name="fecha_nacimiento"
                                                value="{{ $empleado->fecha_nacimiento }}" class="form-control" required />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="estado_nacimiento">Estado de nacimiento <span
                                                    class="text-danger">*</span></label>
                                            <select name="estado_nacimiento" class="form-select select2"
                                                id="cbo_estado_nacimiento" required>
                                                <option value>--Seleccione una opción--</option>
                                                @foreach ($estados as $key => $estado)
                                                    <option value="{{ $estado->estado }}">{{ $estado->estado }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nss">NSS <span class="text-danger">*</span></label>
                                            <input type="text" name="nss" value="{{ $empleado->nss }}" id="nss_input"
                                                class="form-control" required />
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
                                                value="{{ $empleado->cp }}" id="cp_input" class="form-control" required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="estado">Estado <span class="text-danger">*</span></label>
                                            <input type="text" id="txt_estado_sepomex" name="estado"
                                                class="form-control" readonly="true" required="true" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="delegacion">Delegación/Municipio <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="txt_delegacion_numicipio_sepomex" name="delegacion"
                                                class="form-control" readonly="true" required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="colonia">Colonia <span class="text-danger">*</span></label>
                                            <select name="colonia" id="cbo_colonia_sepomex" class="form-select"></select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="calle_numero">Calle y Número <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="calle_numero"
                                                value="{{ $empleado->calle_numero }}"
                                                class="form-control alphanumeric-input" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="banco">Banco <span class="text-danger">*</span></label>
                                            <select name="banco" id="cbo_banco"
                                                onchange="validaNumeroCuenta(this.value)" class="form-select" required>
                                                <option value>--Seleccione una opción--</option>
                                                <option value="BANCOMER">BANCOMER</option>
                                                <option value="SANTANDER">SANTANDER</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="numero_cuenta">Número de cuenta<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="txt_numero_cuenta" name="numero_cuenta"
                                                value="{{ $empleado->numero_cuenta }}" class="form-control" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="telefono_casa">Teléfono de casa</label>
                                            <input type="text" name="telefono_casa"
                                                value="{{ $empleado->telefono_casa }}"
                                                class="form-control telefono-input" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="telefono_celular">Teléfono celular <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="telefono_celular"
                                                value="{{ $empleado->telefono_celular }}"
                                                class="form-control telefono-input" required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="email">Correo electrónico <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" name="email" value ="{{ $empleado->email }}"
                                                class="form-control" required />
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
                                            {{--  <select name="cc" onchange="getPlanes(this.value);" class="form-select"
                                                id="cbo_cc">
                                                <option value>--Seleccione una opción--</option>
                                                @foreach ($centros as $key => $centro)
                                                    <option value="{{ $centro->IDCC }}">{{ $centro->CC }}
                                                    </option>
                                                @endforeach
                                            </select>  --}}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pp">Plan Promocional <span
                                                    class="text-danger">*</span></label>
                                            <select name="pp" id="cbo_pp" class="form-select select2" required>
                                                <option value>--Seleccione una opción--</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                            <table class="table table-striped table-bordered">
                                <tbody>
                                    @include('empleado.tr_seguimiento_documento', [
                                        'model' => $empleado,
                                        'var_documento' => 'doc_solicitud_empleo',
                                        'nombre_documento' => 'Solicitud de Empleo',
                                    ])
                                    @include('empleado.tr_seguimiento_documento', [
                                        'model' => $empleado,
                                        'var_documento' => 'doc_fotografia',
                                        'nombre_documento' => 'Fotografía',
                                    ])
                                    @include('empleado.tr_seguimiento_documento', [
                                        'model' => $empleado,
                                        'var_documento' => 'doc_ine',
                                        'nombre_documento' => 'INE',
                                    ])
                                    @include('empleado.tr_seguimiento_documento', [
                                        'model' => $empleado,
                                        'var_documento' => 'doc_acta_nacimiento',
                                        'nombre_documento' => 'Acta de Nacimiento',
                                    ])
                                    @include('empleado.tr_seguimiento_documento', [
                                        'model' => $empleado,
                                        'var_documento' => 'doc_nss',
                                        'nombre_documento' => 'Número de Seguro Social',
                                    ])
                                    @include('empleado.tr_seguimiento_documento', [
                                        'model' => $empleado,
                                        'var_documento' => 'doc_comprobante_domicilio',
                                        'nombre_documento' => 'Comprobante de Domicilio',
                                    ])
                                    @include('empleado.tr_seguimiento_documento', [
                                        'model' => $empleado,
                                        'var_documento' => 'doc_comprobante_estudios',
                                        'nombre_documento' => 'Comprobante de Estudios',
                                    ])
                                    @include('empleado.tr_seguimiento_documento', [
                                        'model' => $empleado,
                                        'var_documento' => 'doc_curp',
                                        'nombre_documento' => 'CURP',
                                    ])
                                    @include('empleado.tr_seguimiento_documento', [
                                        'model' => $empleado,
                                        'var_documento' => 'doc_csf',
                                        'nombre_documento' => 'Constancia de Situación Fiscal',
                                    ])
                                    @include('empleado.tr_seguimiento_documento', [
                                        'model' => $empleado,
                                        'var_documento' => 'doc_soporte_bancario',
                                        'nombre_documento' => 'Soporte Bancario',
                                    ])
                                    @include('empleado.tr_seguimiento_documento', [
                                        'model' => $empleado,
                                        'var_documento' => 'doc_contrato',
                                        'nombre_documento' => 'Contrato',
                                    ])
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-light font-weight-bold" style="background:#263572;">
                        Procesos
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
                                            <th>Estatus</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($empleado->procesos as $proceso)
                                            <tr>
                                                <td>{{ explode(' ', $proceso->created_at)[0] }}</td>
                                                <td>{{ $proceso->autor->name }}</td>
                                                <td>{{ $proceso->tipo }}</td>
                                                <td>{{ $proceso->estatus }}</td>
                                                <td>
                                                    <a href="javascript:void(0)"
                                                        onclick="createSeguimiento({{ $proceso->id }})"
                                                        title="Seguiumientos del proceso">
                                                        <span
                                                            class="icon icon-bubble">{{ $proceso->seguimientos->count() }}</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
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
        setTimeout(function() {
            $("#cbo_estado_nacimiento").val('{{ $empleado->estado_nacimiento }}').trigger('change');
            $("#cbo_banco").val('{{ $empleado->banco }}').trigger('change');
            $("#txt_numero_cuenta").val('{{ $empleado->numero_cuenta }}');
            getSepomex($("#cp_input").val());
            getPlanes($("#hidden_cc").val());
            setTimeout(function() {
                $("#cbo_pp").val('{{ $empleado->pp }}').trigger('change');
                $("#cbo_colonia_sepomex").val('{{ $empleado->colonia }}').trigger('change');
            }, 2000);
        }, 1000);
    </script>
@endsection
