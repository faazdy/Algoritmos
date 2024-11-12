<?php
require '../../../../config/config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html"); // Redirigir si no está autenticado
    exit;
}

$sql = "SELECT * FROM mesas";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Mesas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../../../public/css/main.css">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
              <a class="navbar-brand" href="../../indexAdmin.php">Portal Administrador | Mi Primera Borrachera</a>
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
                      <a class="nav-link text-light" aria-current="page" href="../../indexAdmin.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-light" aria-current="page" href="../../register.html">Registrar Cajero</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-light" aria-current="page" href="../../register.html">Registrar Mesero</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-light" aria-current="page" href="../../register.html">Registrar Administrador</a>
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
    <main class="container mt-5">
        <h1>Lista de Mesas</h1>
        <a href="addMesa.php" class='btn btn-dark'>Añadir</a>
        <hr class='hr'>
        <table class='table table-striped'>
            <tr>
                <th>ID</th>
                <th>Número de Mesa</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['idMesa']; ?></td>
                <td><?php echo $row['numeroMesa']; ?></td>
                <td><?php echo $row['disponible']; ?></td>
                <td>
                    <a class='btn btn-warning' href="editMesa.php?id=<?php echo $row['idMesa']; ?>">Editar</a>
                    <a class='btn btn-danger' href="deleteMesa.php?id=<?php echo $row['idMesa']; ?>" onclick="return confirm('¿Seguro que deseas eliminar esta mesa?');">Eliminar</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </main>
</body>
</html>