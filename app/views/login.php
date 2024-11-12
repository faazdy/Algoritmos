<?php
require '../../config/config.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Verificar la contraseña
    if (password_verify($password, $user['pass'])) {
        // La contraseña es correcta
        session_start();
        $_SESSION['user_id'] = $user['idUsuario'];
        $_SESSION['rol'] = $user['rol']; // Almacenar el rol en la sesión
        $_SESSION['email'] = $user['email']; // Almacenar el correo en la sesión 

        // Redirigir según el rol
        switch ($user['rol']) {
            case 'admin':
                header("Location: indexAdmin.php"); // Cambia a la vista del administrador
                break;
            case 'mesero':
                header("Location: indexMesero.php"); // Cambia a la vista del mesero
                break;
            case 'cajero':
                header("Location: indexCajero.php"); // Cambia a la vista del cajero
                break;
            default:
                // Si el rol no coincide, redirigir a una página de error o login
                header("Location: login.html");
                break;
        }
        exit;
    } else {
        header('Location: passIncorrecta.html');
    }
} else {
    header('Location: userNotFound.html');
}

