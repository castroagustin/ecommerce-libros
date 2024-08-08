<?php
    session_start();
    $ruta = '../css';
    require("../html/header.html");

    if (!empty($_SESSION['nombre'])) {
        $usuario = $_SESSION['nombre'];
        $genero = $_POST['genero'];
        $tiempo_expira = time() + 30 * 24 * 60 * 60;
        setcookie($usuario, $genero, $tiempo_expira, '/');
        header('refresh:0;url=libro_listado.php');
    }
?>