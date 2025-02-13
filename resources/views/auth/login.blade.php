<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm" style="background:#263572;">
            <div class="container">
                <a class="navbar-brand text-light" href="{{ url('/') }}">
                    <img src="{{ asset('img/brand.png') }}" alt="logo_prom" class="img-circle p-1" width="40"
                        style="background-color:white;border-radius:150px">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>
        </nav>

        <main class="py-1">
            <div class="container">
                <br><br><br>
                <div class="row justify-content-center">
                    <center>
                        <img src="{{ asset('img/logo-grupo-prom.png') }}" width="180"
                            height="140"draggable="false">
                    </center>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header text-light" style="background:#263572;">
                                INGRESE SUS CREDENCIALES A CONTINIACIÓN
                            </div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="Usuario" class="col-md-4 col-form-label text-md-end">
                                            USUARIO
                                        </label>
                                        <div class="col-md-6">
                                            <input id="Usuario" type="text" placeholder="Ingrese su usuario"
                                                class="form-control @error('Usuario') is-invalid @enderror"
                                                name="Usuario" value="{{ old('Usuario') }}" required
                                                autocomplete="Usuario" autofocus>

                                            @error('Usuario')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="PWD" class="col-md-4 col-form-label text-md-end">
                                            PASSWORD
                                        </label>
                                        <div class="col-md-6">
                                            <input id="PWD" type="password" placeholder="**********"
                                                class="form-control @error('PWD') is-invalid @enderror" name="PWD"
                                                required autocomplete="current-password">

                                            @error('PWD')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{--  <div class="row mb-3">
                                        <div class="col-md-6 offset-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    Recuérdame
                                                </label>
                                            </div>
                                        </div>
                                    </div>  --}}
                                    <div class="row">
                                        <div class="col-md-12 offset-md-12">
                                            {{--  <a class="btn btn-link" href="#">
                                                Olvidé mi password
                                            </a>  --}}
                                            <button type="submit" class="btn btn-primary" style="float:right;">
                                                ACCEDER
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
