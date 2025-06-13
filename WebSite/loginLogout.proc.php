<?php
session_start();

try {
    include("Includes/db_connect.php");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre']) && isset($_POST['password'])) {
    $nombre = trim($_POST['nombre']);
    $password = $_POST['password'];

    // Prepara la consulta para evitar inyección SQL
    $stmt = $db->prepare("SELECT id, nombre, password, rol FROM usuarios WHERE nombre = :nombre");
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Contraseña correcta, inicia sesión
        $_SESSION['id'] = $user['id'];
        $_SESSION['nombre'] = $user['nombre'];
        $_SESSION['rol'] = $user['rol'];

        // Redirigir al usuario según su rol
        if ($_SESSION['rol'] == 'administrador') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: user_dashboard.php");
        }
        exit();
    } else {
        $error_message = "Credenciales incorrectas.";
    }
}
?>