@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-light font-weight-bold" style="background:#263572;">
                        {{--  @can('Crear usuarios')
                            <div class="float-right">
                                <a href="{{ route('user.create') }}" title="Abregar usuario"
                                    class="btn btn-primary text-light"><span class="icon-user-plus"></span></a>
                            </div>
                            <br>
                        @endcan  --}}
                        Usuarios
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div style="width: 100%;overflow:hidden;overflow-x:scroll;">
                                {{ $usuarios->links('pagination::bootstrap-4') }}
                                <table class="table">
                                    <thead>
                                        <th>Rol</th>
                                        <th>Cuentas</th>
                                        <th>Nombre</th>
                                        <th>Usuario</th>
                                        <th>Email</th>
                                        <th>&nbsp;</th>
                                    </thead>
                                    <tbody>
                                        @forelse($usuarios as $key => $usuario)
                                            <tr>
                                                <td>
                                                    @forelse($usuario->roles as $key => $rol)
                                                        <span class="text-success">{{ $rol->name }}</span>
                                                    @empty
                                                        <span class="text-warning">No asignado</span>
                                                    @endforelse
                                                </td>
                                                <td>
                                                    @php
                                                        $cc_pps = '';
                                                        foreach ($usuario->planes as $item) {
                                                            $cc_pps .=
                                                                $item->plan->centro_costo->CC .
                                                                ' - ' .
                                                                $item->plan->NCUENTA .
                                                                ', ';
                                                        }
                                                    @endphp
                                                    {{ Str::limit($cc_pps, 140) }}
                                                </td>
                                                <td>{{ $usuario->Nombre }}
                                                </td>
                                                <td>{{ $usuario->Usuario }}</td>
                                                <td>{{ $usuario->mail }}</td>
                                                <td>
                                                    @can('Editar usuarios')
                                                        {{--  <a href="{{ route('user.edit', $usuario) }}" title="Editar"
                                                            class="btn btn-warning text-light"><span
                                                                class="icon-pencil"></span></a>
                                                        &nbsp;  --}}
                                                        @php
                                                            $rol_default = '';
                                                            if (count($usuario->roles) > 0) {
                                                                $rol_default = $usuario->roles[0]->name;
                                                            }
                                                        @endphp
                                                        <a href="javascript:void(0);"
                                                            onclick="asisgnarRol({{ $usuario->idusuario }},'{{ $rol_default }}');"
                                                            title="Asignar Rol" class="btn btn-warning text-light"><span
                                                                class="icon-key"></span></a>
                                                        &nbsp;
                                                    @endcan

                                                    {{--  <a href="javascript:void(01);"
                                                        onclick="eliminarUsuario({{ $usuario->id }})" title="Eliminar"
                                                        class="btn btn-danger text-light"><span class="icon-bin"></span></a>
                                                    <form action="{{ route('user.destroy', $usuario) }}"
                                                        id="form_eliminar_usuario_{{ $usuario->id }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>  --}}
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
    @can('Editar usuarios')
        @include('usuario.modal_editar_rol')
    @endcan
@endsection
