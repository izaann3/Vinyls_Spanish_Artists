<?php
session_start();

if (isset($_GET['id']) && isset($_SESSION['vinilos'][$_GET['id']])) {
    $vinilo = $_SESSION['vinilos'][$_GET['id']];
    $id = $_GET['id'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['vinilos'][$id] = [
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
    <title>Editar Vinilo</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="navbar">
        <a href="index.php"><button>Volver</button></a>
    </div>

    <div class="content">
        <h2>Editar Vinilo</h2>
        <form method="POST" action="edit.php?id=<?php echo $id; ?>">
            <label for="nombre">Nombre del Vinilo:</label>
            <input type="text" name="nombre" value="<?php echo $vinilo['nombre']; ?>" required><br>
            
            <label for="artista">Nombre del Artista:</label>
            <input type="text" name="artista" value="<?php echo $vinilo['artista']; ?>" required><br>
            
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
                    $selected = ($vinilo['genero'] == $genero) ? 'selected' : '';
                    echo "<option value='$genero' $selected>$genero</option>";
                }
                ?>
            </select><br>

            <label for="precio">Precio:</label>
            <input type="number" name="precio" step="0.01" value="<?php echo $vinilo['precio']; ?>" required><br>
            
            <label for="fecha">Fecha de Lanzamiento:</label>
            <input type="date" name="fecha" value="<?php echo $vinilo['fecha']; ?>" required><br>
            
            <label for="imagen">URL de la Imagen:</label>
            <input type="text" name="imagen" value="<?php echo $vinilo['imagen']; ?>" required><br><br>

            <input type="submit" value="Guardar Cambios">
        </form>
    </div>

</body>
</html>

