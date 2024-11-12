<?php
session_start();
if ($_SESSION['rol'] !== 'cajero') {
    header("Location: login.html");
    exit;
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html"); // Redirigir si no está autenticado
    exit;
}
// Conexión a la base de datos
require '../../../config/config.php'; // Ajusta la ruta según tu estructura

try {
    $stmt = $conn->prepare("
        SELECT Mesas.idMesa, Mesas.numeroMesa, Pedidos.idPedido, Meseros.nombre AS nombreMesero
        FROM Mesas
        JOIN Pedidos ON Mesas.idMesa = Pedidos.idMesa
        JOIN Meseros ON Pedidos.idMesero = Meseros.idMesero
        WHERE Pedidos.estado = 'abierto'
    ");

    // Verifica si la preparación de la consulta fue exitosa
    if (!$stmt) {
        throw new Exception("Error en la preparación de la consulta: " . $conn->error);
    }

    // Ejecuta la consulta
    $stmt->execute();

    // Obtiene los resultados de la consulta
    $result = $stmt->get_result();

    if ($result) {
        $mesasOcupadas = $result->fetch_all(MYSQLI_ASSOC); // Usa fetch_all para obtener un array asociativo
    } else {
        throw new Exception("Error en la ejecución de la consulta: " . $conn->error);
    }

} catch (Exception $e) {
    echo "Error en la consulta: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/css/main.css">
    <link rel="stylesheet" href="../../../public/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Cerrar Pedidos</title>
</head>
<body>
        <nav class="navbar navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
              <a class="navbar-brand" href="../indexCajero.php">Portal Cajero | Chapinero</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                  <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Hola! <span style="color: orange;">Cajero</span></h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                  <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                  <li class="nav-item">
                      <a class="nav-link text-light" aria-current="page" href="../indexCajero.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-light" aria-current="page" href="CRUD/productos.php">Gestionar inventario</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-light" aria-current="page" href="stock.php">Ver inventario</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-light" aria-current="page" href="../cajero/pedidos.php">Ver pedidos</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-light" aria-current="page" href="../cajero/mesas.php">Cerrar pedidos</a>
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
    <div class="container mt-5">
        <h2>Mesas Ocupadas</h2>
        <table class='table table-striped'>
            <thead>
                <tr>
                    <th>Número de Mesa</th>
                    <th>ID de Pedido</th>
                    <th>Nombre del Mesero</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($mesasOcupadas as $mesa): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($mesa['numeroMesa']); ?></td>
                        <td><?php echo htmlspecialchars($mesa['idPedido']); ?></td>
                        <td><?php echo htmlspecialchars($mesa['nombreMesero']); ?></td>
                        <td>
                            <form action="cerrarPedido.php" method="POST">
                                <input type="hidden" name="idPedido" value="<?php echo htmlspecialchars($mesa['idPedido']); ?>">
                                <button type="submit" class="btn btn-danger">Cerrar Pedido</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
