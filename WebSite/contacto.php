<?php
include("Includes/db_connect.php");
$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre_contacto'];
    $email = $_POST['email_contacto'];
    $mensaje = $_POST['mensaje_contacto'];
    $stmt = $db->prepare("INSERT INTO contactos (nombre, email, mensaje) VALUES (:nombre, :email, :mensaje)");
    $stmt->bindValue(':nombre', $nombre, SQLITE3_TEXT);
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':mensaje', $mensaje, SQLITE3_TEXT);
    if ($stmt->execute()) {
        $msg = "Mensaje enviado correctamente.";
    } else {
        $msg = "Error al enviar mensaje.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contacto | FlightAir</title>
    <link rel="stylesheet" href="Style/style.css">
</head>
<body>
    <?php include("Includes/header.html"); ?>
    <main>
        <h2 id="titulo-contacto">Contacto</h2>
        <?php if($msg) echo "<p>$msg</p>"; ?>
        <form id="form-contacto" action="contacto.php" method="POST">
            <label for="nombre-contacto">Nombre:</label>
            <input type="text" id="nombre-contacto" name="nombre_contacto" required>
            <label for="email-contacto">Correo electrónico:</label>
            <input type="email" id="email-contacto" name="email_contacto" required>
            <label for="mensaje-contacto">Mensaje:</label>
            <textarea id="mensaje-contacto" name="mensaje_contacto" required></textarea>
            <button type="submit" id="btn-enviar-contacto">Enviar</button>
        </form>
    </main>
    <?php include("Includes/footer.html"); ?>
</body>
</html>