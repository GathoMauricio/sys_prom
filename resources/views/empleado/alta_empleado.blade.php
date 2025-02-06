@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-light font-weight-bold" style="background:#263572;">
                        <div class="float-right">[Sysprom]</div>
                        Reclutamiento: Alta de empleado
                    </div>
                    <form action="{{ route('store_ingreso_empleado') }}" id="form_alta_empleado" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nombre">Nombre(s) <span class="text-danger">*</span></label>
                                            <input type="text" name="nombre" class="form-control text-only-input"
                                                required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="apaterno">A. Paterno <span class="text-danger">*</span></label>
                                            <input type="text" name="apaterno" class="form-control text-only-input"
                                                required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="amaterno">A. Materno <span class="text-danger">*</span></label>
                                            <input type="text" name="amaterno" class="form-control text-only-input"
                                                required />
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
                                            <select name="estado_nacimiento" class="form-select select2" required>
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
                                            <input type="text" name="nss" id="nss_input" class="form-control"
                                                required />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="rfc">RFC <span class="text-danger">*</span></label>
                                            <input type="text" name="rfc" value="{{ $rfc }}"
                                                class="form-control" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="cp">Código Postal <span class="text-danger">*</span></label>
                                            <input type="text" onkeyup="getSepomex(this.value);" name="cp"
                                                id="cp_input" class="form-control" required />
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
                                                class="form-control alphanumeric-input" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
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
                                                class="form-control" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="telefono_casa">Teléfono de casa</label>
                                            <input type="text" name="telefono_casa"
                                                class="form-control telefono-input" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="telefono_celular">Teléfono celular <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="telefono_celular"
                                                class="form-control telefono-input" required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="email">Correo electrónico <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" name="email" class="form-control" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
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
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="doc_solicitud_empleo">Solicitud de Empleo @if ($configuracion->doc_solicitud_empleo == 'required')
                                                    <span class="text-danger">*</span>
                                                @endif
                                            </label>
                                            <input type="file" name="doc_solicitud_empleo"
                                                class="form-control file-input" accept=".pdf, .jpg, .jpeg, .png"
                                                {{ $configuracion->doc_solicitud_empleo }} />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="doc_fotografia">Fotografia @if ($configuracion->doc_fotografia == 'required')
                                                    <span class="text-danger">*</span>
                                                @endif
                                            </label>
                                            <input type="file" name="doc_fotografia" class="form-control file-input"
                                                accept=".pdf, .jpg, .jpeg, .png" {{ $configuracion->doc_fotografia }} />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="doc_ine">INE @if ($configuracion->doc_ine == 'required')
                                                    <span class="text-danger">*</span>
                                                @endif
                                            </label>
                                            <input type="file" name="doc_ine" class="form-control file-input"
                                                accept=".pdf, .jpg, .jpeg, .png" {{ $configuracion->doc_ine }} />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="doc_acta_nacimiento">Acta de Nacimiento @if ($configuracion->doc_acta_nacimiento == 'required')
                                                    <span class="text-danger">*</span>
                                                @endif
                                            </label>
                                            <input type="file" name="doc_acta_nacimiento"
                                                class="form-control file-input" accept=".pdf, .jpg, .jpeg, .png"
                                                {{ $configuracion->doc_acta_nacimiento }} />
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="doc_nss">NSS @if ($configuracion->doc_nss == 'required')
                                                    <span class="text-danger">*</span>
                                                @endif
                                            </label>
                                            <input type="file" name="doc_nss" class="form-control file-input"
                                                accept=".pdf, .jpg, .jpeg, .png" {{ $configuracion->doc_nss }} />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="doc_comprobante_domicilio">Comprobante de Domicilio @if ($configuracion->doc_comprobante_domicilio == 'required')
                                                    <span class="text-danger">*</span>
                                                @endif
                                            </label>
                                            <input type="file" name="doc_comprobante_domicilio"
                                                class="form-control file-input" accept=".pdf, .jpg, .jpeg, .png"
                                                {{ $configuracion->doc_comprobante_domicilio }} />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="doc_comprobante_estudios">Comprobante de Estudios @if ($configuracion->doc_comprobante_estudios == 'required')
                                                    <span class="text-danger">*</span>
                                                @endif
                                            </label>
                                            <input type="file" name="doc_comprobante_estudios"
                                                class="form-control file-input" accept=".pdf, .jpg, .jpeg, .png"
                                                {{ $configuracion->doc_comprobante_estudios }} />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="doc_curp">CURP @if ($configuracion->doc_curp == 'required')
                                                    <span class="text-danger">*</span>
                                                @endif
                                            </label>
                                            <input type="file" name="doc_curp" class="form-control file-input"
                                                accept=".pdf, .jpg, .jpeg, .png" {{ $configuracion->doc_curp }} />
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="doc_csf">CSF @if ($configuracion->doc_csf == 'required')
                                                    <span class="text-danger">*</span>
                                                @endif
                                            </label>
                                            <input type="file" name="doc_csf" class="form-control file-input"
                                                accept=".pdf, .jpg, .jpeg, .png" {{ $configuracion->doc_csf }} />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="doc_soporte_bancario">Soporte Bancario @if ($configuracion->doc_soporte_bancario == 'required')
                                                    <span class="text-danger">*</span>
                                                @endif
                                            </label>
                                            <input type="file" name="doc_soporte_bancario"
                                                class="form-control file-input" accept=".pdf, .jpg, .jpeg, .png"
                                                {{ $configuracion->doc_soporte_bancario }} />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="doc_contrato">Contrato @if ($configuracion->doc_contrato == 'required')
                                                    <span class="text-danger">*</span>
                                                @endif
                                            </label>
                                            <input type="file" name="doc_contrato" class="form-control file-input"
                                                accept=".pdf, .jpg, .jpeg, .png" {{ $configuracion->doc_contrato }} />
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
