<?php

require_once "repositorioGenerico.php";
require_once DOCUMENT_ROOT . "/modelos/Categoria.php";

class CategoriasRepositorio extends RepositorioGenerico
{

    public function __construct(Conector $con)
    {
        parent::__construct($con, "categorias", Categoria::class);
    }
}
