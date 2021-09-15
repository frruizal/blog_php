<?php
class RepositorioGenerico
{
    protected $con;
    protected $tabla;

    public function __construct($con, string $tabla)
    {
        $this->con = $con;
        $this->tabla = $tabla;
    }

    public function getAll(int $nPage = 1, int $nResultados = 5): array
    {
        $offset = ($nPage - 1) * $nResultados;
        $sql = "SELECT * FROM {$this->tabla} LIMIT $offset,$nResultados ";
        // $result= mysqli_query($con,$sql);
        //  $row = mysqli_fetch_assoc($result);
        $stm = $this->con->prepare($sql);
        $stm->execute();
        $stm->setFetchmode(PDO::FETCH_ASSOC);
        return $stm->fetchAll();
        // return $row;

    }
    public function getAllByField($campos = [], int $nPage = 1, int $nResultados = 5): array
    {
        $subSql = "";
        if (count($campos) > 0) {
            $subSql = "WHERE ";
            foreach ($campos as $key => $campo) {
                $subSql .= " $key = :$key";
            }
        }

        $sql = "SELECT * FROM {$this->tabla} $subSql ";

        if ($nPage > 0) {
            $offset = ($nPage - 1) * $nResultados;
            $sql .= " LIMIT $offset,$nResultados";
        }

        $stmt = $this->prepare($sql);
        if (count($campos) > 0) {
            foreach ($campos as $key => &$campo) {
                $stmt->bindParam($key, $campo);
            }
        }

        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }

    private function insertGenerico(array $campos): bool
    {
        $subSql = "";
        $i = 0;
        foreach ($campos as $key => $campo) {
            if ($i !== 0) {
                $subSql .= ", ";
            }
            $subSql .= " $key = :$key";

            $i++;
        }
        //$subsql = nombre = :nombre
        $sql = "INSERT INTO {$this->tabla} SET $subSql";
        $stmt = $this->con->getConexion()->prepare($sql);

        foreach ($campos as $key => &$campo) {
            $stmt->bindParam($key, $campo);
        }

        return $stmt->execute();
    }


    public function getByIdGenerico(int $id)
    {
        $sql = "SELECT * FROM {$this->tabla} WHERE id = :id";
        $stmt = $this->con->getConexion()->prepare($sql);
        $stmt->bindParam("id", $id);

        $stmt->execute();

        return $stmt->fetch();
    }

    private function updateGenerico(array $campos, int $id): bool
    {
        $subSql = "";
        $i = 0;
        foreach ($campos as $key => $campo) {
            if ($i !== 0) {
                $subSql .= ", ";
            }
            $subSql .= " $key = :$key";

            $i++;
        }
        //$subsql = nombre = :nombre
        $sql = "UPDATE {$this->tabla} SET $subSql WHERE id = :id";  // UPDATE Noticias SET nombre = :nombre WHERE id = :id
        $stmt = $this->con->getConexion()->prepare($sql);

        foreach ($campos as $key => &$campo) {
            $stmt->bindParam(":" . $key, $campo);
        }
        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }

    public function deleteGenerico(int $id)
    {
        $sql = "DELETE FROM {$this->tabla} WHERE id = $id";
        return $this->con->getConexion()->exec($sql);
    }

    public function getCount($campos = []): int
    {
        $subSql = "";
        if (count($campos) > 0) {
            $subSql = "WHERE ";
            foreach ($campos as $key => $campo) {
                $subSql .= " $key = :$key";
            }
        }
        $sql = "SELECT count(*) total FROM {$this->tabla} $subSql ";

        $stmt = $this->con->getConexion()->prepare($sql);
        if (count($campos) > 0) {
            foreach ($campos as $key => &$campo) {
                $stmt->bindParam($key, $campo);
            }
        }
        $stmt->execute();

        //$stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchColumn();
    }
    public function tooggleActivo(bool $activo, int $id): bool
    {
        return $this->updateGenerico(["activo" => $activo ? 1 : 0], $id);
    }

    public function prepare($sql)
    {
        return $this->con->getConexion()->prepare($sql);
    }

    public function save(AbstractEntity $entidad, $id)
    {
        $campos = $entidad->getCamposToBBDD();

        if ($id == null || $id == 0) {
            return $this->insertGenerico($campos);
        } else {
            return $this->updateGenerico($campos, $id);
        }
    }
}
