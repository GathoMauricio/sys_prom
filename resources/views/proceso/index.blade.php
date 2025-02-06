@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-light font-weight-bold" style="background:#263572;">
                        <a href="{{ route('procesos') }}" style="color:white;">
                            Procesos en etapa de precontratación
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <form action="{{ route('procesos') }}">
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
                                            <th>Fecha</th>
                                            <th>Autor</th>
                                            <th>RFC</th>
                                            <th>Tipo</th>
                                            <th>Etapa</th>
                                            <th>Documentación</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($procesos as $proceso)
                                            <tr>
                                                <td>{{ explode(' ', $proceso->created_at)[0] }}</td>
                                                <td>{{ $proceso->autor->name }}</td>
                                                <td>{{ $proceso->empleado->nombre }} {{ $proceso->empleado->apaterno }}
                                                    {{ $proceso->empleado->amaterno }}
                                                    <br>
                                                    RFC: {{ $proceso->empleado->rfc }}
                                                </td>
                                                <td>{{ $proceso->tipo }}</td>
                                                <td>{{ $proceso->estatus }}</td>
                                                <td>{{ $proceso->estatus_documentacion }}</td>
                                                <td>
                                                    <a href="{{ route('seguimiento_empleado', base64_encode($proceso->empleado->rfc)) }}"
                                                        title="Detalles">
                                                        <span class="icon icon-eye"></span>
                                                    </a>
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
