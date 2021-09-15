<section>

    <form style="text-align: right;">
        <label for="categorias">Categoria</label>
        <select id="categoria" name="cat">
            <option>Todas</option>
            <?php foreach ($lstCategoriasActivas as $cat) { ?>
                <option value="<?= $cat["id"] ?>" <?= $cat["id"] == getValorGet("cat") ? "selected" : "" ?>> <?= $cat["nombre"] ?> </option>
            <?php } ?>
        </select>
        <input class="boton" type="submit" name="btnFiltrar" value="Filtrar">

        <?php if (getValorGet("cat") != "") { ?>
            <a class="boton" href="index.php">Borrar filtros</a>
        <?php } ?>
    </form>
    <hr>
    <?php
    foreach ($arrNoticias as $item) { ?>
        <article class="noticia">
            <h1><?= $item["titulo"] ?></h1>
            <div class="contenido">
                <?= $item["contenido"] ?>
            </div>
            <footer>
                <p>Publicada el -> <?= $item["fechaPublicacion"] ?> por <?= $item["autor"] ?> </p>
            </footer>
            <?php if (isUserLogged()) { ?>
                <p> <a class="boton" href="index.php?p=noticias&accion=editar&id=<?= $item["id"] ?>">Editar</a>
                    <a class="boton" href="index.php?p=noticias&accion=eliminar&id=<?= $item["id"] ?>">Eliminar</a>
                </p>
            <?php } ?>
        </article>
    <?php

    }
    if (count($arrNoticias) == 0) {
    ?><p class="noResult">¡No hay noticias de esta categoría!</p><?php
                                                                    }
                                                                        ?>
    <?php if (isUserLogged()) { ?>
        <hr>
        <p style="text-align:center">
            <a class="boton" href="index.php?p=noticias&accion=crear">Crear noticia</a>
            <a class="boton" href="index.php?p=categorias&accion=crear">Crear categoria</a>
        </p>
    <?php } ?>
    <p>
        <?php if ($nTotalNoticias > 1) { ?>
            <?php for ($i = 1; $i <= $nTotalNoticias; $i++) { ?>
                <a class="boton" href="index.php?p=home<?= (hayValorGet("cat") ? "&cat=" . getValorGet("cat") : "") ?>&page=<?= $i ?>"><?= $i ?></a>
            <?php } ?>
        <?php } ?>
    </p>
</section>