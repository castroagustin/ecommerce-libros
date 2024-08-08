<?php
    session_start();
    $ruta = '../css';
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    setlocale(LC_ALL,'spanish');
    $fecha = strftime ('%A %d de %B de %Y');
    
    if (!empty($_SESSION['nombre']) && $_SESSION['tipo'] == 'Administrador') {
    require_once("../html/header.html");
?>
<header>
    <p><?php echo $fecha ?></p>
</header>
<section id="main_aside">
    <aside>
        <?php
            require_once('menu.php');
        ?>
    </aside>
    <main>
        <section>
            <article>
                <section class="menu_tmp">
                    <p>Opción: Libros > Alta</p>
                </section>
                <form action="libro_alta_ok.php" method="post" enctype="multipart/form-data">
                    <legend>Alta libro</legend>     
                    <section>
                        <label for="tit">Titulo</label>
                        <input type="text" name="titulo" id="tit" placeholder="Titulo" required maxlength="45">
                        <label for="aut">Autor</label>
                        <input type="text" name="autor" id="aut" placeholder="Autor" required maxlength="45">
                        <label for="gen">Género</label>
                        <input type="text" name="genero" id="gen" placeholder="Género" required maxlength="45">
                        <label for="pag">Páginas</label>
                        <input type="number" name="paginas" id="pag" placeholder="Páginas" required>
                        <label for="fec">Fecha</label>
                        <input type="date" name="fecha" id="fec" placeholder="Fecha" required>
                        <label for="port">Portada</label>
                        <input type="file" name="portada" id="port">
                        <section id="boton">
                            <input type="submit" name="enviar" value="Confirmar">
                        </section>
                    </section>
                </form>
            </article>
        </section>
    </main>
</section>

<?php
    } else {
        header('refresh:0;url=libro_listado.php');
    }
    require("../html/footer.html");
?>