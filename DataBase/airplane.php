<?php
// Conectar a la base de datos (o crearla si no existe)
$db = new SQLite3('aviones.db');

// Eliminar tablas para reiniciar la base de datos (solo para desarrollo/testing)
$db->exec("DROP TABLE IF EXISTS fabricantes");
$db->exec("DROP TABLE IF EXISTS modelos_aviones");
$db->exec("DROP TABLE IF EXISTS usuarios");
$db->exec("DROP TABLE IF EXISTS suscripciones");
$db->exec("DROP TABLE IF EXISTS contactos");

// Crear la tabla fabricantes si no existe
$db->exec("CREATE TABLE IF NOT EXISTS fabricantes (
    fab_id INTEGER PRIMARY KEY AUTOINCREMENT,
    fab_nom TEXT NOT NULL,
    fab_imagen TEXT NOT NULL
);");

// Insertar datos en la tabla fabricantes (Boeing y Airbus)
$db->exec("INSERT INTO fabricantes (fab_nom, fab_imagen) VALUES 
('Boeing','https://images.unsplash.com/photo-1677795664119-f3b70cacb18c?q=80&w=1933&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
('Airbus', 'https://images.unsplash.com/photo-1677795664119-f3b70cacb18c?q=80&w=1933&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')
;");


// Crear la tabla modelos_aviones si no existe (ahora con fecha_lanzamiento y velocidad_maxima)
$db->exec("CREATE TABLE IF NOT EXISTS modelos_aviones (
    mod_id INTEGER PRIMARY KEY AUTOINCREMENT,
    mod_nom TEXT NOT NULL,
    mod_descripcio TEXT NOT NULL,
    mod_imagen TEXT,
    fecha_lanzamiento TEXT,
    velocidad_maxima INTEGER,
    fab_id INTEGER NOT NULL,
    FOREIGN KEY(fab_id) REFERENCES fabricantes(fab_id)
);");

// Insertar datos en la tabla modelos_aviones (con fecha de lanzamiento y velocidad máxima)
$db->exec("INSERT INTO modelos_aviones (mod_nom, mod_descripcio, mod_imagen, fecha_lanzamiento, velocidad_maxima, fab_id) 
VALUES 
('737', 'El Boeing 737 es un avión de pasillo único utilizado principalmente para vuelos comerciales de corta y media distancia. Es uno de los aviones más populares del mundo.', 'https://images.unsplash.com/photo-1677795664119-f3b70cacb18c?q=80&w=1933&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '1968', 876, 1),
('747', 'El Boeing 747 es un avión de pasajeros de largo alcance conocido como \"Jumbo\". Es famoso por su capacidad de transportar a cientos de personas y por su icónica doble cubierta.', 'https://images.unsplash.com/photo-1677795664119-f3b70cacb18c?q=80&w=1933&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '1969', 988, 1),
('757', 'El Boeing 757 es un avión de mediano alcance utilizado para vuelos comerciales. Tiene una capacidad para aproximadamente 200-300 pasajeros.', 'https://images.unsplash.com/photo-1677795664119-f3b70cacb18c?q=80&w=1933&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '1982', 982, 1),
('767', 'El Boeing 767 es un avión de fuselaje ancho utilizado tanto para vuelos de pasajeros como para carga. Es ideal para vuelos de largo alcance.', 'https://images.unsplash.com/photo-1677795664119-f3b70cacb18c?q=80&w=1933&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '1981', 913, 1),
('777', 'El Boeing 777 es un avión de largo alcance de fuselaje ancho. Se destaca por su eficiencia y capacidad de transportar grandes cantidades de pasajeros y carga.', 'https://images.unsplash.com/photo-1677795664119-f3b70cacb18c?q=80&w=1933&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '1994', 950, 1),
('787', 'El Boeing 787 Dreamliner es un avión de largo alcance de última generación que ofrece una eficiencia de combustible superior y un diseño avanzado.', 'https://images.unsplash.com/photo-1677795664119-f3b70cacb18c?q=80&w=1933&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '2009', 954, 1),
('A220', 'El Airbus A220 es un avión de pasillo único diseñado para vuelos de corta distancia. Es conocido por su eficiencia y comodidad.', 'https://www.gettyimages.es/detail/fotograf%C3%ADa-de-noticias/delta-air-lines-airbus-a220-300-passenger-fotograf%C3%ADa-de-noticias/2185160976', '2013', 871, 2),
('A300', 'El Airbus A300 fue el primer avión de pasillo doble de Airbus, diseñado para vuelos de largo alcance.', 'https://media.gettyimages.com/id/1213062791/es/foto/der-airbus-a300-ist-die-gro%C3%9Fe-attraktion-auf-der-10-deutschen-luftfahrtschau-in-hannover-die.jpg?s=612x612&w=gi&k=20&c=_Zm47fqGyE3fhJPN1kQ11CbRra7saTiBkuL9mvixTbc=', '1972', 917, 2),
('A310', 'El Airbus A310 es un avión de fuselaje ancho, diseñado para vuelos de largo alcance, y es considerado un antecesor del A330.', 'https://www.gettyimages.es/detail/fotograf%C3%ADa-de-noticias/ein-airbus-vom-typ-a310-der-fluggesellschaft-fotograf%C3%ADa-de-noticias/540689519', '1982', 913, 2),
('A320', 'El Airbus A320 es un avión de pasillo único, famoso por su eficiencia y flexibilidad en vuelos de corta y media distancia.', 'https://media.gettyimages.com/id/1240368159/es/foto/iberia-express-airbus-a320-aircraft-as-seen-departing-from-amsterdam-schiphol-ams-eham-airport.jpg?s=612x612&w=0&k=20&c=aKpJxTA-U3WL9wTFeG4wgi-XoZCoPitr0MtKSvt4pCY=', '1987', 871, 2),
('A318', 'El Airbus A318 es el modelo más pequeño de la familia A320, ideal para vuelos regionales y de corto alcance.', 'https://images.unsplash.com/photo-1677795664119-f3b70cacb18c?q=80&w=1933&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '2002', 871, 2),
('A319', 'El Airbus A319 es un avión de pasillo único que ofrece una capacidad intermedia, adecuado para vuelos de corta y media distancia.', 'https://images.unsplash.com/photo-1677795664119-f3b70cacb18c?q=80&w=1933&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '1995', 871, 2),
('A320', 'El Airbus A320 es un avión de pasillo único, utilizado principalmente para vuelos comerciales de corta y media distancia.', 'https://images.unsplash.com/photo-1677795664119-f3b70cacb18c?q=80&w=1933&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '1987', 871, 2),
('A321', 'El Airbus A321 es una versión más grande del A320, diseñado para vuelos de mayor distancia y con mayor capacidad.', 'https://images.unsplash.com/photo-1677795664119-f3b70cacb18c?q=80&w=1933&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '1993', 871, 2),
('A330', 'El Airbus A330 es un avión de fuselaje ancho utilizado para vuelos de largo alcance. Es popular por su eficiencia y capacidad de transporte.', 'https://images.unsplash.com/photo-1677795664119-f3b70cacb18c?q=80&w=1933&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '1992', 913, 2),
('A340', 'El Airbus A340 es un avión de fuselaje ancho y cuatro motores, diseñado para vuelos de largo alcance.', 'https://images.unsplash.com/photo-1677795664119-f3b70cacb18c?q=80&w=1933&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '1991', 913, 2),
('A350', 'El Airbus A350 es un avión de fuselaje ancho de última generación, diseñado para vuelos de largo alcance, con una gran eficiencia de combustible.', 'https://images.unsplash.com/photo-1677795664119-f3b70cacb18c?q=80&w=1933&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '2013', 945, 2),
('A380', 'El Airbus A380 es el avión comercial más grande del mundo, con capacidad para más de 800 pasajeros. Es conocido por su doble cubierta y su capacidad para vuelos de largo alcance.', 'https://images.unsplash.com/photo-1677795664119-f3b70cacb18c?q=80&w=1933&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '2005', 1020, 2)
;");

// Crear la tabla usuarios
$db->exec("CREATE TABLE IF NOT EXISTS usuarios (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL
);");

// Crear la tabla suscripciones
$db->exec("CREATE TABLE IF NOT EXISTS suscripciones (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    email TEXT NOT NULL UNIQUE
);");

// Crear la tabla contactos
$db->exec("CREATE TABLE IF NOT EXISTS contactos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    email TEXT NOT NULL,
    mensaje TEXT NOT NULL
);");

// Cerrar la conexión
$db->close();
?>