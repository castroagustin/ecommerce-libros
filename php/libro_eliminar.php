<?php
    session_start();
    $ruta = '../css';
    include 'conexion.php';
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    setlocale(LC_ALL,'spanish');
    $fecha = strftime ('%A %d de %B de %Y');

    $id = $_GET['id'];
    $conexion = conectar();
    $consulta = 'SELECT titulo FROM libro WHERE id_libro = \'' . $id . '\'';
    $q = mysqli_query($conexion, $consulta);
    desconectar($conexion);
    $fila = mysqli_fetch_array($q);

    if (!empty($_SESSION['nombre']) && $_SESSION['tipo'] == 'Administrador') {
    require("../html/header.html");
?>

<header>
    <p><?php echo $fecha; ?></p>
</header>
<main>
    <section>
        <article id="borrar">
            <h1>Eliminar usuario</h1>
            <p>Esta seguro de querer eliminar al usuario <?php echo '<strong>' . $fila['titulo'] . '</strong>'; ?>?</p>
            <article class="botones">
                <a href="libro_eliminar_ok.php?id=<?php echo $id ?>">Aceptar</a>
                <a href="libro_listado.php">Cancelar</a>
            </article>
        </article>
    </section>
</main>

<?php
    } else {
        header('refresh:0;url=libro_listado.php');
    }
    require("../html/footer.html");
?>