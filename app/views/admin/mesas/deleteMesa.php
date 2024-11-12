<?php
require '../../../../config/config.php';

$id = $_GET['id'];

$sql = "DELETE FROM mesas WHERE idMesa = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Mesa eliminada con éxito.";
    header('Location: verMesas.php');
} else {
    echo "Error al eliminar la mesa: " . $conn->error;
}
?>