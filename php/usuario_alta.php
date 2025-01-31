<?php
    session_start();
    $ruta = '../css';
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    setlocale(LC_ALL,'spanish');
    $fecha = strftime ('%A %d de %B de %Y');

    if (!empty($_SESSION['nombre']) && $_SESSION['tipo'] == 'Administrador') {
    require("../html/header.html");
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
                    <p>Opción: Usuarios > Alta</p>
                </section>
                <form action="usuario_alta_ok.php" method="post" enctype="multipart/form-data">
                    <legend>Alta usuario</legend>     
                    <section>
                        <label for="usuario">Usuario</label>
                        <input type="text" name="usuario" id="usuario" placeholder="Usuario" required maxlength="45">
                        <label for="pass">Contraseña</label>
                        <input type="password" name="pass" id="pass" placeholder="Contraseña" required maxlength="45">
                        <label for="tipo">Tipo</label>
                        <select name="tipo" id="tipo">
                            <option value="Administrador">Administrador</option>
                            <option value="Común">Común</option>
                        </select>
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" id="foto">
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