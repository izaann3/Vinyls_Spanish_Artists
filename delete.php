<?php
session_start();

if (isset($_GET['id']) && isset($_SESSION['vinilos'][$_GET['id']])) {
    // Eliminar el vinilo por su índice
    unset($_SESSION['vinilos'][$_GET['id']]);
    // Reindexar el array de vinilos después de eliminar uno
    $_SESSION['vinilos'] = array_values($_SESSION['vinilos']);
}

header('Location: index.php');
exit;
?>

