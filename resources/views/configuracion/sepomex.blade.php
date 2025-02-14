@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-light font-weight-bold" style="background:#263572;">
                        Sepomex
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <form action="{{ route('sepomex') }}">
                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <table>
                                                <tr>
                                                    <td width="90%">
                                                        <div class="form-group">
                                                            <label>Estado</label>
                                                            <select name="idEstado" class="form-select" required>
                                                                <option value>--Seleccione un filtro--</option>
                                                                @foreach ($estados as $key => $estado)
                                                                    <option value="{{ $estado->idEstado }}"
                                                                        @if (request()->idEstado && request()->idEstado == $estado->idEstado) selected @endif>
                                                                        {{ $estado->estado }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td width="10%">
                                                        <button type="submit" class="btn btn-primary"><span
                                                                class="icon icon-search"></span></button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <br>
                            <div style="width: 100%;overflow:hidden;overflow-x:scroll;">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Municipio</th>
                                            <th>Frontera</th>
                                    </thead>
                                    <tbody>
                                        @forelse ($municipios as $municipio)
                                            <tr>
                                                <td>{{ $municipio->municipio }}</td>
                                                <td>
                                                    <select
                                                        onchange="cambiarFrontera(this.value,'{{ $municipio->municipio }}')"
                                                        class="form-select">
                                                        @if ($municipio->frontera == 'SI')
                                                            <option value="NO">NO</option>
                                                            <option value="SI" selected>SI</option>
                                                        @else
                                                            <option value="NO" selected>NO</option>
                                                            <option value="SI">SI</option>
                                                        @endif
                                                    </select>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">No se ha seleccionado el estado</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('empleado.valida_rfc_modal')
@endsection
