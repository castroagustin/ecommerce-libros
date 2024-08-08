<?php
    session_start();
    $ruta = '../css';
    require("../html/header.html");
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
        <section id="libros">
            <?php
                if (!empty($_SESSION['carrito'])) {
                    $carrito = $_SESSION['carrito'];

                    for ($i = 0; $i < count($carrito); $i++) {
                        echo '<article>';
                        if ($carrito[$i]['portada'] !='') {
                            $foto = $carrito[$i]['portada'];
                        } else {
                            $foto = 'libro_default.png';
                        }
                        echo "<figure><img src='../img/portadas/".$foto."' alt='portada de libro'>";
                        echo '<figcaption>'.$carrito[$i]['titulo'].'</figcaption></figure>';
                        echo '<section>';
                        echo '<p>'.$carrito[$i]['autor'].'</p>';
                        echo '<p>'.$carrito[$i]['genero'].'</p>';
                        echo '<p>Páginas: '.$carrito[$i]['paginas'].'</p>';
                        echo '</section>';
                        echo '</article>'; 
                    }

                } else {
                    echo '<h3>El carrito está vacío</h3>';
                }
            ?>
        </section>
    </main>
</section>
<?php
    } else {
        header('refresh:1;url=../index.php');
    }

    require("../html/footer.html");
?>