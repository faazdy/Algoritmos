<?php
// Incluir la conexión a la base de datos
require '../../config/config.php';

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$telefono = $_POST['telefono'];
$rol = $_POST['rol']; // Este será mesero, cajero o admin
$email = $_POST['email'];
$password = $_POST['password'];

// Hashear la contraseña
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Empezamos la transacción
$conn->begin_transaction();

try {
    // Dependiendo del rol, insertamos en la tabla correspondiente
    if ($rol === 'mesero') {
        // Insertar en la tabla meseros
        $sql = "INSERT INTO meseros (nombre, apellido, telefono) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nombre, $apellido, $telefono);
        $stmt->execute();
        $idRol = $conn->insert_id; // Obtener el ID del mesero registrado

        // Insertar en la tabla usuarios
        $sql = "INSERT INTO usuarios (email, pass, rol ,idMesero) VALUES (?, ?, 'mesero', ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $email, $hashed_password, $idRol);
        $stmt->execute();

    } elseif ($rol === 'cajero') {
        // Insertar en la tabla cajeros
        $sql = "INSERT INTO cajeros (nombre, apellido, telefono) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nombre, $apellido, $telefono);
        $stmt->execute();
        $idRol = $conn->insert_id; // Obtener el ID del cajero registrado

        // Insertar en la tabla usuarios
        $sql = "INSERT INTO usuarios (email, pass, rol ,idCajero) VALUES (?, ?, 'cajero', ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $email, $hashed_password, $idRol);
        $stmt->execute();

    } elseif ($rol === 'admin') {
        // Insertar en la tabla admins
        $sql = "INSERT INTO admins (nombre, apellido, telefono) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nombre, $apellido, $telefono);
        $stmt->execute();
        $idRol = $conn->insert_id; // Obtener el ID del admin registrado

        // Insertar en la tabla usuarios
        $sql = "INSERT INTO usuarios (email, pass, rol ,idAdmin) VALUES (?, ?, 'admin', ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $email, $hashed_password, $idRol);
        $stmt->execute();
    }

    // Si todo ha ido bien, hacemos commit
    $conn->commit();
    echo "Registro exitoso";
    header('Location: login.html');

} catch (Exception $e) {
    // Si hay algún error, hacemos rollback
    $conn->rollback();
    echo "Error al registrar: " . $e->getMessage();
}

