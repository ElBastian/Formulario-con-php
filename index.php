<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);

$nombre = '';
$materia = '';
$calificacionTexto = '';
$error = '';
$registrado = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST["nombre"] ?? '');
    $materia = trim($_POST["materia"] ?? '');
    $calificacionTexto = trim($_POST["calificacion"] ?? '');
    $calificacion = filter_var($calificacionTexto, FILTER_VALIDATE_FLOAT);

    if (
        $nombre === '' ||
        $materia === '' ||
        $calificacion === false ||
        $calificacion < 0 ||
        $calificacion > 10
    ) {
        $error = "Ingresa todos los datos y una calificación válida entre 0 y 10.";
    } else {
        $registrado = true;
    }
}

function e($texto) {
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Calificaciones</title>
</head>
<body>
    <h1>Registro de calificaciones</h1>

    <form method="POST" action="index.php">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?= e($nombre) ?>" required>
        <br><br>

        <label for="materia">Materia:</label>
        <input type="text" id="materia" name="materia" value="<?= e($materia) ?>" required>
        <br><br>

        <label for="calificacion">Calificación (0 a 10):</label>
        <input type="number" id="calificacion" name="calificacion" min="0" max="10" step="0.1" value="<?= e($calificacionTexto) ?>" required>
        <br><br>

        <button type="submit">Enviar</button>
    </form>

    <?php if ($error !== ''): ?>
        <p style="color: red;"><?= e($error) ?></p>
    <?php elseif ($registrado): ?>
        <h2>Datos registrados:</h2>
        <p>Nombre: <?= e($nombre) ?></p>
        <p>Materia: <?= e($materia) ?></p>
        <p>Calificación: <?= number_format($calificacion, 1) ?></p>
    <?php endif; ?>
</body>
</html>
