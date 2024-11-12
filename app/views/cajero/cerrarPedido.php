<?php

require '../../../config/config.php'; 
session_start();
if ($_SESSION['rol'] !== 'cajero') {
    header("Location: login.html");
    exit;
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html"); // Redirigir si no está autenticado
    exit;
}



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idPedido'])) {
    $idPedido = $_POST['idPedido'];

    try {
        // Cambiar el estado del pedido a cerrado
        $stmt = $conn->prepare("UPDATE Pedidos SET estado = 'cerrado' WHERE idPedido = ?");
        // Verifica si la preparación de la consulta fue exitosa
        if (!$stmt) {
            throw new Exception("Error en la preparación de la consulta: " . $conn->error);
        }
        // Ejecuta la consulta
        $stmt->bind_param("i", $idPedido); // Usa bind_param para evitar inyecciones SQL
        $stmt->execute();

        // Obtener la ID de la mesa asociada al pedido
        $stmt = $conn->prepare("SELECT idMesa FROM Pedidos WHERE idPedido = ?");
        if (!$stmt) {
            throw new Exception("Error en la preparación de la consulta: " . $conn->error);
        }
        $stmt->bind_param("i", $idPedido);
        $stmt->execute();
        
        // Obtén el resultado
        $result = $stmt->get_result();
        $mesaId = $result->fetch_assoc()['idMesa']; // Obtén el ID de la mesa asociada

        // Marcar la mesa como disponible
        $stmt = $conn->prepare("UPDATE Mesas SET disponible = 'disponible' WHERE idMesa = ?");
        if (!$stmt) {
            throw new Exception("Error en la preparación de la consulta: " . $conn->error);
        }
        $stmt->bind_param("i", $mesaId);
        $stmt->execute();

        header("Location: mesas.php?success=1"); // Redirige después de cerrar el pedido
    } catch (Exception $e) {
        echo "Error al cerrar el pedido: " . $e->getMessage();
    }
}
?>
