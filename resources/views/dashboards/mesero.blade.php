<!-- resources/views/dashboards/mesero.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Primera Borrachera - Mesas</title>
    <!-- Enlazando Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- Archivo CSS externo -->
</head>
<body>
    <header class="bg-dark text-white text-center py-4">
        <h1>Toma de Pedidos - Mi Primera Borrachera</h1>
        <h2>Bienvenido <span style='color: Yellow;'>{{ Auth::user()->email }}</span></h2>
        <p class="lead">Administra las mesas de manera eficiente</p>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-danger">
            Cerrar Sesion
        </a>
    </header>
    
    <main class="container my-4">
        <section class="row">
            <!-- Mesa 1 -->
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="mesa card text-center available" id="mesa-1">
                    <div class="card-body">
                        <h2 class="card-title">Mesa 1</h2>
                        <p class="estado">Estado: Disponible</p>
                        <a href="mesero/tomar-pedido.html?mesa=1" class="btn btn-success">Tomar Pedido</a>
                    </div>
                </div>
            </div>

            <!-- Mesa 2 -->
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="mesa card text-center occupied" id="mesa-2">
                    <div class="card-body">
                        <h2 class="card-title">Mesa 2</h2>
                        <p class="estado">Estado: Ocupada</p>
                        <button class="btn btn-danger" disabled>No disponible</button>
                    </div>
                </div>
            </div>

            <!-- Mesa 3 -->
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="mesa card text-center available" id="mesa-3">
                    <div class="card-body">
                        <h2 class="card-title">Mesa 3</h2>
                        <p class="estado">Estado: Disponible</p>
                        <a href="mesero/tomar-pedido.html?mesa=3" class="btn btn-success">Tomar Pedido</a>
                    </div>
                </div>
            </div>

            <!-- Mesa 4 -->
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="mesa card text-center occupied" id="mesa-4">
                    <div class="card-body">
                        <h2 class="card-title">Mesa 4</h2>
                        <p class="estado">Estado: Ocupada</p>
                        <button class="btn btn-danger" disabled>No disponible</button>
                    </div>
                </div>
            </div>

            <!-- Puedes agregar más mesas de la misma manera -->
        </section>
    </main>

    <footer class="bg-light text-center py-3">
        <p>&copy; 2024 Mi Primera Borrachera. Todos los derechos reservados.</p>
    </footer>

    <!-- Enlazando Bootstrap y jQuery JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="script.js"></script> <!-- Enlazando el archivo JS externo -->
</body>
</html>

