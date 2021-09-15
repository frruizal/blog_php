<?php

abstract class AbstractEntity
{

    protected $id;

    public function setId(int $id)
    {
        $this->id = $id;
    }
    public function getId(): int
    {
        return $this->id;
    }

    abstract function getCamposToBBDD(): array;
}
