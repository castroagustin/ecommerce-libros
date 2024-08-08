<?php
    session_start();
    $ruta = '../css';
    require("../html/header.html");
    require("conexion.php");
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    setlocale(LC_ALL,'spanish');
    $fechaActual = strftime('%A %d de %B de %Y');

    if (!empty($_SESSION['nombre'])) {
?>
<header>
    <p><?php echo ucfirst($fechaActual) ?></p>
    <a href="carrito_ver.php">
        <figure>
            <img src="../img/carrito.png" alt="carrito">
        </figure>
        <p>
        <?php
        if (isset($_SESSION['carrito'])) {
            echo '('.count($_SESSION['carrito']).')';
        } else {
            echo '(0)';
        }
        ?>
        </p>
    </a>
</header>
<section id="main_aside">
    <aside>
        <?php
            require_once('menu.php');
        ?>
    </aside>
    <main>
        <section id="buscador">
            <form action="" method="get">
                <input type="search" name="busqueda" placeholder="buscar...">
                <input type="submit" value="Buscar">
            </form>
        </section>
        <section id="libros">
            <?php
                $conexion = conectar();
                if (!empty($_GET['busqueda'])) {
                    $consulta = 'SELECT * FROM libro WHERE titulo LIKE \'%' . $_GET['busqueda'] . '%\' OR genero LIKE \'%' . $_GET['busqueda'] . '%\'';
                } else {
                    $consulta = 'SELECT * FROM libro';
                }

                $resultado = mysqli_query($conexion, $consulta);

                while ($fila = mysqli_fetch_array($resultado)) {
                    echo '<article>';
                    if ($fila['portada'] !='') {
                        $foto = $fila['portada'];
                    } else {
                        $foto = 'libro_default.png';
                    }
                    echo "<figure><img src='../img/portadas/".$foto."' alt='portada de libro'>";
                    echo '<figcaption>'.$fila['titulo'].'</figcaption></figure>';
                    echo '<section>';
                    echo '<p>'.$fila['autor'].'</p>';
                    echo '<p>'.$fila['genero'].'</p>';
                    echo '<p>Páginas: '.$fila['paginas'].'</p>';
                    echo '</section>';
                    echo '<div class="enlace_carrito"><a href="agregar_carrito.php?id='.$fila['id_libro'].'">Agregar al carrito</a></div>';
                    if (!empty($_SESSION['nombre']) && $_SESSION['tipo'] == 'Administrador') {
                        echo '<section class="botones_ud">';
                        echo '<figure><a href="libro_modificar.php?id='. $fila['id_libro'] .'"><img src="../img/modificar.png"></figure></a>';
                        echo '<figure><a href="libro_eliminar.php?id='. $fila['id_libro'] .'"><img src="../img/eliminar.png"></figure></a>';
                        echo '</section>';
                    }
                    echo '</article>';                
                }
                desconectar($conexion);
            ?>
        </section>
    </main>
</section>
<?php
    } else {
        header('refresh:0;url=../index.php');
    }

    require("../html/footer.html");
?>