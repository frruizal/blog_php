<?php

require_once 'AbstractEntity.php';

class Categoria extends AbstractEntity
{
    private $nombre;
    private $activo;

    public function __construct($id = 0, $nombre = "", $activo = 1)
    {
        $this->setId($id);
        $this->setNombre($nombre);
        $this->setActivo($activo);
    }

    public function getCamposToBBDD(): array
    {
        return ["nombre" => $this->nombre, "activo" => $this->activo ? "1" : "0"];
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }
    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;
    }

    public function getActivo(): bool
    {
        return $this->activo;
    }
    public function setActivo(bool $activo)
    {
        $this->activo = $activo;
    }
}
