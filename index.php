<?php
// Inicia la sesión 
session_start();

// Si no existe la variable de sesión 'vinilos', la inicializamos como un array vacío
if (!isset($_SESSION['vinilos'])) {
    $_SESSION['vinilos'] = [];
}

// Verifica si se ha enviado un parámetro 'filter' en la URL (para ordenar los vinilos)
if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];  // Obtiene el filtro desde la URL

    // Dependiendo del filtro seleccionado, ordenamos el array de vinilos
    switch ($filter) {
        case 'artista_asc':  // Ordena alfabéticamente por artista (A-Z)
            usort($_SESSION['vinilos'], function ($a, $b) {
                return strcmp($a['artista'], $b['artista']);
            });
            break;
        case 'artista_desc':  // Ordena alfabéticamente por artista (Z-A)
            usort($_SESSION['vinilos'], function ($a, $b) {
                return strcmp($b['artista'], $a['artista']);
            });
            break;
        case 'vinilo_asc':  // Ordena alfabéticamente por nombre del vinilo (A-Z)
            usort($_SESSION['vinilos'], function ($a, $b) {
                return strcmp($a['nombre'], $b['nombre']);
            });
            break;
        case 'vinilo_desc':  // Ordena alfabéticamente por nombre del vinilo (Z-A)
            usort($_SESSION['vinilos'], function ($a, $b) {
                return strcmp($b['nombre'], $a['nombre']);
            });
            break;
        case 'precio_asc':  // Ordena por precio, de menor a mayor
            usort($_SESSION['vinilos'], function ($a, $b) {
                return $a['precio'] - $b['precio'];
            });
            break;
        case 'precio_desc':  // Ordena por precio, de mayor a menor
            usort($_SESSION['vinilos'], function ($a, $b) {
                return $b['precio'] - $a['precio'];
            });
            break;
        case 'fecha_asc':  // Ordena por fecha, de más antigua a más nueva
            usort($_SESSION['vinilos'], function ($a, $b) {
                return strtotime($a['fecha']) - strtotime($b['fecha']);
            });
            break;
        case 'fecha_desc':  // Ordena por fecha, de más nueva a más antigua
            usort($_SESSION['vinilos'], function ($a, $b) {
                return strtotime($b['fecha']) - strtotime($a['fecha']);
            });
            break;
    }
}

// Verifica si se ha enviado un parámetro 'quick_add' para añadir un vinilo rápidamente
if (isset($_GET['quick_add']) && $_GET['quick_add'] == 'true') {
    // Crea un vinilo con información predefinida para que el profe pueda añadir uno nuevo rapidamente
    $vinilo_rapido = [
        'nombre' => 'Casanova Deluxe',
        'artista' => 'Recycled J',
        'genero' => 'Hip Hop',
        'precio' => 20,
        'fecha' => '2024-12-01',
        'imagen' => 'https://cdn.grupoelcorteingles.es/SGFM/dctm/MEDIA03/202309/04/00105112232672____2__1200x1200.jpg'
    ];

    // Añade el vinilo rápidamente al array de vinilos en la sesión
    $_SESSION['vinilos'][] = $vinilo_rapido;

    // Redirige al usuario a la página principal después de añadir el vinilo rápido
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Vinilos</title>
    <link rel="stylesheet" href="styles.css">  <!-- Vincula el archivo de estilos CSS -->
</head>
<body>

    <!-- Barra de navegación con botones para añadir vinilos -->
    <div class="navbar">
        <a href="add.php"><button>Añadir Vinilo</button></a>
        <!-- Botón para añadir un vinilo rápido con valores predefinidos -->
        <a href="index.php?quick_add=true"><button class="quick-add-button">Añadir Vinilo Rápido</button></a>
    </div>
    
    <div class="content">
        <?php
        // Si no hay vinilos en la sesión, muestra un mensaje diciendo que no hay vinilos
        if (empty($_SESSION['vinilos'])) {
            echo "<div class='no-vinilos-container'>
                    <p>No hay vinilos guardados. ¡Añade algunos!</p>
                    <img src='img/vinilo.gif' alt='Imagen sin vinilos' class='no-vinilos-image'>
                  </div>";
        } else {
            // Si hay vinilos, los mostramos en tarjetas
            foreach ($_SESSION['vinilos'] as $index => $vinilo) {
                echo "<div class='vinilo-card'>
                        <img src='" . htmlspecialchars($vinilo['imagen']) . "' alt='Imagen del vinilo'>
                        <h3>" . htmlspecialchars($vinilo['nombre']) . "</h3>
                        <p><strong>Artista:</strong> " . htmlspecialchars($vinilo['artista']) . "</p>
                        <p><strong>Género:</strong> " . htmlspecialchars($vinilo['genero']) . "</p>
                        <p><strong>Precio:</strong> " . htmlspecialchars($vinilo['precio']) . " €</p>
                        <p><strong>Fecha:</strong> " . htmlspecialchars($vinilo['fecha']) . "</p>
                        <!-- Botones para editar y borrar el vinilo -->
                        <a href='edit.php?id=$index'><button>Editar</button></a>
                        <a href='delete.php?id=$index'><button>Borrar</button></a>
                    </div>";
            }
        }
        ?>
    </div>
    
    <!-- Contenedor para el filtro de vinilos -->
    <div class="filter-container">
        <form method="GET" action="index.php">
            <select name="filter" onchange="this.form.submit()">
                <option value="">Filtrar por...</option>
                <!-- Opciones de filtrado para ordenar los vinilos -->
                <option value="artista_asc">Alfabéticamente Artista, A-Z</option>
                <option value="artista_desc">Alfabéticamente Artista, Z-A</option>
                <option value="vinilo_asc">Alfabéticamente Nombre Vinilo, A-Z</option>
                <option value="vinilo_desc">Alfabéticamente Nombre Vinilo, Z-A</option>
                <option value="precio_asc">Precio, menor a mayor</option>
                <option value="precio_desc">Precio, mayor a menor</option>
                <option value="fecha_asc">Fechas, más antiguo a más nuevo</option>
                <option value="fecha_desc">Fechas, más nuevo a más antiguo</option>
            </select>
        </form>
    </div>
    
    <!-- Pie de página -->
    <div class="footer">
        <p>Copyright (c) 2024 Izeta3. All rights reserved.</p>
    </div>

</body>
</html>
