@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-light font-weight-bold" style="background:#263572;">
                        <a href="{{ route('movimientos') }}" style="color:white;">
                            Movimientos
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            {{ $movimientos->links('pagination::bootstrap-4') }}
                            <form action="{{ route('movimientos') }}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Estatus</label>
                                            <select name="estatus" class="form-select">
                                                <option value>--Seleccione un filtro--</option>
                                                <option value="Por procesar">Por procesar</option>
                                                <option value="Procesado">Procesado</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tipo</label>
                                            <select name="tipo" class="form-select">
                                                <option value>--Seleccione un filtro--</option>
                                                <option value="Alta">Alta</option>
                                                <option value="Reingreeso">Reingreeso</option>
                                                <option value="Baja">Baja</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Fecha</label>
                                            <table>
                                                <tr>
                                                    <td width="90%">
                                                        <input type="date" name="fecha" class="form-control"
                                                            value="{{ request()->fecha ? request()->fecha : '' }}">
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
                                            <th>Fecha</th>
                                            <th>Autor</th>
                                            <th>Empleado</th>
                                            <th>Tipo</th>
                                            <th>Estatus</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($movimientos as $movimiento)
                                            <tr>
                                                {{--  <td>{{ explode(' ', $movimiento->proceso->created_at)[0] }}</td>  --}}
                                                <td>{{ explode(' ', $movimiento->created_at)[0] }}</td>
                                                <td>{{ $movimiento->proceso->autor->name }}</td>
                                                <td>{{ $movimiento->proceso->empleado->nombre }}
                                                    {{ $movimiento->proceso->empleado->apaterno }}
                                                    {{ $movimiento->proceso->empleado->amaterno }}
                                                    <br>
                                                    {{ $movimiento->proceso->empleado->rfc }}
                                                </td>
                                                <td>{{ $movimiento->tipo }}</td>
                                                <td>{{ $movimiento->estatus }}</td>
                                                <td>
                                                    @can('Descargar txt')
                                                        <a href="{{ route('descarga_txt', $movimiento->proceso->id) }}"
                                                            title="Descargar .txt" style="text-decoration:none">
                                                            <span class="icon icon-download"> Descargar documento txt</span>
                                                        </a>
                                                        <br>
                                                    @endcan
                                                    @can('Ver captura empleado')
                                                        <a href="{{ route('captura_empleado_proceso', base64_encode($movimiento->proceso_id)) }}"
                                                            target="_BLANK" title="Ver captura del empleado"
                                                            style="text-decoration: none;">
                                                            <span class="icon icon-user"> Captura del empleado</span>
                                                        </a>
                                                        <br>
                                                    @endcan
                                                    @can('Cambiar estatus movimiento')
                                                        @if ($movimiento->estatus == 'Por procesar')
                                                            <a href="javascript:void(0);" title="Actualizar estatus"
                                                                onclick="actualizarMovimiento({{ $movimiento->id }});"
                                                                style="text-decoration:none">
                                                                <span class="icon icon-checkmark text-success"> Estatus</span>
                                                            </a>
                                                        @endif
                                                    @endcan
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">
                                                    No se encontraron registros @if (request()->rfc)
                                                        con {{ request()->rfc }}
                                                    @endif
                                                </td>
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
@endsection
