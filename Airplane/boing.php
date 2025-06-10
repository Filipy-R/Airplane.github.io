<?php
// Conectar a la base de datos SQLite
include("../WebSite/Includes/db_connect.php");
include("../WebSite/Includes/header.html");

// Obtener todos los modelos de aviones Boeing
$query = "SELECT m.mod_nom, m.mod_descripcio, m.mod_imagen, f.fab_nom
          FROM modelos_aviones m
          JOIN fabricantes f ON m.fab_id = f.fab_id
          WHERE m.fab_id = 1";
$result = $db->query($query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modelos Boeing | FlightAir</title>
    <link rel="stylesheet" href="../WebSite/Includes/Style/modelAirplane.css">
</head>
<body>
    <main>
        <h1 class="title-modelos" id="titulo-boeing">Modelos de Aviones Boeing</h1>
        <div class="container" id="container-modelos-Airbus">
            <?php
            // Recorrer los resultados y mostrar cada modelo de avión
            // Ahora también obtenemos fecha_lanzamiento y velocidad_maxima
            $query = "SELECT m.mod_nom, m.mod_descripcio, m.mod_imagen, m.fecha_lanzamiento, m.velocidad_maxima, f.fab_nom
                      FROM modelos_aviones m
                      JOIN fabricantes f ON m.fab_id = f.fab_id
                      WHERE m.fab_id = 1";
            $result = $db->query($query);

            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                echo "<div class='aircraft-card' data-modelo='" . htmlspecialchars($row['mod_nom']) . "'>";
                echo "<h2 class='modelo-nombre'>" . htmlspecialchars($row['mod_nom']) . " <span class='modelo-fabricante'>(" . htmlspecialchars($row['fab_nom']) . ")</span></h2>";
                echo "<p class='modelo-descripcion'>" . htmlspecialchars($row['mod_descripcio']) . "</p>";
                echo "<img src='" . htmlspecialchars($row['mod_imagen']) . "' alt='" . htmlspecialchars($row['mod_nom']) . "' class='aircraft-image'>";
                // Información extra bajo la imagen
                echo "<div class='modelo-info-extra'>";
                echo "<span class='info-label'><strong> Velocidad máxima:</strong> " . (htmlspecialchars($row['velocidad_maxima']) ? htmlspecialchars($row['velocidad_maxima']) . " km/h" : "N/D") . "</span><br>";
                echo "<span class='info-label'><strong> Lanzamiento:</strong> " . (htmlspecialchars($row['fecha_lanzamiento']) ? htmlspecialchars($row['fecha_lanzamiento']) : "N/D") . "</span>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
    </main>
    <?php include("../WebSite/Includes/footer.html"); ?>
</body>
</html>
<?php
$db->close();
?>