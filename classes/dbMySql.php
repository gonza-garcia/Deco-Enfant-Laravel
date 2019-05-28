<?php
  include_once("db.php");

/**
 *
 */
class dbMysql extends Db
{
  protected $conection;
        // protected $name;
        // protected $pass;
        // protected $email;

    function __construct()
    {
      $dsn = "mysql:dbname=deco_enfant;host=127.0.0.1;port=3306";
      $usuario= "root";
      $pass = "";

      try {
        $this->conection = new PDO ($dsn, $usuario, $pass);
        $this->conection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Bienvenido. La base funciona bien";

      } catch (\Exception $e) {
          echo $e->getMessage();
          echo "Hubo un error <br>";
          exit;
      }
    }

    public function guardarUsuario(Usuario $usuario)
    {

    }

    public function buscarPorEmail($email) {

    };

}


 ?>
