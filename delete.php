<?php
session_start();

if (isset($_GET['id']) && isset($_SESSION['vinilos'][$_GET['id']])) {
    unset($_SESSION['vinilos'][$_GET['id']]);
    $_SESSION['vinilos'] = array_values($_SESSION['vinilos']);
}

header('Location: index.php');
exit;
?>

