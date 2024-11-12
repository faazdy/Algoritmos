<?php

require '../../../config/config.php'; 
session_start(); // Inicia la sesión

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'mesero') {
    header("Location: login.html");
    exit;
}

// Verificar que 'user_id' esté definido
if (!isset($_SESSION['user_id'])) {
    echo "Error: No se ha definido 'user_id' en la sesión.";
    exit;
}

// Obtener el idMesero del usuario autenticado
$idUsuario = $_SESSION['user_id'];
$sqlMesero = "SELECT idMesero FROM usuarios WHERE idUsuario = ?";
$stmtMesero = $conn->prepare($sqlMesero);
$stmtMesero->bind_param("i", $idUsuario);
$stmtMesero->execute();
$resultMesero = $stmtMesero->get_result();

if ($resultMesero->num_rows === 0) {
    echo "Error: No se encontró el mesero asociado al usuario.";
    exit;
}

$rowMesero = $resultMesero->fetch_assoc();
$idMesero = $rowMesero['idMesero'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar que 'productos' y 'idMesa' estén definidos
    if (!isset($_POST['productos']) || !isset($_POST['idMesa'])) {
        echo "Error: Datos del pedido incompletos.";
        exit;
    }

    $productos = $_POST['productos'];
    $idMesa = $_POST['idMesa'];

    // Iniciar la transacción
    $conn->begin_transaction();

    try {
        // Insertar el pedido
        $sql = "INSERT INTO pedidos (estado, idMesa, idMesero) VALUES ('abierto', ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $idMesa, $idMesero);
        if (!$stmt->execute()) {
            throw new Exception("Error al insertar el pedido: " . $stmt->error);
        }
        $idPedido = $stmt->insert_id; // Obtener el ID del nuevo pedido

        // Insertar los productos en la tabla de PedidoProducto
        foreach ($productos as $producto) {
            $nombre = $producto['nombre'];
            $cantidad = $producto['cantidad'];

            // Obtener el ID del producto
            $sqlProducto = "SELECT idProducto, precio, cantidad FROM productos WHERE nombreProducto = ?";
            $stmtProducto = $conn->prepare($sqlProducto);
            $stmtProducto->bind_param("s", $nombre);
            $stmtProducto->execute();
            $resultado = $stmtProducto->get_result();

            if ($resultado->num_rows === 0) {
                throw new Exception("Producto no encontrado: $nombre");
            }

            $row = $resultado->fetch_assoc();
            $idProducto = $row['idProducto'];
            $stockActual = $row['cantidad'];

            // Validar cantidad disponible
            if ($cantidad > $stockActual) {
                throw new Exception("No hay suficiente stock para: $nombre");
            }

            // Insertar en la tabla PedidoProducto
            $sqlPedidoProducto = "INSERT INTO PedidoProducto (idPedido, idProducto, cantidad) VALUES (?, ?, ?)";
            $stmtPedidoProducto = $conn->prepare($sqlPedidoProducto);
            $stmtPedidoProducto->bind_param("iii", $idPedido, $idProducto, $cantidad);
            if (!$stmtPedidoProducto->execute()) {
                throw new Exception("Error al insertar el producto en el pedido: " . $stmtPedidoProducto->error);
            }

            // Actualizar el stock en la tabla de productos
            $nuevoStock = $stockActual - $cantidad; // Ajusta según tu lógica
            if ($nuevoStock < 0) {
                throw new Exception("Stock negativo no permitido para: $nombre");
            }

            $sqlActualizarStock = "UPDATE productos SET cantidad = ? WHERE idProducto = ?";
            $stmtActualizarStock = $conn->prepare($sqlActualizarStock);
            $stmtActualizarStock->bind_param("ii", $nuevoStock, $idProducto);
            if (!$stmtActualizarStock->execute()) {
                throw new Exception("Error al actualizar el stock: " . $stmtActualizarStock->error);
            }
        }

        // Confirmar la transacción
        $conn->commit();
        echo "Pedido realizado con éxito.";
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        $conn->rollback();
        echo "Error al realizar el pedido: " . $e->getMessage();
    }
}
?>
