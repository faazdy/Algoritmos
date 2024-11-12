<?php
require '../../../../config/config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html"); // Redirigir si no está autenticado
    exit;
}
// Obtener los productos de la base de datos
$sql = "SELECT * FROM productos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../../../public/css/main.css">
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
                  <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Hola! <span style="color: orange;"><?php echo $_SESSION['email']; ?></span></h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                  <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                  <li class="nav-item">
                      <a class="nav-link text-light" aria-current="page" href="../../indexCajero.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-light" aria-current="page" href="../../cajero/CRUD/productos.php">Gestionar inventario</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-light" aria-current="page" href="../../cajero/stock.php">Ver inventario</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-light" aria-current="page" href="../../cajero/pedidos.php">Ver pedidos</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-light" aria-current="page" href="../../cajero/mesas.php">Cerrar pedidos</a>
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
                          <a href="../../../../src/logout.php"
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
<div class="container mt-5">
  <div class="hero">
    <h1>Lista de Productos</h1>
    <p>
      Bienvenido a la gestion de stock, donde puede agregar, ediar y eliminar productos.
    </p>
  </div>
  <hr>
    <a href="addProducto.php" class="btn btn-dark mb-3">Agregar Producto</a>
    <table class="table table-bordered">
        <thead>
            <tr class='table-dark'>
                <th>Nombre del Producto</th>
                <th>Precio</th>
                <th>Costo</th>
                <th>Cantidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['nombreProducto']) . "</td>";
                    echo "<td> $" . htmlspecialchars($row['precio']) . "</td>";
                    echo "<td> $" . htmlspecialchars($row['costo']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['cantidad']) . "</td>";
                    echo "<td>
                                <a href='editar.php?idProducto=" . $row['idProducto'] . "' class='btn btn-warning'>Editar</a>
                                <a href='delete.php?idProducto=" . $row['idProducto'] . "' class='btn btn-danger'>Eliminar</a>
                            </td>
                            ";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No se encontraron productos.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php
$conn->close();
?>