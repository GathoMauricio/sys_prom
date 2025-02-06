@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-light font-weight-bold" style="background:#263572;">
                        Crear usuario
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <form action="{{ route('user.store') }}" method= "POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Nombre</label>
                                            <input type="text" name="name" value="{{ old('name') }}"
                                                class="form-control" required>
                                            @error('name')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>A. Paterno</label>
                                            <input type="text" name="apaterno" value="{{ old('apaterno') }}"
                                                class="form-control" required>
                                            @error('apaterno')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>A. Materno</label>
                                            <input type="text" name="amaterno" value="{{ old('amaterno') }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" value="{{ old('email') }}"
                                                class="form-control" required>
                                            @error('email')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Usuario</label>
                                            <select name="rol" class="form-select" required>
                                                <option value>--Seleccione una opción--</option>
                                                @foreach ($roles as $key => $rol)
                                                    @if ($rol->name == old('rol'))
                                                        <option value="{{ $rol->name }}" selected>{{ $rol->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $rol->name }}">{{ $rol->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('rol')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Usuario</label>
                                            <input type="text" name="usuario" value="{{ old('usuario') }}"
                                                class="form-control" required>
                                            @error('usuario')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Contraseña</label>
                                            <input type="password" name="password" class="form-control" required>
                                            @error('password')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Repetir contraseña</label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary btn-block">Guardar usuario</button>
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
