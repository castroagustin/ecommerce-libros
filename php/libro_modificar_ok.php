<?php
    session_start();
    if (!empty($_SESSION['nombre']) && $_SESSION['tipo'] == 'Administrador') {
        if (!empty($_POST['titulo']) && !empty($_POST['autor'] && !empty($_POST['genero']) && !empty($_POST['paginas']))) {
            include 'conexion.php';
            $conexion = conectar();
            if ($conexion) {
                $titulo = $_POST['titulo'];
                $autor = $_POST['autor'];
                $genero = $_POST['genero'];
                $paginas = $_POST['paginas'];
                $fecha = $_POST['fecha'];
                $id = $_POST['id'];
                if ($_FILES['portada']['size'] > 0) {
                    $ext = explode('.', $_FILES['portada']['name']);
                    $portada = $titulo . '.' . end($ext);
                    $origen = $_FILES['portada']['tmp_name'];
                    $destino = '../img/portadas/' . $portada;
                    move_uploaded_file($origen, $destino);
                } else {
                    $consultaFoto = 'SELECT portada FROM libro WHERE id_libro = \'' . $id . '\'';
                    $qFoto = mysqli_query($conexion, $consultaFoto);
                    $resultadoFoto = mysqli_fetch_array($qFoto);
                    if ($resultadoFoto[0] != '') {
                        unlink('../img/portadas/' . $resultadoFoto[0]);
                    }
                    $portada = '';
                }
                $consulta = 'UPDATE libro SET titulo = \'' . $titulo . '\', autor = \'' . $autor . '\', genero = \'' . $genero . '\', fecha_publicacion = \'' . $fecha . '\', paginas = \'' . $paginas . '\' WHERE id_libro = ' . $id;
                $q = mysqli_query($conexion, $consulta);
                desconectar($conexion);
                
                header('refresh:1;url=libro_listado.php');
                include_once '../html/header.html';
                if ($q) {
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