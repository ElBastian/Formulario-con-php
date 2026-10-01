<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST["nombre"] ?? '');
    $materia = trim($_POST["materia"] ?? '');
    $calificacion = filter_var($_POST["calificacion"] ?? '', FILTER_VALIDATE_FLOAT);

    if (
        $nombre === '' ||
        $materia === '' ||
        $calificacion === false ||
        $calificacion < 0 ||
        $calificacion > 10
    ) {
        echo "<p style='color: red;'>Ingresa todos los datos y una calificación válida entre 0 y 10.</p>";
    } else {
        echo "<h2>Datos registrados:</h2>";
        echo "<p>Nombre: " . htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8') . "</p>";
        echo "<p>Materia: " . htmlspecialchars($materia, ENT_QUOTES, 'UTF-8') . "</p>";
        echo "<p>Calificación: " . number_format($calificacion, 1) . "</p>";
    }
} else {
    echo "<p>No se recibieron datos. Usa el formulario para registrar una calificación.</p>";
}
?>
    <p><a href="index2.html">Volver al formulario</a></p>
</body>
</html>
