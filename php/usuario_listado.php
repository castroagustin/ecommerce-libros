<?php
    session_start();
    $ruta = '../css';
    require("conexion.php");
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    setlocale(LC_ALL,'spanish');
    $fecha = strftime ('%A %d de %B de %Y');

    if (!empty($_SESSION['nombre']) && $_SESSION['tipo'] == 'Administrador') {
    require("../html/header.html");
?>
<header>
    <p><?php echo $fecha; ?></p>
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
                    <a class="enlace_boton" href="usuario_alta.php">Alta usuario</a>
                </section>
                <table>
                    <caption>Listado de usuarios</caption>
                    <tr>
                        <th>Foto</th>
                        <th>Usuario</th>
                        <th>Tipo</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
        
                    <?php
                        $conexion = conectar();
                        $consulta = 'SELECT * FROM usuario';
                        $q = mysqli_query($conexion, $consulta);
                        $numFilas = mysqli_num_rows($q);
                        if ($numFilas > 0) {
                            while ($fila = mysqli_fetch_array($q)) {
                                echo '<tr>';
                                if ($fila[4] != '') {
                                    echo '<td> <img src="../img/usuarios/' . $fila[4] . '"></td>';
                                } else {
                                    echo '<td> <img src="../img/usuarios/usuario_default.png" alt=""></td>';
                                }
                                echo '<td>' . $fila[1] . '</td>';
                                echo '<td>' . $fila[3] . '</td>';
                                echo '<td>' . '<a href="usuario_modificar.php?id='. $fila[0] .'"><img src="../img/modificar.png"></a>' . '</td>';
                                echo '<td>' . '<a href="usuario_eliminar.php?id='. $fila[0] .'"><img src="../img/eliminar.png"></a>' . '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<p>Sin resultados</p>';
                        }
                    ?>
                </table>
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