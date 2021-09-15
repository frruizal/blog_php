<?php if ($accion == "editar") { ?>
    <form class="frm" method="post" action="index.php?p=noticias&accion=editar&id=<?= $id ?>">

        <!-- si eso añadir el id pero que no se pueda modificar -->
        <p>
            <label for="titulo">Titulo</label>
            <input type="text" id="titulo" name="titulo" value="<?= $noticia["titulo"] ?>">
        </p>
        <p>
            <label for="contenido">Contenido</label>
            <textarea name="contenido" value="<?= $noticia["contenido"] ?>"><?= $noticia["contenido"] ?></textarea>
        </p>
        <p>
            <label for="idCategoria">Categoria</label>
            <select id="idCategoria" name="idCategoria">
                <option>-- Selecciona una --</option>
                <?php foreach ($lstCategoriasActivas as $cat) { ?>
                    <option value="<?= $cat["id"] ?>" <?= $noticia["idCategoria"] == $cat["id"] ? "selected" : "" ?>><?= $cat["nombre"] ?></option>
                <?php } ?>
            </select>
        </p>
        <p>
            <label for="autor">Autor</label>
            <input type="text" id="autor" name="autor" value="<?= $noticia["autor"] ?>">
        </p>
        <p>
            <label for="fechaPublicacion">Fecha Publicacion</label>
            <input type="datetime" id="fechaPublicacion" name="fechaPublicacion" value="<?= date('Y-m-d h:i:s a', time()); ?>">
        </p>
        <p class="cntBotones">
            <input class="boton" type="submit" name="btnSave" value="Guardar">
        </p>

    </form>

<?php } else if ($accion == "crear") { ?>
    <form class="frm" method="post" action="index.php?p=noticias&accion=crear">
        <!--
        <p>       
            <input type="hidden" id="id" name="id" value="<?= $noticia["id"] ?>">
        </p> -->
        <p>
            <label for="titulo">Titulo</label>
            <input type="text" id="titulo" name="titulo" value="<?= $noticia["titulo"] ?>">
        </p>
        <p>
            <label for="idCategoria">Categoria</label>
            <select id="idCategoria" name="idCategoria">
                <option>-- Selecciona una --</option>
                <?php foreach ($lstCategoriasActivas as $cat) { ?>
                    <option value="<?= $cat["id"] ?>" <?= $noticia["idCategoria"] == $cat["id"] ? "selected" : "" ?>><?= $cat["nombre"] ?></option>
                <?php } ?>
            </select>
        </p>
        <p>
            <label for="contenido">Contenido</label>
            <textarea name="contenido" value="<?= $noticia["contenido"] ?>"></textarea>
        </p>
        <p>
            <label for="autor">Autor</label>
            <input type="text" id="autor" name="autor" value="<?= $noticia["autor"] ?>">
        </p>
        <p>
            <label for="fechaPublicacion">Fecha Publicacion</label>
            <input type="datetime" id="fechaPublicacion" name="fechaPublicacion" value="<?= date('Y-m-d h:i:s a', time()); ?>">
        </p>
        <p class="cntBotones">
            <input class="boton" type="submit" name="btnSave" value="Guardar">
        </p>
    </form>

    <?php } else {

    foreach ($lstNoticias as $item) {
    ?>
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
    ?>
    <?php if (isUserLogged()) { ?>
        <p style="text-align:center">
            <a class="boton" href="index.php?p=noticias&accion=crear">Crear noticia</a>
        </p>
    <?php } ?>
    <p>
        <?php for ($i = 1; $i <= $nTotalNoticias; $i++) { ?>
            <a class="boton" href="index.php?p=noticias&page=<?= $i ?>"><?= $i ?></a>
        <?php } ?>
    </p>
<?php
}
