<?php

require_once("repositorioGenerico.php");
class UsuarioRepository extends RepositorioGenerico
{
  public function __construct($con)
  {
    parent::__construct($con, "usuarios");
  }


  function compruebaLogin($username, $pass)
  {
    $sql = "SELECT * FROM {$this->tabla} WHERE username =:username AND pass=:pass";
    $st = $this->con->prepareStatement($sql);
    //$st = $this->con->prepare($sql);
    $st->bindParam(":username", $username);
    $st->bindParam(":pass", sha1($pass));

    $st->execute();
    $user = $st->fetch();
    if ($user != null && $user["username" == $username]) {
      return true;
    } else {
      return false;
    }
  }
  function saveLastConecction($username)
  {
    //$timestamp = date("Y-m-d h:i:s");
    $sql = "UPDATE {$this->tabla} SET fecha_sesion=CURRENT_TIMESTAMP WHERE username=:username";
    // $st = $this->con->prepare($sql);
    $st = $this->con->prepareStatement($sql);
    $st->bindParam(":username", $username);
    return $st->execute();
  }
}
