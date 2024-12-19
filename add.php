<?php
// Inicia la sesión
session_start();

// Verifica si se ha enviado el formulario usando el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Agrega un nuevo vinilo al array 'vinilos' en la sesión
    $_SESSION['vinilos'][] = [
        'nombre' => $_POST['nombre'],  // Nombre del vinilo
        'artista' => $_POST['artista'],  // Artista del vinilo
        'genero' => $_POST['genero'],  // Género musical del vinilo
        'precio' => $_POST['precio'],  // Precio del vinilo
        'fecha' => $_POST['fecha'],  // Fecha de lanzamiento
        'imagen' => $_POST['imagen']  // URL de la imagen del vinilo
    ];
    // Redirige al usuario a la página principal (index.php) después de añadir el vinilo
    header('Location: index.php');
    // Asegura que no se ejecute más código después de la redirección
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

    <!-- Barra de navegación con un botón para volver a la página principal -->
    <div class="navbar">
        <a href="index.php"><button>Volver</button></a>
    </div>

    <!-- Contenido principal de la página -->
    <div class="content">
        <h2>Añadir Nuevo Vinilo</h2>  <!-- Título de la sección -->
        <!-- Formulario para añadir un nuevo vinilo -->
        <form method="POST" action="add.php">
            <!-- Campo para ingresar el nombre del vinilo -->
            <label for="nombre">Nombre del Vinilo:</label>
            <input type="text" name="nombre" required><br>
            
            <!-- Campo para ingresar el nombre del artista -->
            <label for="artista">Nombre del Artista:</label>
            <input type="text" name="artista" required><br>

            <!-- Campo para seleccionar el género del vinilo -->
            <label for="genero">Género:</label>
            <select name="genero" required>
                <?php
                // Array con los géneros
                $generos = [
                    "Flamenco", "Salsa", "Rumba", "Bossa nova", "Pop español", 
                    "Rock español", "Indie español", "Reggaetón", "Trap", 
                    "Hip hop", "Vallenato", "Música electrónica", "Tango", 
                    "Cumbia", "Música de cantautor", "Nueva Canción", "Pasodoble"
                ];

                // Muestra cada género como una opción en el select
                foreach ($generos as $genero) {
                    echo "<option value='$genero'>$genero</option>";
                }
                ?>
            </select><br>

            <!-- Campo para ingresar el precio del vinilo -->
            <label for="precio">Precio:</label>
            <input type="number" name="precio" step="0.01" required><br>

            <!-- Campo para ingresar la fecha de lanzamiento del vinilo -->
            <label for="fecha">Fecha de Lanzamiento:</label>
            <input type="date" name="fecha" required><br>

            <!-- Campo para ingresar la URL de la imagen del vinilo -->
            <label for="imagen">URL de la Imagen:</label>
            <input type="text" name="imagen" required><br><br>

            <!-- Botón para enviar el formulario -->
            <input type="submit" value="Añadir Vinilo">
        </form>
    </div>

    <!-- Pie de página con mi propio copy  -->
    <div class="footer">
        <p>Copyright (c) 2024 Izeta3. All rights reserved.</p>
    </div>

</body>
</html>
