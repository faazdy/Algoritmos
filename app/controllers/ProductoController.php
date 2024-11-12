<?php
require_once '../app/Models/Producto.php';

class ProductoController {
    public function index() {
        // Lógica para mostrar los productos
        $productos = Producto::getAll();
        require_once '../app/Views/productos/index.php';
    }

    public function agregar() {
        // Lógica para agregar un producto (manejar formulario, etc.)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $cantidad = $_POST['cantidad'];
            Producto::agregar($nombre, $cantidad);
        }
        require_once '../app/Views/productos/agregar.php';
    }
}
