<?php
    session_start();
    if(!empty($_SESSION['nombre'])) {
        $usuario = $_SESSION['nombre'];
        session_destroy();
        setcookie($usuario, '', time() - 100, '/');
        unset($_COOKIE[$usuario]);
        header('refresh:0;url=../index.php');
    } else {
        header('refresh:0;url=index.php');
    }
?>