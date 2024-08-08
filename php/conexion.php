<?php
    function conectar ()
    {
        $servidor = 'localhost:3307';
        $usuario = 'root';
        $clave = '';
        $db = 'labo2';
        $conexion = mysqli_connect($servidor, $usuario, $clave, $db);
        if (!$conexion) {
            echo '<p>Error al conectar</p>';
        } else {
            return $conexion;
        }
    }

    function desconectar ($conexion)
    {
        if ($conexion) {
            $desco = mysqli_close($conexion);
            if ($desco) {
                
            } else {
                echo '<p>Error al desconectar</p>';
            }
        } else {
            echo '<p>No existe conexión</p>';
        }
    }
?>