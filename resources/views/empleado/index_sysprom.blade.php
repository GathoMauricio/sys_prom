@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-light font-weight-bold" style="background:#263572;">
                        <div class="float-right">[SysProm]</div>
                        <a href="{{ route('empleados_sysprom') }}" style="color:white;">Empleados</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">{{ $empleados->links('pagination::bootstrap-4') }}</div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <form action="{{ route('empleados_sysprom') }}">
                                    <table>
                                        <tr>
                                            <td width="90%">
                                                <input type="text" name="rfc" class="form-control"
                                                    id="txt_rfc_valida" placeholder="Buscar RFC..." required>
                                            </td>
                                            <td width="10%">
                                                <button type="submit" class="btn btn-primary"><span
                                                        class="icon icon-search"></span></button>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                        <br>
                        <div style="width: 100%;overflow:hidden;overflow-x:scroll;">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Empleado</th>
                                        <th>Rfc</th>
                                        <th>Estatus</th>
                                        <th>Lista Negra</th>
                                        {{--  <th>Origen</th>  --}}
                                        {{--  <th>Tipo</th>  --}}
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($empleados as $key => $empleado)
                                        <tr>
                                            <td>{{ $empleado->nombre }} {{ $empleado->apaterno }}
                                                {{ $empleado->amaterno }}
                                            </td>
                                            <td>{{ $empleado->rfc }}</td>
                                            <td>{{ $empleado->estatus }}</td>
                                            <td>
                                                @if (count($empleado->lista_negra) > 0)
                                                    SI
                                                @else
                                                    NO
                                                @endif
                                            </td>
                                            {{--  <td>
                                                @if ($empleado->origen == 'Sicoss')
                                                    <a href="javascript::void(0)"
                                                        style="text-decoration: none;">{{ $empleado->origen }} <span
                                                            class="icon icon-share"></span></a>
                                                @else
                                                    {{ $empleado->origen }}
                                                @endif
                                            </td>  --}}
                                            {{--  <td>{{ $empleado->tipo }}</td>  --}}
                                            <td>
                                                <a href="{{ route('empleado', base64_encode($empleado->id)) }}"
                                                    class="text-info" style="text-decoration: none;">Detalles</a>
                                                {{--  <br>
                                                <a href="javascript:void(0);" class="text-primary"
                                                    style="text-decoration: none;">Generar baja</a>
                                                <br>
                                                <a href="javascript:void(0);" class="text-warning"
                                                    style="text-decoration: none;">Enviar a lista negra</a>
                                                <br>
                                                <a href="javascript:void(0);" class="text-danger"
                                                    style="text-decoration: none;">Eliminar</a>  --}}

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No se encontraron coincidencias</td>
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
    @include('empleado.valida_rfc_modal')
@endsection
