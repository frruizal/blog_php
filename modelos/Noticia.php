<?php

require_once 'AbstractEntity.php';
require_once 'Categoria.php';

class Noticia extends AbstractEntity
{
    private $titulo;
    private $contenido;
    private $autor;
    private $fechaPublicacion;
    private $categoria; //idCategoria: int

    public function __construct($id = 0, $titulo = "", $contenido = "", $autor = "", $fechaPublicacion = null, $categoria = null)
    {
        $this->setId($id);
        $this->setTitulo($titulo);
        $this->setContenido($contenido);
        $this->setAutor($autor);
        $this->setFechaPublicacion($fechaPublicacion);
        $this->setCategoria($categoria); //idCategoria: int
    }

    public function getCamposToBBDD(): array
    {
        $campos = [
            "titulo" => $this->titulo,
            "contenido" => $this->contenido,
            "autor" => $this->autor,
            "idCategoria" => $this->getCategoria()->getId()
            //"idCategoria" => $this->categoria,
        ];

        if ($this->fechaPublicacion != null) {
            $campos["fechaPublicacion"] = $this->fechaPublicacion;
        }

        return $campos;
    }


    public function getTitulo(): string
    {
        return $this->titulo;
    }
    public function setTitulo(string $titulo)
    {
        $this->titulo = $titulo;
    }

    public function getContenido(): string
    {
        return $this->contenido;
    }
    public function setContenido(string $contenido)
    {
        $this->contenido = $contenido;
    }

    public function getAutor(): string
    {
        return $this->autor;
    }
    public function setAutor(string $autor)
    {
        $this->autor = $autor;
    }

    public function getFechaPublicacion()
    {
        return $this->fechaPublicacion;
    }
    public function setFechaPublicacion($fechaPublicacion)
    {
        $this->fechaPublicacion = $fechaPublicacion;
    }
    /*
    public function getCategoria():int {
        return $this->categoria;
    }
    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }*/

    public function getCategoria(): Categoria
    {
        return $this->categoria;
    }
    public function setCategoria(?Categoria $categoria)
    {
        $this->categoria = $categoria ?? new Categoria();
    }
}
