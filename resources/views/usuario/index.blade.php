@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-light font-weight-bold" style="background:#263572;">
                        @can('Crear usuarios')
                            <div class="float-right">
                                <a href="{{ route('user.create') }}" title="Abregar usuario"
                                    class="btn btn-primary text-light"><span class="icon-user-plus"></span></a>
                            </div>
                            <br>
                        @endcan
                        Usuarios
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div style="width: 100%;overflow:hidden;overflow-x:scroll;">
                                <table class="table">
                                    <thead>
                                        <th>Rol</th>
                                        <th>Centro de costo</th>
                                        <th>Nombre</th>
                                        <th>Usuario</th>
                                        <th>Email</th>
                                        <th>&nbsp;</th>
                                    </thead>
                                    <tbody>
                                        @forelse($usuarios as $key => $usuario)
                                            <tr>
                                                <td>
                                                    @foreach ($usuario->roles as $key => $rol)
                                                        {{ $rol->name }}<br>
                                                    @endforeach
                                                </td>
                                                <td>{{ $usuario->centro->CC }}</td>
                                                <td>{{ $usuario->name }} {{ $usuario->apaterno }} {{ $usuario->amaterno }}
                                                </td>
                                                <td>{{ $usuario->usuario }}</td>
                                                <td>{{ $usuario->email }}</td>
                                                <td>
                                                    @can('Editar usuarios')
                                                        <a href="{{ route('user.edit', $usuario) }}" title="Editar"
                                                            class="btn btn-warning text-light"><span
                                                                class="icon-pencil"></span></a>
                                                        &nbsp;
                                                    @endcan

                                                    <a href="javascript:void(01);"
                                                        onclick="eliminarUsuario({{ $usuario->id }})" title="Eliminar"
                                                        class="btn btn-danger text-light"><span class="icon-bin"></span></a>
                                                    <form action="{{ route('user.destroy', $usuario) }}"
                                                        id="form_eliminar_usuario_{{ $usuario->id }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                        </body>
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
