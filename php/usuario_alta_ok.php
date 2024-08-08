<?php
    session_start();
    if (!empty($_SESSION['nombre']) && $_SESSION['tipo'] == 'Administrador') {
        if (!empty($_POST['usuario']) && !empty($_POST['pass'] && !empty($_POST['tipo']))) {
            include 'conexion.php';
            $conexion = conectar();
            if ($conexion) {
                $user = $_POST['usuario'];
                $pass = $_POST['pass'];
                $type = $_POST['tipo'];
                if ($_FILES['foto']['size'] > 0) {
                    $ext = explode('.', $_FILES['foto']['name']);
                    $foto = $user . '.' . end($ext);
                    $origen = $_FILES['foto']['tmp_name'];
                    $destino = '../img/usuarios/' . $foto;
                    move_uploaded_file($origen, $destino);
                } else {
                    $foto = '';
                }
                $consulta = 'INSERT INTO usuario(usuario, pass, tipo, foto)
                            VALUE (\'' . $user . '\', \'' . sha1($pass) . '\' , \'' . $type . '\' , \'' . $foto . '\')';
                $q = mysqli_query($conexion, $consulta);
                desconectar($conexion);
                if ($q) {
                    header('refresh:1;url=usuario_listado.php');
                    include_once '../html/header.html';
                    echo '<p>Guardado exitoso</p>';
                } else {
                    echo '<p>Error</p>';
                }
            }
        }
    } else {
        header('refresh:0;url=libro_listado.php');
    }
?>