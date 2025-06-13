<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

include("Includes/db_connect.php");

// Verifica si el usuario es administrador
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'administrador') {
    header("Location: loginLogout.proc.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
</head>
<body>
    <h1>Bienvenido, Administrador <?php echo htmlspecialchars($_SESSION['user_username'] ?? 'Usuario'); ?></h1>
    <p>Aquí puedes gestionar los usuarios, modelos de aviones, etc.</p>

    <ul>
        <li><a href="manage_users.php">Gestionar Usuarios</a></li>
        <li><a href="manage_models.php">Gestionar Modelos de Aviones</a></li>
    </ul>

    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>