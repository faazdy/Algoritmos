<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html"); // Redirigir si no está autenticado
    exit;
}

// Acceder al correo almacenado en la sesión
$email = isset($_SESSION['email']) ? $_SESSION['email'] : 'Invitado'; 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="../../public/css/cards.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <title>Administrador</title>
    </head>
    <body>
        <nav class="navbar navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">Portal Administrador | Mi Primera Borrachera</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">
                    Hola, <span style='color: rgb(180, 133, 255);'><?php echo $_SESSION['email']; ?></span>
                </h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                  <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                      <a class="nav-link text-light" aria-current="page" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-light" aria-current="page" href="register.html">Registrar Cajero</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-light" aria-current="page" href="register.html">Registrar Mesero</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-light" aria-current="page" href="register.html">Registrar Administrador</a>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Más opciones
                      </a>
                      <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="#">Modifica Cajero</a></li>
                        <li><a class="dropdown-item" href="#">Modificar Mesero</a></li>
                        <li><a class="dropdown-item" href="#">Modificar Administrador</a></li>
                        <li>
                          <hr class="dropdown-divider">
                        </li>
                        <li>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                          </form>
                          <a href="../../src/logout.php" 
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
                <img src="../../public/imgs/admin.webp" alt="cajero-pic">
                <h1>Hola, <span style="color: rgb(180, 133, 255);"><?php echo $_SESSION['email']; ?></span></h1>
              </div>
            </section>
            <h2>Registrar Empleados</h2>
            <section class="cards-container"> 
                <div class="card text-center">
                    <a 
                        href="register.html" 
                        class="">
                        <img src="../../public/imgs/employees.webp" alt="">
                        <h5>Nuevos empleados</h5>
                    </a>
                </div>
            </section>
            <hr>
            <h2>Administrar Sedes</h2>
            <section class="cards-container">
                <div class="card text-center">
                    <a href="">
                        <img src="../../public/imgs/sede.webp" alt="">
                        <h5>Sede Chapinero</h5>
                    </a>
                </div>
                <div class="card text-center">
                    <a href="">
                        <img src="../../public/imgs/sede.webp" alt="">
                        <h5>Sede Chía</h5>
                    </a>
                </div>
                <div class="card text-center">
                    <a href="">
                        <img src="../../public/imgs/sede.webp" alt="">
                        <h5>Sede Galerias</h5>
                    </a>
                </div>
                <div class="card text-center">
                    <a href="">
                        <img src="../../public/imgs/sede.webp" alt="">
                        <h5>Sede Restrepo</h5>
                    </a>
                </div>
            </section>
            <hr>
            <h2>Administrar Mesas</h2>
            <section class="cards-container">
                <div class="card text-center">
                    <a href="admin/mesas/verMesas.php">
                        <img src="../../public/imgs/sede.webp" alt="">
                        <h5>Ver Mesas</h5>
                    </a>
                </div>
            </section>
        </main>
    </body>
</html>

