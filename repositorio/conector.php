<?php

class Conector
{
    private $con;

    public function __construct()
    {
        $this->conectBBDD();
    }

    private function conectBBDD()
    {
        try {
            $this->con = new PDO(DB_DSN, DB_USER, DB_PASS);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ePDO) {
            echo 'ERROR. No se ha podido establecer una conexión con la Base de Datos.' . $ePDO->error;
            die();
        }
        return  $this->con;
    }

    public function getConexion()
    {
        return $this->con;
    }

    public function prepareStatement($sql)
    {
        return $this->con->prepare($sql);
    }

    public function __destruct()
    {
        $this->con = null;
    }
}
