<?php
require_once '../config/config.php';

class Producto {
    public static function getAll() {
        $conn = conectarDB();
        $sql = "SELECT * FROM productos";
        $result = $conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function agregar($nombre, $cantidad) {
        $conn = conectarDB();
        $sql = "INSERT INTO productos (nombreProducto, precioVenta, costoVenta, cantidad) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $nombre, $cantidad);
        $stmt->execute();
    }
}
?>