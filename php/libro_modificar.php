<?php
    session_start();
    $ruta = '../css';
    require("conexion.php");
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    setlocale(LC_ALL,'spanish');
    $fecha = strftime ('%A %d de %B de %Y');

    if (!empty($_SESSION['nombre']) && $_SESSION['tipo'] == 'Administrador') {
        $conexion = conectar();
        if ($conexion && !empty($_GET['id'])) {
            $id = $_GET['id'];
            $consulta = 'SELECT * FROM libro WHERE id_libro = \'' . $id . '\'';
            $q = mysqli_query($conexion, $consulta);
            desconectar($conexion);
            $numFilas = mysqli_num_rows($q);
            if ($numFilas > 0) {
                $fila = mysqli_fetch_array($q);
            } else {
                require_once("../html/header.html");
                echo '<p>Sin resultados</p>';
            }
        }
    } else {
        header('refresh:0;url=libro_listado.php');
    }
    ?>
<header>
    <p><?php echo $fecha; ?></p>
</header>
<main>
    <section>
        <article>
            <section class="menu_tmp">
                <p>Opción: Libros > Modificar</p>
            </section>
            <form action="libro_modificar_ok.php" method="post" enctype="multipart/form-data">
                <legend>Modificar libro</legend>     
                <section>
                    <input type="hidden" name="id" value="<?php echo $fila['id_libro'] ?>">
                    <label for="tit">Titulo</label>
                    <input type="text" name="titulo" id="tit" placeholder="Titulo" required maxlength="45" value="<?php echo $fila['titulo'] ?>">
                    <label for="aut">Autor</label>
                    <input type="text" name="autor" id="aut" placeholder="Autor" required maxlength="45" value="<?php echo $fila['autor'] ?>">
                    <label for="gen">Género</label>
                    <input type="text" name="genero" id="gen" placeholder="Género" required maxlength="45" value="<?php echo $fila['genero'] ?>">
                    <label for="pag">Páginas</label>
                    <input type="number" name="paginas" id="pag" placeholder="Páginas" required value="<?php echo $fila['paginas'] ?>">
                    <label for="fec">Fecha</label>
                    <input type="date" name="fecha" id="fec" placeholder="Fecha" required value="<?php echo $fila['fecha_publicacion'] ?>">
                    <label for="port">Portada</label>
                    <input type="file" name="portada" id="port">

                    <section id="boton">
                        <input type="submit" name="enviar" value="Confirmar">
                        <a href="libro_listado.php">Cancelar</a>
                    </section>
                </section>
            </form>
        </article>
    </section>
</main>

<?php
    require("../html/footer.html");
?>