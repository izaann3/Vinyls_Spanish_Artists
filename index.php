<?php
session_start();
if (!isset($_SESSION['vinilos'])) {
    $_SESSION['vinilos'] = [];
}

if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];

    switch ($filter) {
        case 'artista_asc':
            usort($_SESSION['vinilos'], function ($a, $b) {
                return strcmp($a['artista'], $b['artista']);
            });
            break;
        case 'artista_desc':
            usort($_SESSION['vinilos'], function ($a, $b) {
                return strcmp($b['artista'], $a['artista']);
            });
            break;
        case 'vinilo_asc':
            usort($_SESSION['vinilos'], function ($a, $b) {
                return strcmp($a['nombre'], $b['nombre']);
            });
            break;
        case 'vinilo_desc':
            usort($_SESSION['vinilos'], function ($a, $b) {
                return strcmp($b['nombre'], $a['nombre']);
            });
            break;
        case 'precio_asc':
            usort($_SESSION['vinilos'], function ($a, $b) {
                return $a['precio'] - $b['precio'];
            });
            break;
        case 'precio_desc':
            usort($_SESSION['vinilos'], function ($a, $b) {
                return $b['precio'] - $a['precio'];
            });
            break;
        case 'fecha_asc':
            usort($_SESSION['vinilos'], function ($a, $b) {
                return strtotime($a['fecha']) - strtotime($b['fecha']);
            });
            break;
        case 'fecha_desc':
            usort($_SESSION['vinilos'], function ($a, $b) {
                return strtotime($b['fecha']) - strtotime($a['fecha']);
            });
            break;
    }
}

if (isset($_GET['quick_add']) && $_GET['quick_add'] == 'true') {
    $vinilo_rapido = [
        'nombre' => 'Casanova Deluxe',
        'artista' => 'Recycled J',
        'genero' => 'Hip Hop',
        'precio' => 20,
        'fecha' => '2024-12-01',
        'imagen' => 'https://cdn.grupoelcorteingles.es/SGFM/dctm/MEDIA03/202309/04/00105112232672____2__1200x1200.jpg'
    ];

    $_SESSION['vinilos'][] = $vinilo_rapido;

    // Redirigir a la página de inicio
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
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="navbar">
        <a href="add.php"><button>Añadir Vinilo</button></a>
        <a href="index.php?quick_add=true"><button class="quick-add-button">Añadir Vinilo Rápido</button></a>
    </div>
    
    <div class="content">
        <?php
        // Si no hay vinilos, mostramos un mensaje
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
                        <a href='edit.php?id=$index'><button>Editar</button></a>
                        <a href='delete.php?id=$index'><button>Borrar</button></a>
                    </div>";
            }
        }
        ?>
    </div>
    
    <div class="filter-container">
    <form method="GET" action="index.php">
        <select name="filter" onchange="this.form.submit()">
            <option value="">Filtrar por...</option>
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
    
    <div class="footer">
        <p>Copyright (c) 2024 Izeta3. All rights reserved.</p>
    </div>

</body>
</html>

