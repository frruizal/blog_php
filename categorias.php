<?php if ($accion == "editar") { ?>
    <form class="frm" method="post" action="index.php?p=categorias&accion=editar&id=<?= $id ?>">

        <!-- si eso añadir el id pero que no se pueda modificar -->
        <p>
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="<?= $categoria["nombre"] ?>">
        </p>
        <p>
            <label for="activo">Activo</label>
            <input type="checkbox" id="activo" name="activo" <?= $categoria["activo"] ? "checked" : "" ?>>
        </p>

        <p class="cntBotones">
            <input class="boton" type="submit" name="btnSave" value="Guardar">
        </p>

    </form>

<?php } else if ($accion == "crear") { ?>
    <form class="frm" method="post" action="index.php?p=categorias&accion=crear">
        <!--
        <p>
            <label for="id">Id</label>
            <input type="text" id="id" name="id" value="<?= $categoria["id"] ?>">
        </p> -->
        <p>
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="<?= $categoria["nombre"] ?>">
        </p>
        <p>
            <label for="activo">Activo</label>
            <input type="checkbox" id="activo" name="activo" <?= $categoria["activo"] ? "checked" : "" ?>>
        </p>

        <p class="cntBotones">
            <input class="boton" type="submit" name="btnSave" value="Guardar">
        </p>
    </form>

<?php } else {
?>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Activo</th>
        </tr>
        <?php

        foreach ($lstCategorias as $item) {
        ?>
            <tr>
                <td><?= $item["id"] ?></td>
                <td><?= $item["nombre"] ?></td>
                <td style="text-align:center"><?= $item["activo"] ?></td>
                <?php if (isUserLogged()) { ?>
                    <td>
                        <a class="boton" href="index.php?p=categorias&accion=editar&id=<?= $item["id"] ?>">Editar</a>
                        <a class="boton" href="index.php?p=categorias&accion=eliminar&id=<?= $item["id"] ?>">Eliminar</a>
                    </td>
                <?php } ?>
            </tr>
            <?php

            ?>

        <?php }

        ?>
    </table>
    <?php if (isUserLogged()) { ?>
        <p style="text-align:center;">
            <a class="boton" href="index.php?p=categorias&accion=crear">Crear categoria</a>
        </p>
    <?php } ?>

    <p>
        <?php for ($i = 1; $i <= $nTotalPaginas; $i++) { ?>
            <a class="boton" href="index.php?p=categorias&page=<?= $i ?>"><?= $i ?></a>
        <?php } ?>
    </p>
<?php
} ?>