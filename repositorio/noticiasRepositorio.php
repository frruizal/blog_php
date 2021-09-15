<?php

require_once "repositorioGenerico.php";
require_once DOCUMENT_ROOT . "/modelos/Noticia.php";

class NoticiasRepositorio extends RepositorioGenerico
{

    public function __construct(Conector $con)
    {
        parent::__construct($con, "noticias", Noticia::class);
    }
}
