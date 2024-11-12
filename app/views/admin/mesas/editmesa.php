<?php
require '../../../../config/config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html"); // Redirigir si no está autenticado
    exit;
}

$id = $_GET['id'];

// Obtener los detalles de la mesa
$sql = "SELECT * FROM mesas WHERE idMesa = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$mesa = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numeroMesa = $_POST['numeroMesa'];
    $disponible = $_POST['disponible'];

    $sql = "UPDATE mesas SET numeroMesa = ?, disponible = ? WHERE idMesa = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isi", $numeroMesa, $disponible, $id);

    if ($stmt->execute()) {
        echo "Mesa actualizada con éxito.";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Editar Mesa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body class="bg-light">
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
    <div class="container mt-5">
        <h1 class="mb-4">Editar Mesa</h1>
        <form action="editMesa.php?id=<?php echo $id; ?>" method="POST" class="needs-validation" novalidate>
            <div class="form-group">
                <label for="numeroMesa">Número de Mesa:</label>
                <input type="number" class="form-control" id="numeroMesa" name="numeroMesa" value="<?php echo htmlspecialchars($mesa['numeroMesa']); ?>" required>
                <div class="invalid-feedback">
                    Por favor ingrese un número de mesa.
                </div>
            </div>
            <div class="form-group">
                <label for="disponible">Estado:</label>
                <select class="form-control" id="disponible" name="disponible" required>
                    <option value="">Seleccione una opción...</option>
                    <option value="disponible" <?php if ($mesa['disponible'] == 'disponible') echo 'selected'; ?>>Disponible</option>
                    <option value="ocupada" <?php if ($mesa['disponible'] == 'ocupada') echo 'selected'; ?>>Ocupada</option>
                </select>
                <div class="invalid-feedback">
                    Por favor seleccione el estado de la mesa.
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-dark">Actualizar Mesa</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>