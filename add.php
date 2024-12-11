<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['vinilos'][] = [
        'nombre' => $_POST['nombre'],
        'artista' => $_POST['artista'],
        'genero' => $_POST['genero'],
        'precio' => $_POST['precio'],
        'fecha' => $_POST['fecha'],
        'imagen' => $_POST['imagen']
    ];
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Vinilo</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="navbar">
        <a href="index.php"><button>Volver</button></a>
    </div>

    <div class="content">
        <h2>Añadir Nuevo Vinilo</h2>
        <form method="POST" action="add.php">
            <label for="nombre">Nombre del Vinilo:</label>
            <input type="text" name="nombre" required><br>
            
            <label for="artista">Nombre del Artista:</label>
            <input type="text" name="artista" required><br>

            <label for="genero">Género:</label>
            <select name="genero" required>
                <?php
                $generos = [
                    "Flamenco", "Salsa", "Rumba", "Bossa nova", "Pop español", 
                    "Rock español", "Indie español", "Reggaetón", "Trap", 
                    "Hip hop", "Vallenato", "Música electrónica", "Tango", 
                    "Cumbia", "Música de cantautor", "Nueva Canción", "Pasodoble"
                ];

                foreach ($generos as $genero) {
                    echo "<option value='$genero'>$genero</option>";
                }
                ?>
            </select><br>

            <label for="precio">Precio:</label>
            <input type="number" name="precio" step="0.01" required><br>

            <label for="fecha">Fecha de Lanzamiento:</label>
            <input type="date" name="fecha" required><br>

            <label for="imagen">URL de la Imagen:</label>
            <input type="text" name="imagen" required><br><br>

            <input type="submit" value="Añadir Vinilo">
        </form>
    </div>

</body>
</html>

