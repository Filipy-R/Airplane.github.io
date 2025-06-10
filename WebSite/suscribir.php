<?php
include("Includes/db_connect.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email_suscripcion'];
    $stmt = $db->prepare("INSERT INTO suscripciones (email) VALUES (:email)");
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->execute();
    header("Location: index.php?sub=ok");
    exit;
}
?>