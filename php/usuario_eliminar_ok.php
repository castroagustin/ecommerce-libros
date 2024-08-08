<?php
    session_start();
    include 'conexion.php';
    if (!empty($_SESSION['nombre']) && $_SESSION['tipo'] == 'Administrador') {
        $conexion = conectar();
        if ($conexion && !empty($_GET['id'])) {
            $id = $_GET['id'];
            $consulta = 'DELETE FROM usuario WHERE id_usuario = \'' . $id . '\'';
            $resultado = mysqli_query($conexion, $consulta);
            desconectar($conexion);
            header('refresh:1;url=usuario_listado.php');
            require("../html/header.html");
            if ($resultado) {
                echo '<p>Eliminacion exitosa</p>';
            } else {
                echo '<p>No se pudo eliminar</p>';
            }
        }
    } else {
        header('refresh:0;url=libro_listado.php');
    }
?>