<?php
require '../../../config/config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html"); // Redirigir si no está autenticado
    exit;
}

$sql = "SELECT * FROM productos";
$result = $conn->query($sql);

$idMesa = 1; //aqui reemplazar por el id de la mesa  la que ingresé
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tomar Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        let totalPedido = 0;

        // Función para agregar producto al pedido
        function agregarProducto(nombre, precio, stock) {
            const cantidad = parseInt($('#cantidad_' + nombre).val());

            // Verifica si la cantidad ingresada es válida y está disponible en stock
            if (isNaN(cantidad) || cantidad <= 0) {
                alert('Por favor, ingresa una cantidad válida.');
                return;
            }

            if (cantidad > stock) {
                alert('No hay suficientes productos en stock.');
                return;
            }

            // Agrega el producto a la tabla de pedidos
            const totalProducto = precio * cantidad;
            $('#tabla-pedido').append(`
                <tr>
                    <td>${nombre}</td>
                    <td>${precio.toFixed(2)}</td>
                    <td>${cantidad}</td>
                    <td>${totalProducto.toFixed(2)}</td>
                </tr>
            `);

            // Actualiza el total del pedido
            totalPedido += totalProducto;
            $('#total-pedido').text(totalPedido.toFixed(2));
        }

        // Función para confirmar el pedido
        function confirmarPedido() {
            const productos = [];
            $('#tabla-pedido tr').each(function () {
                const nombre = $(this).find('td').eq(0).text(); // Nombre del producto
                const cantidad = parseInt($(this).find('td').eq(2).text()); // Cantidad del producto
                productos.push({ nombre, cantidad });
            });

            if (productos.length === 0) {
                alert('No hay productos en el pedido.');
                return; // No hacer nada si no hay productos
            }

            const idMesa = $('#idMesa').val(); // Obtener el ID de la mesa

            // Hacer una llamada AJAX para actualizar el stock en la base de datos
            $.ajax({
                type: 'POST',
                url: 'confirmarPedido.php', // Ruta del archivo PHP que maneja la actualización
                data: { productos: productos, idMesa: idMesa },
                success: function (response) {
                    console.log(response);
                    alert('Pedido confirmado con éxito: ' + response);
                    // Limpiar el pedido
                    $('#tabla-pedido').empty();
                    totalPedido = 0;
                    $('#total-pedido').text('0.00');
                },
                error: function (xhr, status, error) {
                    alert('Error al confirmar el pedido: ' + error);
                }
            });
        }
    </script>
</head>
<body>
<nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Portal Mesero | Chapinero</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
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
                        <a class="nav-link text-light" aria-current="page" href="#">Tus mesas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" aria-current="page" href="mesero/stock.php">Ver inventario</a>
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
                                <a href="../../../src/logout.php" class="link-danger dropdown-item">Cerrar Sesion</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<div class="container mt-5">
    <h1>Tomar Pedido</h1>
    <input type="hidden" id="idMesa" value="<?php echo $idMesa; ?>"> <!-- ID de la mesa -->

    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['nombreProducto']; ?></td>
                    <td><?php echo number_format($row['precio'], 2); ?></td>
                    <td>
                        <input type="number" id="cantidad_<?php echo $row['nombreProducto']; ?>" min="1" value="1">
                    </td>
                    <td>
                        <button class="btn btn-primary" onclick="agregarProducto('<?php echo $row['nombreProducto']; ?>', <?php echo $row['precio']; ?>, <?php echo $row['cantidad']; ?>)">Agregar</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h3>Total del Pedido: $<span id="total-pedido">0.00</span></h3>
    <button class="btn btn-success" onclick="confirmarPedido()">Confirmar Pedido</button>

    <h2 class="mt-5">Productos en el Pedido:</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody id="tabla-pedido">
            <!-- Aquí se agregarán los productos seleccionados -->
        </tbody>
    </table>
</div>
</body>
</html>
