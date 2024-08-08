<?php
    include_once '../html/header.html';

    if (!empty($_SESSION['nombre']) && $_SESSION['tipo'] == 'Administrador') {
        if (!empty($_POST['usuario']) && !empty($_POST['pass'] && !empty($_POST['tipo']))) {
            include 'conexion.php';
            $conexion = conectar();
            if ($conexion) {
                $user = $_POST['usuario'];
                $pass = $_POST['pass'];
                $type = $_POST['tipo'];
                $id = $_POST['id'];

                if ($_FILES['foto']['size'] > 0) {
                    $ext = explode('.', $_FILES['foto']['name']);
                    $foto = $user . '.' . end($ext);
                    $origen = $_FILES['foto']['tmp_name'];
                    $destino = '../img/usuarios/' . $foto;
                    move_uploaded_file($origen, $destino);
                } else {
                    $consultaFoto = 'SELECT foto FROM usuario WHERE id_usuario = \'' . $id . '\'';
                    $qFoto = mysqli_query($conexion, $consultaFoto);
                    $resultadoFoto = mysqli_fetch_array($qFoto);
                    if ($resultadoFoto[0] != '') {
                        unlink('../img/usuarios/' . $resultadoFoto[0]);
                    }
                    $foto = '';
                }
                $consulta = 'UPDATE usuario SET usuario = \'' . $user . '\', pass = \'' . sha1($pass) . '\', tipo = \'' . $type . '\', foto = \'' . $foto . '\' WHERE id_usuario = ' . $id;
                $q = mysqli_query($conexion, $consulta);
                desconectar($conexion);
                if ($q) {
                    header('refresh:1;url=usuario_listado.php');
                    echo '<p>Usuario modificado</p>';
                } else {
                    echo '<p>Error</p>';
                }
            }
        }
    } else {
        header('refresh:0;url=libro_listado.php');
    }
?>