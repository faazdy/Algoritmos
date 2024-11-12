<?php
require '../../../../config/config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html"); // Redirigir si no está autenticado
    exit;
}
$idProducto = $_GET['idProducto'];
$sql = "SELECT * FROM productos WHERE idProducto = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idProducto);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombreProducto = $_POST['nombreProducto'];
    $precio = $_POST['precio'];
    $costo = $_POST['costo'];
    $cantidad = $_POST['cantidad'];

    // Actualizar el producto en la base de datos
    $sql = "UPDATE productos SET nombreProducto = ?, precio = ?, costo = ?, cantidad = ? WHERE idProducto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $nombreProducto, $precio, $costo, $cantidad, $idProducto);
    $stmt->execute();

    header("Location: productos.php"); // Redirigir a la lista de productos
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
                      <a class="nav-link text-light" aria-current="page" href="../../cajero/cerrarPedido.php">Cerrar pedidos</a>
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
    <h1>Editar Producto</h1>
    <form method="POST">
        <div class="form-group">
            <label for="nombreProducto">Nombre del Producto</label>
            <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" value="<?php echo htmlspecialchars($product['nombreProducto']); ?>" required>
        </div>
        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="text" class="form-control" id="precio" name="precio" value="<?php echo htmlspecialchars($product['precio']); ?>" required>
        </div>
        <div class="form-group">
            <label for="costo">Costo</label>
            <input type="text" class="form-control" id="costo" name="costo" value="<?php echo htmlspecialchars($product['costo']); ?>" required>
        </div>
        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" value="<?php echo htmlspecialchars($product['cantidad']); ?>" required>
        </div>
        <button type="submit" class="btn btn-dark">Actualizar</button>
        <a href="productos.php" class="btn btn-outline-dark">Cancelar</a>
    </form>
</div>

</body>
</html>

<?php
$conn->close();
?>
