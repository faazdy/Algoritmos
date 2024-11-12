<?php
require '../../../config/config.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'mesero') {
    header("Location: login.html");
    exit;
}

if (!isset($_GET['idPedido'])) {
    echo "Error: No se ha especificado un pedido.";
    exit;
}

$idPedido = intval($_GET['idPedido']);

$sql = "SELECT p.idPedido, p.fecha, p.estado, m.numeroMesa, pp.cantidad, pr.nombreProducto 
        FROM Pedidos p
        INNER JOIN Mesas m ON p.idMesa = m.idMesa
        INNER JOIN PedidoProducto pp ON p.idPedido = pp.idPedido
        INNER JOIN Productos pr ON pp.idProducto = pr.idProducto
        WHERE p.idPedido = ?";
$stmt = $conn->prepare($sql);

$stmt->bind_param('i', $idPedido);
$stmt->execute();
$result = $stmt->get_result();

if ($stmt->error) {
    echo "Error en la ejecución de la consulta: " . $stmt->error;
    exit;
}

if ($result->num_rows === 0) {
    echo "No se encontraron detalles para este pedido.";
    exit;
}

// Obtener información general del pedido
$rowPedido = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                            <a class="nav-link text-light" href="../indexMesero.php">Inicio</a>
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
        <h1>Detalles del Pedido #<?php echo htmlspecialchars($rowPedido['idPedido']); ?></h1>
        <p><strong>Estado:</strong> <?php echo htmlspecialchars($rowPedido['estado']); ?></p>
        <p><strong>Número de Mesa:</strong> <?php echo htmlspecialchars($rowPedido['numeroMesa']); ?></p>

        <h2>Productos</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre del Producto</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Reiniciar el puntero del resultado para mostrar todos los productos
                $stmt->execute(); // Reejecutar la consulta
                $result = $stmt->get_result(); // Obtener el resultado nuevamente

                while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nombreProducto']); ?></td>
                        <td><?php echo htmlspecialchars($row['cantidad']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        
        <a href="mesero_pedido.php" class="btn btn-primary">Volver a Mis Pedidos</a>
    </div>
</body>
</html>
