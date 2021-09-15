<?php


?>

<h1>Blog del curso de PHP de Hiberus Tecnología</h1>
<?php if (array_key_exists("username", $_SESSION) && $_SESSION["username"] !== "") { ?>
    <form action="index.php?p=logout">
        <p>Bienvenido <?= $_SESSION["username"] ?>
            <a class="boton" href="index.php?p=logout">Salir</a>
            <!--<input type="submit" name="btnSalir" value="salir"> -->
        </p>
    </form>
<?php } else { ?>
    <form method="post" action="index.php?p=login">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?= $username ?>">

        <label for="password">Password</label>
        <input type="password" name="password" id="password">

        <input type="submit" name="btnLogin" value="Iniciar Sesion">
    </form>
<?php } ?>