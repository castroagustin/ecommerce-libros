<nav>
    <section class="user-container">
        <?php
            if($_SESSION['foto'] != '') {
                echo '<img src="../img/usuarios/' . $_SESSION['foto'] . '" alt="perfil">';
            } else {
                echo '<img src="../img/usuarios/usuario_default.png" alt="perfil">';
            }
        ?>
        <p><?php echo $_SESSION['nombre']; ?></p>
        <a href="borrar.php">Cerrar sesión</a>
    </section>
    <?php
    if (!empty($_SESSION['nombre']) && $_SESSION['tipo'] == 'Administrador') {
    ?>
        <h3>Usuarios</h3>
        <ul>
            <a href="usuario_alta.php"><li>Alta usuario</li></a>
            <a href="usuario_listado.php"><li>Listado usuarios</li></a>
        </ul>
    <?php
    }
    ?>
    <h3>Libros</h3>
    <ul>
        <?php
        if (!empty($_SESSION['nombre']) && $_SESSION['tipo'] == 'Administrador') {
            echo '<a href="libro_alta.php"><li>Alta libro</li></a>';
        }
        ?>
        <a href="libro_listado.php"><li>Listado libros</li></a>
        <a href="preferencias.php"><li>Preferencias</li></a>
        <a href="favoritos_listado.php"><li>Listar favoritos</li></a>
    </ul>
</nav>