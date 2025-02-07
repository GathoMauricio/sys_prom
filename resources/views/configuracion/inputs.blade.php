@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-light font-weight-bold" style="background:#263572;">
                        Inputs
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <form action="{{ route('update_configs') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Solicitud de empleo</label>
                                            <select name="doc_solicitud_empleo" class="form-select">
                                                @if ($configuracion->doc_solicitud_empleo == 'required')
                                                    <option value="required" selected>Requerido</option>
                                                    <option value="x">No requerido</option>
                                                @else
                                                    <option value="required">Requerido</option>
                                                    <option value="x" selected>No requerido</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Fotografía</label>
                                            <select name="doc_fotografia" class="form-select">
                                                @if ($configuracion->doc_fotografia == 'required')
                                                    <option value="required" selected>Requerido</option>
                                                    <option value="x">No requerido</option>
                                                @else
                                                    <option value="required">Requerido</option>
                                                    <option value="x" selected>No requerido</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>INE</label>
                                            <select name="doc_ine" class="form-select">
                                                @if ($configuracion->doc_ine == 'required')
                                                    <option value="required" selected>Requerido</option>
                                                    <option value="x">No requerido</option>
                                                @else
                                                    <option value="required">Requerido</option>
                                                    <option value="x" selected>No requerido</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Acta de nacimiento</label>
                                            <select name="doc_acta_nacimiento" class="form-select">
                                                @if ($configuracion->doc_acta_nacimiento == 'required')
                                                    <option value="required" selected>Requerido</option>
                                                    <option value="x">No requerido</option>
                                                @else
                                                    <option value="required">Requerido</option>
                                                    <option value="x" selected>No requerido</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Número de seguiro social</label>
                                            <select name="doc_nss" class="form-select">
                                                @if ($configuracion->doc_nss == 'required')
                                                    <option value="required" selected>Requerido</option>
                                                    <option value="x">No requerido</option>
                                                @else
                                                    <option value="required">Requerido</option>
                                                    <option value="x" selected>No requerido</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Comprobante de domicilio</label>
                                            <select name="doc_comprobante_domicilio" class="form-select">
                                                @if ($configuracion->doc_comprobante_domicilio == 'required')
                                                    <option value="required" selected>Requerido</option>
                                                    <option value="x">No requerido</option>
                                                @else
                                                    <option value="required">Requerido</option>
                                                    <option value="x" selected>No requerido</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Comprobante de estudios</label>
                                            <select name="doc_comprobante_estudios" class="form-select">
                                                @if ($configuracion->doc_comprobante_estudios == 'required')
                                                    <option value="required" selected>Requerido</option>
                                                    <option value="x">No requerido</option>
                                                @else
                                                    <option value="required">Requerido</option>
                                                    <option value="x" selected>No requerido</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>CURP</label>
                                            <select name="doc_curp" class="form-select">
                                                @if ($configuracion->doc_curp == 'required')
                                                    <option value="required" selected>Requerido</option>
                                                    <option value="x">No requerido</option>
                                                @else
                                                    <option value="required">Requerido</option>
                                                    <option value="x" selected>No requerido</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Constancia de situación fiscal</label>
                                            <select name="doc_csf" class="form-select">
                                                @if ($configuracion->doc_csf == 'required')
                                                    <option value="required" selected>Requerido</option>
                                                    <option value="x">No requerido</option>
                                                @else
                                                    <option value="required">Requerido</option>
                                                    <option value="x" selected>No requerido</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Soporte bancario</label>
                                            <select name="doc_soporte_bancario" class="form-select">
                                                @if ($configuracion->doc_soporte_bancario == 'required')
                                                    <option value="required" selected>Requerido</option>
                                                    <option value="x">No requerido</option>
                                                @else
                                                    <option value="required">Requerido</option>
                                                    <option value="x" selected>No requerido</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Contrato</label>
                                            <select name="doc_contrato" class="form-select">
                                                @if ($configuracion->doc_contrato == 'required')
                                                    <option value="required" selected>Requerido</option>
                                                    <option value="x">No requerido</option>
                                                @else
                                                    <option value="required">Requerido</option>
                                                    <option value="x" selected>No requerido</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Salario mínimo resto del pais</label>
                                            <input type="number" name="salario_minimo_resto_pais"
                                                value="{{ $configuracion->salario_minimo_resto_pais }}" step="0.1"
                                                class="form-control" required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Salario mínimo en frontera</label>
                                            <input type="number" name="salario_minimo_frontera"
                                                value="{{ $configuracion->salario_minimo_frontera }}" step="0.1"
                                                class="form-control" required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Reembolso gasolina</label>
                                            <input type="number" name="reembolso_gasolina"
                                                value="{{ $configuracion->reembolso_gasolina }}" step="0.1"
                                                class="form-control" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary btn-block">Actualizar</button>
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('empleado.valida_rfc_modal')
@endsection
