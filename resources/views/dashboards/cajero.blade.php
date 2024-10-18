<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="{{ asset('css/cards.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <title>Cajero | Mi Primera Borrachera</title>
    </head>
    <body>
        <nav class="navbar navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">Portal Cajero | Chapinero</a>
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
                      <a class="nav-link text-light" aria-current="page" href="#">Gestionar inventario</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-light" aria-current="page" href="#">Ver inventario</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-light" aria-current="page" href="#">Ver pedidos</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-light" aria-current="page" href="#">Cerrar pedidos</a>
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
        <main style="background-color: rgb(250, 250, 250);">
            <section>
              <div class="profile">
                <img src="{{ asset('imgs/cajero.webp') }}" alt="cajero-pic">
                <h1>Hola, <span style="color: orange;">{{ Auth::user()->email }}</span></h1>
              </div>
            </section>
            <section>
              <h2>Inventario</h2>
              <div class="cards-container">
                <div class="card text-center">
                  <a href="{{ route('cajero.ver_stock')}}" 
                    class="">
                    <img src="{{ asset('imgs/inventario.webp') }}" alt="">
                    <h5>Ver Stock</h5>
                  </a>
                </div>
                <div class="card text-center">
                  <a href="{{ url('') }}" 
                    class="">
                    <img src="{{ asset('imgs/addInventario.webp') }}" alt="">
                    <h5>Gestionar Stock</h5>
                  </a>
                </div>
              </div>
            </section>
            <hr>
            <section>
              <h2>Pedidos</h2>
              <div class="cards-container">
                <div class="card text-center">
                  <a href="{{ url('') }}" 
                    class="">
                    <img src="{{ asset('imgs/pedido.webp') }}" alt="">
                    <h5>Ver Pedidos</h5>
                  </a>
                </div>
                <div class="card text-center">
                  <a href="{{ url('') }}" 
                    class="">
                    <img src="{{ asset('imgs/pedido2.webp') }}" alt="">
                    <h5>Cerrar Pedido</h5>
                  </a>
                </div>
              </div>
            </section>
            <hr>
            <section>
              <h2>Reportes</h2>
              <div class="cards-container">
                <div class="card text-center">
                  <a href="{{ url('') }}" 
                    class="">
                    <img src="{{ asset('imgs/reporte.webp') }}" alt="">
                    <h5>Generar reporte</h5>
                  </a>
                </div>
              </div>
            </section>
        </main>
    </body>
</html>
