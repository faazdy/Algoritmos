<?php
require '../../../../config/config.php';

$idProducto = $_GET['idProducto'];

// Eliminar el producto de la base de datos
$sql = "DELETE FROM productos WHERE idProducto = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idProducto);
$stmt->execute();

header("Location: productos.php"); // Redirigir a la lista de productos
exit;
?>

<?php
$conn->close();
?>
