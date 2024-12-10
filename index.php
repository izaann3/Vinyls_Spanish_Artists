<?php
session_start();
if (!isset($_SESSION['vinilos'])) {
    $_SESSION['vinilos'] = [];
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
    </div>

    <div class="content">
        <?php
        // Si no hay vinilos, mostramos un mensaje
        if (empty($_SESSION['vinilos'])) {
            echo "<p>No hay vinilos guardados. ¡Añade algunos!</p>";
        } else {
            // Si hay vinilos, los mostramos en tarjetas
            foreach ($_SESSION['vinilos'] as $index => $vinilo) {
                echo "<div class='vinilo-card'>
                        <img src='" . htmlspecialchars($vinilo['imagen']) . "' alt='Imagen del vinilo'>
                        <h3>" . htmlspecialchars($vinilo['nombre']) . "</h3>
                        <p><strong>Artista:</strong> " . htmlspecialchars($vinilo['artista']) . "</p>
                        <p><strong>Precio:</strong> " . htmlspecialchars($vinilo['precio']) . " €</p>
                        <p><strong>Fecha:</strong> " . htmlspecialchars($vinilo['fecha']) . "</p>
                        <a href='edit.php?id=$index'><button>Editar</button></a>
                        <a href='delete.php?id=$index'><button>Borrar</button></a>
                    </div>";
            }
        }
        ?>
    </div>

</body>
</html>

