<?php
    session_start();
    if (!empty($_SESSION['nombre'])) {
        include 'conexion.php';
        $conexion = conectar();
        if ($conexion && !empty($_GET['id'])) {
            $id = $_GET['id'];
            $q = 'SELECT * FROM libro WHERE id_libro = \''.$id.'\'';
            $resultado = mysqli_query($conexion, $q);
            $fila = mysqli_fetch_array($resultado);
            if (isset($_SESSION['carrito'])) {
                $arr = $_SESSION['carrito'];
                $cant = count($arr);
                $arr[$cant]['id'] = $fila['id_libro'];
                $arr[$cant]['titulo'] = $fila['titulo'];
                $arr[$cant]['autor'] = $fila['autor'];
                $arr[$cant]['genero'] = $fila['genero'];
                $arr[$cant]['paginas'] = $fila['paginas'];
                $arr[$cant]['fecha_publicacion'] = $fila['fecha_publicacion'];
                $arr[$cant]['portada'] = $fila['portada'];
            } else {
                $arr[0]['id'] = $fila['id'];
                $arr[0]['titulo'] = $fila['titulo'];
                $arr[0]['autor'] = $fila['autor'];
                $arr[0]['genero'] = $fila['genero'];
                $arr[0]['paginas'] = $fila['paginas'];
                $arr[0]['fecha_publicacion'] = $fila['fecha_publicacion'];
                $arr[0]['portada'] = $fila['portada'];
            }
            $_SESSION['carrito'] = $arr;

            header('refresh:0;url=libro_listado.php');
        }
    } else {
        header('refresh:0;../index.php');
    }
?>