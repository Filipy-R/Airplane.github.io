<?php

// Crear o abrir la base de datos SQLite
$db = new SQLite3('usuarios.db');

$db->exec("DROP TABLE IF EXISTS usuarios");

$db->exec("CREATE TABLE IF NOT EXISTS usuarios (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    rol VARCHAR(50) NOT NULL DEFAULT 'usuario' -- 'usuario' o 'administrador'
);");

?>