<?php
require_once '../config/config.php';

class Producto {
    public static function getAll() {
        $conn = conectarDB();
        $sql = "SELECT * FROM productos";
        $result = $conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

<<<<<<< HEAD
    public static function agregar($nombre, $cantidad) {
        $conn = conectarDB();
        $sql = "INSERT INTO productos (nombreProducto, precioVenta, costoVenta, cantidad) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $nombre, $cantidad);
        $stmt->execute();
    }
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'nombreProducto',
        'cantidad',
        'costoVenta',
        'precioVenta',
    ];
    public $timestamps = true;
>>>>>>> 60206ea7ebf737e2412952d2f9eb86caec73179a
}
?>