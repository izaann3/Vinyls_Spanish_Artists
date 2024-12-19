<?php
// Inicia la sesión para poder almacenar y recuperar datos durante la navegación
session_start();

// Verifica si se ha pasado un ID por GET y si ese ID corresponde a un vinilo en la sesión
if (isset($_GET['id']) && isset($_SESSION['vinilos'][$_GET['id']])) {
    // Recupera el vinilo desde la sesión usando el ID
    $vinilo = $_SESSION['vinilos'][$_GET['id']];
    $id = $_GET['id'];  // Guarda el ID del vinilo para futuras referencias
}

// Verifica si se ha enviado el formulario para editar el vinilo
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Actualiza la información del vinilo en la sesión
    $_SESSION['vinilos'][$id] = [
        'nombre' => $_POST['nombre'],  // Nombre del vinilo
        'artista' => $_POST['artista'],  // Artista del vinilo
        'genero' => $_POST['genero'],  // Género del vinilo
        'precio' => $_POST['precio'],  // Precio del vinilo
        'fecha' => $_POST['fecha'],  // Fecha de lanzamiento
        'imagen' => $_POST['imagen']  // URL de la imagen del vinilo
    ];
    // Redirige al usuario a la página principal después de guardar los cambios
    header('Location: index.php');
    exit;  // Asegura que no se ejecute más código después de la redirección
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

    <!-- Barra de navegación con un botón para volver a la página principal -->
    <div class="navbar">
        <a href="index.php"><button>Volver</button></a>
    </div>

    <!-- Contenido principal de la página -->
    <div class="content">
        <h2>Editar Vinilo</h2>  <!-- Título de la sección -->
        <!-- Formulario para editar el vinilo -->
        <form method="POST" action="edit.php?id=<?php echo $id; ?>">  <!-- El formulario envía los datos a esta misma página, incluyendo el ID en la URL -->
            
            <!-- Campo para ingresar el nombre del vinilo, con el valor actual prellenado -->
            <label for="nombre">Nombre del Vinilo:</label>
            <input type="text" name="nombre" value="<?php echo $vinilo['nombre']; ?>" required><br>
            
            <!-- Campo para ingresar el nombre del artista, con el valor actual prellenado -->
            <label for="artista">Nombre del Artista:</label>
            <input type="text" name="artista" value="<?php echo $vinilo['artista']; ?>" required><br>
            
            <!-- Campo para seleccionar el género del vinilo, con la opción preseleccionada según el valor actual -->
            <label for="genero">Género:</label>
            <select name="genero" required>
                <?php
                // Lista de géneros musicales disponibles
                $generos = [
                    "Flamenco", "Salsa", "Rumba", "Bossa nova", "Pop español", 
                    "Rock español", "Indie español", "Reggaetón", "Trap", 
                    "Hip hop", "Vallenato", "Música electrónica", "Tango", 
                    "Cumbia", "Música de cantautor", "Nueva Canción", "Pasodoble"
                ];

                // Itera sobre la lista de géneros y selecciona el que corresponde al vinilo actual
                foreach ($generos as $genero) {
                    // Si el género del vinilo es igual al de la opción, lo marca como seleccionado
                    $selected = ($vinilo['genero'] == $genero) ? 'selected' : '';
                    echo "<option value='$genero' $selected>$genero</option>";
                }
                ?>
            </select><br>

            <!-- Campo para ingresar el precio del vinilo, con el valor actual prellenado -->
            <label for="precio">Precio:</label>
            <input type="number" name="precio" step="0.01" value="<?php echo $vinilo['precio']; ?>" required><br>
            
            <!-- Campo para ingresar la fecha de lanzamiento, con el valor actual prellenado -->
            <label for="fecha">Fecha de Lanzamiento:</label>
            <input type="date" name="fecha" value="<?php echo $vinilo['fecha']; ?>" required><br>
            
            <!-- Campo para ingresar la URL de la imagen del vinilo, con el valor actual prellenado -->
            <label for="imagen">URL de la Imagen:</label>
            <input type="text" name="imagen" value="<?php echo $vinilo['imagen']; ?>" required><br><br>

            <!-- Botón para enviar el formulario con los cambios -->
            <input type="submit" value="Guardar Cambios">
        </form>
    </div>

    <!-- Pie de página con mi propio copy -->
    <div class="footer">
        <p>Copyright (c) 2024 Izeta3. All rights reserved.</p>
    </div>

</body>
</html>
