@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-light font-weight-bold" style="background:#263572;">
                        Importar empleado desde Sicoss
                    </div>
                    <form action="{{ route('store_importar_empleado') }}" id="form_reingreso_sicoss_empleado" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="sicoss_id" value="{{ $empleado->Trab_ID }}">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nombre">Nombre(s) <span class="text-danger">*</span></label>
                                            <input type="text" name="nombre" value="{{ $empleado->Nombre }}"
                                                class="form-control text-only-input" required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="apaterno">A. Paterno <span class="text-danger">*</span></label>
                                            <input type="text" name="apaterno" value="{{ $empleado->Paterno }}"
                                                class="form-control text-only-input" required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="amaterno">A. Materno <span class="text-danger">*</span></label>
                                            <input type="text" name="amaterno" value="{{ $empleado->Materno }}"
                                                class="form-control text-only-input" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fecha_nacimiento">Fecha de nacimiento <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" name="fecha_nacimiento" value="{{ $fecha_nacimiento }}"
                                                class="form-control" required />
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
                                            <input type="text" name="nss" value="{{ $empleado->IMSS }}"
                                                id="nss_input" class="form-control" required />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="rfc">RFC <span class="text-danger">*</span></label>
                                            <input type="text" name="rfc" value="{{ $empleado->RFC }}"
                                                class="form-control" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="cp">Código Postal <span class="text-danger">*</span></label>
                                            <input type="text" onkeyup="getSepomex(this.value);" name="cp"
                                                value="{{ $empleado->CP }}" id="cp_input" class="form-control" required />
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
                                            <input type="text" name="calle_numero" value="{{ $empleado->Calle }}"
                                                class="form-control alphanumeric-input" required />
                                        </div>
                                    </div>
                                </div>
                                {{--  <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="banco">Banco <span class="text-danger">*</span></label>
                                            <select name="banco" onchange="validaNumeroCuenta(this.value)"
                                                class="form-select" required>
                                                <option value>--Seleccione una opción--</option>
                                                <option value="BANCOMER">BANCOMER</option>
                                                <option value="SANTANDER">SANTANDER</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="numero_cuenta">Número de cuenta <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="txt_numero_cuenta" name="numero_cuenta"
                                                value="{{ $empleado->CuentaDeposito }}" class="form-control" required />
                                        </div>
                                    </div>
                                </div>  --}}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="telefono_casa">Teléfono de casa</label>
                                            <input type="text" name="telefono_casa" value="{{ $empleado->Telefono }}"
                                                class="form-control telefono-input" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="telefono_celular">Teléfono celular <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="telefono_celular"
                                                value="{{ $empleado->Telefono }}" class="form-control telefono-input"
                                                required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="email">Correo electrónico</label>
                                            <input type="email" name="email" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                {{--  <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cc">Centro de Costos <span
                                                    class="text-danger">*</span></label>
                                            <select name="cc" onchange="getPlanes(this.value);"
                                                class="form-select select2" required>
                                                <option value>--Seleccione una opción--</option>
                                                @foreach ($centros as $key => $centro)
                                                    <option value="{{ $centro->IDCC }}">{{ $centro->CC }}
                                                    </option>
                                                @endforeach
                                            </select>
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
                                </div>  --}}
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="doc_solicitud_empleo">Solicitud de Empleo
                                            </label>
                                            <input type="file" name="doc_solicitud_empleo"
                                                class="form-control file-input" accept=".pdf, .jpg, .jpeg, .png" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="doc_fotografia">Fotografia
                                            </label>
                                            <input type="file" name="doc_fotografia" class="form-control file-input"
                                                accept=".pdf, .jpg, .jpeg, .png" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="doc_ine">INE
                                            </label>
                                            <input type="file" name="doc_ine" class="form-control file-input"
                                                accept=".pdf, .jpg, .jpeg, .png" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="doc_acta_nacimiento">Acta de Nacimiento
                                            </label>
                                            <input type="file" name="doc_acta_nacimiento"
                                                class="form-control file-input" accept=".pdf, .jpg, .jpeg, .png" />
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="doc_nss">NSS
                                            </label>
                                            <input type="file" name="doc_nss" class="form-control file-input"
                                                accept=".pdf, .jpg, .jpeg, .png" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="doc_comprobante_domicilio">Comprobante de Domicilio
                                            </label>
                                            <input type="file" name="doc_comprobante_domicilio"
                                                class="form-control file-input" accept=".pdf, .jpg, .jpeg, .png" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="doc_comprobante_estudios">Comprobante de Estudios
                                            </label>
                                            <input type="file" name="doc_comprobante_estudios"
                                                class="form-control file-input" accept=".pdf, .jpg, .jpeg, .png" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="doc_curp">CURP
                                            </label>
                                            <input type="file" name="doc_curp" class="form-control file-input"
                                                accept=".pdf, .jpg, .jpeg, .png" />
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="doc_csf">CSF
                                            </label>
                                            <input type="file" name="doc_csf" class="form-control file-input"
                                                accept=".pdf, .jpg, .jpeg, .png" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="doc_soporte_bancario">Soporte Bancario
                                            </label>
                                            <input type="file" name="doc_soporte_bancario"
                                                class="form-control file-input" accept=".pdf, .jpg, .jpeg, .png" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="doc_contrato">Contrato
                                            </label>
                                            <input type="file" name="doc_contrato" class="form-control file-input"
                                                accept=".pdf, .jpg, .jpeg, .png" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">

                            <button type="submit" class="btn btn-primary float-md-right">
                                Enviar formulario a revisión
                            </button>
                            <label>Los campos marcados con (<span class="text-danger">*</span>) son obligatorios</label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom_scripts')
    <script>
        setTimeout(function() {
            getSepomex($("#cp_input").val());
            $("#cbo_estado_nacimiento").val('{{ $estado_nacimiento }}').trigger('change');
        }, 1000);
    </script>
@endsection
