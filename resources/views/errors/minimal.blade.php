<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Error @yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .error-container {
            text-align: center;
            max-width: 600px;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .error-code {
            font-size: 80px;
            font-weight: bold;
            color: #dc3545;
        }

        .error-message {
            font-size: 20px;
            margin-bottom: 20px;
        }

        .btn-home {
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="error-container">
        <h1 class="error-code">@yield('code')</h1>
        <p class="error-message">@yield('message')</p>
        <a href="{{ url('/') }}" class="btn btn-primary btn-home">Volver al inicio</a>
    </div>

</body>

</html>
