<?php
    session_start();
    $ruta = '../css';
    require("conexion.php");
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    setlocale(LC_ALL,'spanish');
    $fechaActual = strftime('%A %d de %B de %Y');

    if (!empty($_SESSION['nombre'])) {
    require_once("../html/header.html");
?>
    <header>
        <p><?php echo ucfirst($fechaActual) ?></p>
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
                    <h1>Preferencias</h1>
                    <form action="cookie.php" method="post" class="form-preferencias">
                        <legend>Género favorito</legend>
                            <section>
                                <label for="select-genero">
                                    Elija el género de su preferencia:
                                </label>
                                <select name="genero" id="select-genero">
                                    <?php
                                        $conexion = conectar();
                                        $consulta = 'SELECT DISTINCT(genero) FROM libro';
                                        $q = mysqli_query($conexion, $consulta);
                                        $numFilas = mysqli_num_rows($q);
                                        if ($numFilas > 0) {
                                            while ($fila = mysqli_fetch_array($q)) {
                                                echo '<option value="' . $fila[0] . '">' . $fila[0] . '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <input type="submit" value="Guardar">
                            </section>
                    </form>
                </article>
            </section>
        </main>
    </section>
<?php
    } else {
        header('refresh:1;url=../index.php');
    }
?>