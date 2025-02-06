@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-light font-weight-bold" style="background:#263572;">
                        <div class="float-right">[Sicoss]</div>
                        <a href="{{ route('empleados_sicoss') }}" style="color:white;">Empleados</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">{{ $empleados->links('pagination::bootstrap-4') }}</div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <form action="{{ route('empleados_sicoss') }}">
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
                                        <th>RFC</th>
                                        <th>Activo</th>
                                        <th>Lista Negra</th>
                                        {{--  <th>Origen</th>
                                        <th>Tipo</th>  --}}
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($empleados as $key => $empleado)
                                        <tr>
                                            <td>{{ $empleado->Nombre }} {{ $empleado->Paterno }}
                                                {{ $empleado->Materno }}
                                            </td>
                                            <td>
                                                {{ $empleado->RFC }}
                                            </td>
                                            <td>{{ $empleado->activo() }}</td>
                                            <td>
                                                @if ($empleado->lista_negra->isNotEmpty())
                                                    SI
                                                    <br>
                                                    {{ $empleado->lista_negra[0]->Descripcion }}
                                                @else
                                                    NO
                                                @endif
                                            </td>

                                            <td>

                                                {{--  <a href="#" class="text-info"
                                                    style="text-decoration: none;">Detalles</a>
                                                <br>  --}}
                                                {{--  <a href="javascript:void(0);"
                                                    onclick="validarImportacion('{{ $empleado->RFC }}');"
                                                    class="text-primary" style="text-decoration: none;">Importar</a>  --}}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No se encontraron coincidencias</td>
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
