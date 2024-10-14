<!-- resources/views/dashboards/dashboard_mesero.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mesero</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <h1>Bienvenido, {{ Auth::user()->nombre }}</h1>
    <a href="{{ route('logout') }}">Cerrar Sesión</a>
</body>
</html>
