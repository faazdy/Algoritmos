<!-- resources/views/dashboards/dashboard_mesero.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Cajero</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <h1>Bienvenido, CAJERO </h1>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-danger">
            Cerrar Sesion
        </a>
</body>
</html>
