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
            $consulta = 'SELECT * FROM usuario WHERE id_usuario = \'' . $id . '\'';
            $q = mysqli_query($conexion, $consulta);
            $numFilas = mysqli_num_rows($q);
            if ($numFilas > 0) {
                $fila = mysqli_fetch_array($q);
            } else {
                echo '<p>Sin resultados</p>';
            }
        }
    } else {
        header('refresh:0;url=libro_listado.php');
    }
    require("../html/header.html");
    ?>
<header>
    <p><?php echo $fecha; ?></p>
</header>
<main>
    <section>
        <article>
            <section class="menu_tmp">
                <p>Opción: Usuarios > Modificar</p>
            </section>
            <form action="usuario_modificar_ok.php" method="post" enctype="multipart/form-data">
                <legend>Modificar usuario</legend>     
                <section>
                    <input type="hidden" name="id" value="<?php echo $fila[0] ?>">
                    <label for="usuario">Usuario</label>
                    <input type="text" name="usuario" id="usuario" placeholder="Usuario" required maxlength="45" value="<?php echo $fila[1] ?>">
                    <label for="pass">Contraseña</label>
                    <input type="password" name="pass" id="pass" placeholder="Contraseña" required maxlength="45" value="<?php echo '' ?>">
                    <label for="tipo">Tipo</label>
                    <select name="tipo" id="tipo">
                        <?php
                            if ($fila[3] == 'Administrador') {
                                echo '<option value="Administrador" selected>Administrador</option>';
                                echo '<option value="Común">Común</option>';
                            } else {
                                echo '<option value="Administrador">Administrador</option>';
                                echo '<option value="Común" selected>Común</option>';
                            }
                        ?>
                    </select>
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" id="foto">
                    <section id="boton">
                        <input type="submit" name="enviar" value="Confirmar">
                        <a href="usuario_listado.php">Cancelar</a>
                    </section>
                </section>
            </form>
        </article>
    </section>
</main>

<?php
    require("../html/footer.html");
?>