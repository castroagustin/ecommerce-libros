<?php
session_start();
if (!empty($_POST['usuario']) && !empty($_POST['pass'])) {
    include 'conexion.php';
    $conexion = conectar();
    if ($conexion) {
        $user = $_POST['usuario'];
        $pass = sha1($_POST['pass']);
        $consulta = 'SELECT *
                    FROM usuario
                    WHERE usuario = \'' . $user . '\' AND pass = \'' . $pass . '\'';
        $q = mysqli_query($conexion, $consulta);
        $numFilas = mysqli_num_rows($q);
        if ($numFilas > 0) {
            $fila = mysqli_fetch_array($q);
            $_SESSION['nombre'] = $fila['usuario'];
            $_SESSION['tipo'] = $fila['tipo'];
            $_SESSION['foto'] = $fila['foto'];
            desconectar($conexion);
            header("refresh:0;url=libro_listado.php");
        } else {
            header("refresh:1;url=../index.php");
            echo '<p>Usuario o contraseña incorrecto</p>';
        }
    }
    
}

?>