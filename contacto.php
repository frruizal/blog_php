<?php
//meter array key exists
$name = $_POST["nombre"] ?? "";
$email = $_POST["email"] ?? "";
$asunto = $_POST["asunto"] ?? "";
$mensaje = $_POST["mensaje"] ?? "";
$_FILES["imagen"]["name"] ?? "";

?>
<h1>Contacto</h1>
<form action="index.php?p=enviar_fichero" method="post" enctype="multipart/form-data" class="frm">
    <label for="nombre">Nombre y apellidos</label>
    <input type="text" name="nombre" placeholder="Nombre y apellidos" value="<?= $name ?> " required><br>
    <label for="email">Email</label>
    <input type="text" name="email" placeholder="Email" value="<?= $email ?> " required><br>
    <label for="asunto">Asunto</label>
    <input type="text" name="asunto" placeholder="Asunto" value="<?= $asunto ?>" required><br>
    <label for="mensaje">Mensaje</label>
    <textarea name="mensaje" value="<?= $mensaje ?>" required></textarea></br>

    <label for="imagen">Fichero</label>
    <input type="file" name="imagen" required></br>
    <p class="fichBot">
        <input type="submit" value="Enviar">
    </p>

</form>