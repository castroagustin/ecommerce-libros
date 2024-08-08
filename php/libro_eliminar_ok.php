<?php
    session_start();
    include 'conexion.php';
    if (!empty($_SESSION['nombre']) && $_SESSION['tipo'] == 'Administrador') {
        $conexion = conectar();
        if ($conexion && !empty($_GET['id'])) {
            $id = $_GET['id'];
            $consulta = 'DELETE FROM libro WHERE id_libro = \'' . $id . '\'';
            $resultado = mysqli_query($conexion, $consulta);
            desconectar($conexion);
            if ($resultado) {
                $conexion = conectar();
                $consultaFoto = 'SELECT portada FROM libro WHERE id_libro = \'' . $id . '\'';
                $qFoto = mysqli_query($conexion, $consultaFoto);
                $resultadoFoto = mysqli_fetch_array($qFoto);
                if ($resultadoFoto[0] != '') {
                    unlink('../img/portadas/' . $resultadoFoto[0]);
                }
                header('refresh:0;url=libro_listado.php');
                require_once("../html/header.html");
            } else {
                echo '<p>No se pudo eliminar</p>';
            }
        }
    } else {
        header('refresh:0;url=libro_listado.php');
    }
?>