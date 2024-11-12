<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tomar Pedido - Mi Primera Borrachera</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
          <nav class="navbar navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
              <a class="navbar-brand" href="{{ url('/dashboard/mesero')}}">Portal Mesero | Chapinero</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                  <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Hola! <span style="color: orange;">{{ Auth::user()->email }}</span></h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                  <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                      <a class="nav-link text-light" aria-current="page" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-light" aria-current="page" href="{{ route('mesero.tusMesas') }}">Tus mesas</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-light" aria-current="page" href="{{ route('mesero.verInventario') }}">Ver Menu</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-light" aria-current="page" href="#">Ver inventario</a>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Más opciones
                      </a>
                      <ul class="dropdown-menu dropdown-menu-dark">
                        <li>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                          </form>
                          <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="link-danger dropdown-item">
                            Cerrar Sesion
                          </a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </nav>    

    <main class="container my-4">
        <h2>Mesa <span id="mesa-number"></span></h2>
        <h3 class="mt-4">Menú</h3>

        <h1>Tomar Pedido</h1>

        <!-- Botón para volver a las mesas -->
        <div class="mb-3">
            <a href="{{ url('/ruta-a-las-mesas') }}" class="btn btn-secondary">Volver a Mesas</a>
        </div>

        <h3 class="mt-4">Productos Disponibles</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Costo Venta</th>
                    <th>Precio Venta</th>
                    <th>Agregar</th>
                </tr>
            </thead>
            <tbody>
                @if($productos->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center">No hay productos disponibles.</td>
                    </tr>
                @else
                    @foreach ($productos as $producto)
                    <tr>
                        <td>{{ $producto->nombreProducto }}</td>
                        <td>{{ $producto->descripcion }}</td>
                        <td>
                            <input type="number" class="form-control" min="0" value="0" id="cantidad-{{ $producto->id }}">
                        </td>
                        <td>${{ number_format($producto->costoVenta, 2) }}</td>
                        <td>${{ number_format($producto->precioVenta, 2) }}</td>
                        <td>
                            <button class="btn btn-primary" onclick="agregarProducto('{{ $producto->nombreProducto }}', {{ $producto->precioVenta }}, document.getElementById('cantidad-{{ $producto->id }}').value)">Agregar</button>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        <h3 class="mt-4">Resumen del Pedido</h3>
        <ul id="resumen-pedido" class="list-group mb-4"></ul>
        <h4>Total: $<span id="total-pedido">0</span></h4>
        <button type="button" class="btn btn-success" onclick="enviarPedido()">Enviar Pedido</button>
    </main>

    <!-- Scripts -->
    <script src="{{ asset('js/pedidoMesero.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
