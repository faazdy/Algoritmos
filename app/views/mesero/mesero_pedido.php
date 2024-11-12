<?php
// Incluir la conexión a la base de datos
require '../../../config/config.php';
session_start();

// Verificar si el mesero está autenticado
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'mesero') {
    header("Location: login.html");
    exit;
}

$idUsuario = $_SESSION['user_id'];

// Obtener el idMesero a partir del idUsuario
$sqlMesero = "SELECT idMesero FROM usuarios WHERE idUsuario = ?";
$stmtMesero = $conn->prepare($sqlMesero);
$stmtMesero->bind_param('i', $idUsuario);
$stmtMesero->execute();
$resultMesero = $stmtMesero->get_result();

if ($resultMesero->num_rows > 0) {
    $rowMesero = $resultMesero->fetch_assoc();
    $idMesero = $rowMesero['idMesero'];
} else {
    echo "Error: No se encontró el mesero asociado al usuario.";
    exit;
}

// Obtener los pedidos del mesero, incluyendo la mesa y los productos asociados
$sql = "SELECT p.idPedido, p.fecha, p.estado, m.numeroMesa, pp.cantidad, pr.nombreProducto 
        FROM Pedidos p
        INNER JOIN Mesas m ON p.idMesa = m.idMesa
        INNER JOIN PedidoProducto pp ON p.idPedido = pp.idPedido
        INNER JOIN Productos pr ON pp.idProducto = pr.idProducto
        WHERE p.idMesero = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo "Error en la preparación de la consulta: " . $conn->error;
    exit;
}

$stmt->bind_param('i', $idMesero);
$stmt->execute();
$result = $stmt->get_result();

if ($stmt->error) {
    echo "Error en la ejecución de la consulta: " . $stmt->error;
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Pedidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Portal Mesero | Chapinero</a>
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
                            <a class="nav-link text-light" aria-current="page" href="../indexMesero.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#">Tus mesas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#">Ver inventario</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Más opciones
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    <a href="../../../src/logout.php" class="link-danger dropdown-item">Cerrar Sesión</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>Mis Pedidos</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Número de Pedido</th>
                    <th>Estado</th>
                    <th>Mesa</th>
                    <th>Cantidad</th>
                    <th>Producto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['idPedido']); ?></td>
                            <td><?php echo htmlspecialchars($row['estado']); ?></td>
                            <td><?php echo htmlspecialchars($row['numeroMesa']); ?></td>
                            <td><?php echo htmlspecialchars($row['cantidad']); ?></td>
                            <td><?php echo htmlspecialchars($row['nombreProducto']); ?></td>
                            <td>
                                <a href="ver_pedido.php?idPedido=<?php echo htmlspecialchars($row['idPedido']); ?>" class="btn btn-info">Ver Detalles</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">No hay pedidos para mostrar.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
