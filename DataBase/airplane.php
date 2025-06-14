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

// Insertar datos en la tabla fabricantes (Boeing y Airbus)
$db->exec("INSERT INTO fabricantes (fab_nom, fab_imagen) VALUES 
('Boeing','https://media.istockphoto.com/id/517851883/es/foto/boing-747-en-vuelo.jpg?s=612x612&w=0&k=20&c=k5HxEvfI3_9QIqKfrLNY9BFHzQsLz8JMmvL0JcEWhY8='),
('Airbus', 'https://t3.ftcdn.net/jpg/05/55/34/62/360_F_555346287_MhBuFKC7YJqVhSPowlY03DcNpqmDKldF.jpg'),
('Embraer', 'https://storage.googleapis.com/site.esss.co/bcd8b658-2019-04-08-thumb-embraer.jpg'),
('Bombardier', 'https://imagenes.20minutos.es/files/image_1920_1080/uploads/imagenes/2025/04/11/bombardier-global-8000.jpeg'),
('Otros modelos', 'https://aeroin.net/wp-content/uploads/2021/07/Il62.jpg')
;");




// Insertar datos en la tabla modelos_aviones (con fecha de lanzamiento y velocidad máxima)
$db->exec("INSERT INTO modelos_aviones (mod_nom, mod_descripcio, mod_imagen, fecha_lanzamiento, velocidad_maxima, fab_id) 
VALUES 
('737', 'El Boeing 737 es un avión de pasillo único utilizado principalmente para vuelos comerciales de corta y media distancia. Es uno de los aviones más populares del mundo.', 'https://img.static-kl.com/transform/2651d1aa-6331-459b-8719-28d6d8170167/', '1968', 876, 1),
('747', 'El Boeing 747 es un avión de pasajeros de largo alcance conocido como \"Jumbo\". Es famoso por su capacidad de transportar a cientos de personas y por su icónica doble cubierta.', 'https://upload.wikimedia.org/wikipedia/commons/4/40/Pan_Am_Boeing_747-121_N732PA_Bidini.jpg', '1969', 988, 1),
('757', 'El Boeing 757 es un avión de mediano alcance utilizado para vuelos comerciales. Tiene una capacidad para aproximadamente 200-300 pasajeros.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/34/Delta_Air_Lines_Boeing_757-300%3B_N582NW%40LAX%3B11.10.2011_623ft_%286646227129%29.jpg/330px-Delta_Air_Lines_B757-300%3B_N582NW%40LAX%3B11.10.2011_623ft_%286646227129%29.jpg', '1982', 982, 1),
('767', 'El Boeing 767 es un avión de fuselaje ancho utilizado tanto para vuelos de pasajeros como para carga. Es ideal para vuelos de largo alcance.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/43/Delta_Air_Lines_B767-332_N130DL.jpg/1200px-Delta_Air_Lines_B767-332_N130DL.jpg', '1981', 913, 1),
('777', 'El Boeing 777 es un avión de largo alcance de fuselaje ancho. Se destaca por su eficiencia y capacidad de transportar grandes cantidades de pasajeros y carga.', 'https://aircharterservice-globalcontent-live.cphostaccess.com/images/aircraft-guide-images/group/boeing-b777-22c3002c8x-large_tcm36-3695.jpg', '1994', 950, 1),
('787', 'El Boeing 787 Dreamliner es un avión de largo alcance de última generación que ofrece una eficiencia de combustible superior y un diseño avanzado.', 'https://phantom-expansion.uecdn.es/ccb93ccebbce08f5986229a8379a9cc3/crop/167x80/1965x1278/resize/1200/f/webp/assets/multimedia/imagenes/2023/10/25/16982385979337.jpg', '2009', 954, 1),
('707', 'El Boeing 707 fue un avión revolucionario que marcó el comienzo de la era de los aviones a reacción para pasajeros.', 'https://cdn.britannica.com/74/183374-050-E56D88D9/Boeing-707.jpg', '1957', 960, 1),
('727', 'El Boeing 727 fue un popular avión trimotor de corto a medio alcance, muy utilizado en vuelos domésticos.', 'https://upload.wikimedia.org/wikipedia/commons/5/57/B-727_Iberia_%28cropped%29.jpg', '1963', 960, 1),

-- Nuevos modelos de Boeing con URLs buscadas
('717', 'El Boeing 717 es un avión de pasillo único, ideal para rutas regionales y de corta distancia, derivado del McDonnell Douglas MD-95.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/52/Delta_Air_Lines_Boeing_717-200.jpg/1280px-Delta_Air_Lines_Boeing_717-200.jpg', '1999', 811, 1),
('C-17 Globemaster III', 'El Boeing C-17 Globemaster III es un gran avión de transporte militar que puede llevar cargas pesadas por todo el mundo y aterrizar en pistas pequeñas.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/ef/C-17_Globemaster_III.jpg/1280px-C-17_Globemaster_III.jpg', '1991', 830, 1),
('P-8 Poseidon', 'El Boeing P-8 Poseidon es un avión de patrulla marítima y guerra antisubmarina basado en el Boeing 737.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d5/P-8A_Poseidon_of_the_US_Navy_in_flight_over_the_Pacific_Ocean_on_15_February_2016.jpg/1280px-P-8A_Poseidon_of_the_US_Navy_in_flight_over_the_Pacific_Ocean_on_15_February_2016.jpg', '2009', 907, 1),
('747-8F', 'El Boeing 747-8F es la versión de carga de la última generación del Jumbo, con mayor capacidad y eficiencia de combustible.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/Cargolux_Boeing_747-8F_LX-VCM.jpg/1280px-Cargolux_Boeing_747-8F_LX-VCM.jpg', '2011', 988, 1),
('KC-46 Pegasus', 'El Boeing KC-46 Pegasus es un avión militar de reabastecimiento en vuelo y transporte, basado en el Boeing 767.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/KC-46A_Pegasus.jpg/1280px-KC-46A_Pegasus.jpg', '2015', 915, 1),


('A220', 'El Airbus A220 es un avión de pasillo único diseñado para vuelos de corta distancia. Es conocido por su eficiencia y comodidad.', '/images/modelos/airbus_a220.jpg', '2013', 871, 2),
('A300', 'El Airbus A300 fue el primer avión de pasillo doble de Airbus, diseñado para vuelos de largo alcance.', '/images/modelos/airbus_a300.jpg', '1972', 917, 2),
('A310', 'El Airbus A310 es un avión de fuselaje ancho, diseñado para vuelos de largo alcance, y es considerado un antecesor del A330.', '/images/modelos/airbus_a310.jpg', '1982', 913, 2),
('A318', 'El Airbus A318 es el modelo más pequeño de la familia A320, ideal para vuelos regionales y de corto alcance.', '/images/modelos/airbus_a318.jpg', '2002', 871, 2),
('A319', 'El Airbus A319 es un avión de pasillo único que ofrece una capacidad intermedia, adecuado para vuelos de corta y media distancia.', '/images/modelos/airbus_a319.jpg', '1995', 871, 2),
('A320', 'El Airbus A320 es un avión de pasillo único, famoso por su eficiencia y flexibilidad en vuelos de corta y media distancia.', '/images/modelos/airbus_a320.jpg', '1987', 871, 2),
('A321', 'El Airbus A321 es una versión más grande del A320, diseñado para vuelos de mayor distancia y con mayor capacidad.', '/images/modelos/airbus_a321.jpg', '1993', 871, 2),
('A330', 'El Airbus A330 es un avión de fuselaje ancho utilizado para vuelos de largo alcance. Es popular por su eficiencia y capacidad de transporte.', '/images/modelos/airbus_a330.jpg', '1992', 913, 2),
('A340', 'El Airbus A340 es un avión de fuselaje ancho y cuatro motores, diseñado para vuelos de largo alcance.', '/images/modelos/airbus_a340.jpg', '1991', 913, 2),
('A350', 'El Airbus A350 es un avión de fuselaje ancho de última generación, diseñado para vuelos de largo alcance, con una gran eficiencia de combustible.', '/images/modelos/airbus_a350.jpg', '2013', 945, 2),
('A380', 'El Airbus A380 es el avión comercial más grande del mundo, con capacidad para más de 800 pasajeros. Es conocido por su doble cubierta y su capacidad para vuelos de largo alcance.', '/images/modelos/airbus_a380.jpg', '2005', 1020, 2),

-- Nuevos modelos de Airbus con URLs buscadas
('Beluga XL', 'El Airbus Beluga XL es un avión de transporte de carga de gran tamaño, diseñado específicamente para mover secciones de aviones entre las plantas de Airbus. Es fácilmente reconocible por su forma de ballena beluga.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Beluga_XL_at_Chateauroux-D%C3%A9ols_Airport_%282019%29.jpg/1280px-Beluga_XL_at_Chateauroux-D%C3%A9ols_Airport_%282019%29.jpg', '2018', 737, 2),
('A400M Atlas', 'El Airbus A400M Atlas es un avión de transporte militar de cuatro motores turbohélice, capaz de realizar reabastecimiento en vuelo y operar en pistas cortas no preparadas.', 'https://cdn.pixabay.com/photo/2021/12/05/12/07/airbus-6847541_1280.jpg', '2009', 780, 2),
('A330 MRTT', 'El Airbus A330 Multi Role Tanker Transport (MRTT) es una versión militar del A330, utilizada para reabastecimiento en vuelo y transporte de personal/carga.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a2/MRTT_at_Paris_Air_Show_2017.jpg/1280px-MRTT_at_Paris_Air_Show_2017.jpg', '2007', 880, 2),
('A320neo', 'La familia Airbus A320neo (New Engine Option) es una mejora del A320 original, ofreciendo mayor eficiencia de combustible y menor ruido.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4b/Airbus_A320neo_F-WNEO_at_Paris_Air_Show_2017.jpg/1280px-Airbus_A320neo_F-WNEO_at_Paris_Air_Show_2017.jpg', '2014', 876, 2),


('E170', 'El Embraer E170 es un jet regional con capacidad para aproximadamente 70-80 pasajeros, ideal para rutas de corto y medio alcance.', '/images/modelos/embraer_e170.jpg', '2002', 820, 3),
('E175', 'El Embraer E175 es una variante del E-Jet, ligeramente más grande que el E170, muy popular en vuelos regionales en Norteamérica.', '/images/modelos/embraer_e175.jpg', '2003', 820, 3),
('E190', 'El Embraer E190 es un jet de tamaño mediano con capacidad para unos 100-114 pasajeros, utilizado para rutas de media distancia.', '/images/modelos/embraer_e190.jpg', '2004', 870, 3),
('E195', 'El Embraer E195 es el modelo más grande de la primera generación de E-Jets, ofreciendo mayor capacidad y autonomía.', '/images/modelos/embraer_e195.jpg', '2006', 870, 3),
('E190-E2', 'El Embraer E190-E2 es la segunda generación del E190, destacando por su mejor eficiencia de combustible y menor ruido.', '/images/modelos/embraer_e190_e2.jpg', '2016', 870, 3),
('E195-E2', 'El Embraer E195-E2 es el miembro más grande de la familia E-Jet E2, compitiendo en el segmento de aviones de pasillo único con mayor capacidad.', '/images/modelos/embraer_e195_e2.jpg', '2017', 870, 3),

-- Nuevos modelos de Embraer con URLs buscadas
('ERJ-135', 'El Embraer ERJ-135 es un jet regional de menor capacidad (37 pasajeros), ideal para rutas cortas y operaciones en aeropuertos más pequeños.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d7/Embraer_ERJ-135_Continental_Express_N10538.jpg/1280px-Embraer_ERJ-135_Continental_Express_N10538.jpg', '1999', 834, 3),
('Legacy 600', 'El Embraer Legacy 600 es un jet de negocios de largo alcance, basado en la plataforma del jet regional ERJ-135.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b3/Embraer_Legacy_600_-_G-SCSR.jpg/1280px-Embraer_Legacy_600_-_G-SCSR.jpg', '2001', 834, 3),
('Praetor 600', 'El Embraer Praetor 600 es un jet de negocios super-midsize con un alcance impresionante, ideal para vuelos transcontinentales.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8c/Embraer_Praetor_600_%28PR-XLT%29.jpg/1280px-Embraer_Praetor_600_%28PR-XLT%29.jpg', '2019', 863, 3),
('Phenom 300', 'El Embraer Phenom 300 es uno de los jets ligeros más populares y vendidos en el mundo, conocido por su velocidad y eficiencia.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/91/Embraer_Phenom_300E.jpg/1280px-Embraer_Phenom_300E.jpg', '2009', 839, 3)
;");



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
$db->exec("INSERT INTO contactos (nombre, email, mensaje) VALUES ('Juan Pérez', 'juan.perez@example.com', 'Me gustaría obtener más información sobre los vuelos a Madrid.');");
  

$db->exec("INSERT INTO contactos (nombre, email, mensaje) VALUES ('María García', 'maria.garcia@otroejemplo.net', 'Tengo una consulta sobre un paquete vacacional específico.');");


$db->exec("INSERT INTO contactos (nombre, email, mensaje) VALUES ('Pedro López', 'pedro.lopez@dominio.org', 'Necesito soporte técnico con la reserva que acabo de hacer.');");


// Cerrar la conexión
$db->close();
?>