<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html"); // Redirigir si no está autenticado
    exit;
}
if ($_SESSION['rol'] !== 'mesero') {
    header("Location: login.html");
    exit;
}

require_once '../../config/config.php'; 

try {
    $stmt = $conn->prepare("
        SELECT Mesas.idMesa, Mesas.numeroMesa, 
               IF(Pedidos.estado = 'abierto', 1, 0) AS mesaOcupada
        FROM Mesas
        LEFT JOIN Pedidos ON Mesas.idMesa = Pedidos.idMesa AND Pedidos.estado = 'abierto'
    ");

    if (!$stmt) {
        throw new Exception("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        $mesas = $result->fetch_all(MYSQLI_ASSOC);
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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../public/css/cards.css">
    <link rel="stylesheet" href="../../public/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Mesero</title>
</head>
<body>
<nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Portal Mesero | Chapinero</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar">
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
                        <a class="nav-link text-light" aria-current="page" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" aria-current="page" href="mesero/mesero_pedido.php">Tus pedidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" aria-current="page" href="mesero/stock.php">Ver inventario</a>
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

<main style="background-color: rgb(250, 250, 250);">
    <section>
        <div class="profile">
            <img src="../../public/imgs/mesero.webp" alt="mesero-pic">
            <h1>Hola, <span style="color: orange;">Mesero</span></h1>
        </div>
    </section>

    <section>
        <h2>Mesas</h2>
        <article class="cards-container-mesero">
            <?php foreach ($mesas as $mesa): ?>
                <div class="card text-center <?= $mesa['mesaOcupada'] ? 'btn disabled' : '' ?>">
                    <span>
                        <img src="../../public/imgs/mesa.webp" alt="">
                    </span>
                    <h5>Mesa #<?= $mesa['numeroMesa'] ?></h5>
                    <a href="mesero/tomarPedido.php?mesa=<?= $mesa['idMesa'] ?>" class="btn <?= $mesa['mesaOcupada'] ? 'btn-secondary disabled' : 'btn-warning' ?>">
                        <?= $mesa['mesaOcupada'] ? 'Mesa ocupada' : 'Tomar pedido' ?>
                    </a>
                </div>
            <?php endforeach; ?>
        </article>
        <hr>
        <article>
            <h2>Inventario</h2>
            <div class="cards-container">
                <div class="card text-center">
                    <a href="mesero/stock.php">
                        <img src="../../public/imgs/inventario.webp" alt="">
                        <h5>Ver Stock</h5>
                    </a>
                </div>
            </div>
        </article>
    </section>
</main>

</body>
</html>
