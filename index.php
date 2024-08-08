<?php
    $ruta = 'css';
    require("html/header.html");
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    setlocale(LC_ALL,'spanish');
    $fechaActual = strftime('%A %d de %B de %Y');
?>
<header>
    <p><?php echo ucfirst($fechaActual) ?></p>
</header>
<main id="logueo">
    <section>
        <article>
            <form action="php/logueo.php" method="post">
                <legend>Inicia sesión en tu cuenta</legend>     
                <section>
                    <label for="usuario">Usuario</label>
                    <input type="text" name="usuario" id="usuario" placeholder="Usuario" required maxlength="45">
                    <label for="pass">Contraseña</label>
                    <input type="password" name="pass" id="pass" placeholder="Contraseña" required maxlength="45">
                    <section id="boton">
                        <input type="submit" name="enviar" value="Iniciar sesión">
                    </section>
                </section>
            </form>
        </article>
    </section>
</main>

<?php
    require("html/footer.html");
?>