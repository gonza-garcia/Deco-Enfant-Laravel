<?php
  include_once("db.php");
  include_once("usuario.php");

/**
 *
 */
class dbMysql extends Db
{
  protected $conection;

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
    // global $db;
    $stmt = $this->conection->prepare("INSERT INTO users
      (id, user_name, first_name, last_name, date_of_birth, phone, email, pass, role_id) VALUES
      (default, :user_name, :first_name, :last_name, :date_of_birth, :phone, :email, :pass, 2)");

    $stmt->bindValue(":user_name", $usuario->getUser_name());
    $stmt->bindValue(":first_name", $usuario->getFirst_name());
    $stmt->bindValue(":last_name", $usuario->getLast_name());
    $stmt->bindValue(":date_of_birth", $usuario->getDate_of_birth());
    $stmt->bindValue(":phone", $usuario->getPhone());
    $stmt->bindValue(":email", $usuario->getEmail());
    $stmt->bindValue(":pass", $usuario->getPass());

    $stmt->execute();
  }

  public function buscarPorEmail($email)
  {
    $stmt = $this->conection->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindValue(":email",$email);
    $stmt->execute();

    $consulta = $stmt->fetch(PDO::FETCH_ASSOC);
    // var_dump($consulta);
    if(!$consulta) {
      return null;
    } else {
      $usuario = new Usuario($consulta);
      return $usuario;
    }
  }

  public function existeUsuario($email)
  {
    return  $this->buscarPorEmail($email) !== null ;
  }

  public function buscarDestacados()
  {
    // Traer los articulos que se van a mostrar en Destacados
    $stmt = $this->conection->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 8");
    $stmt->execute();
    $articulos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $articulos;
  }

  public function buscarTodosArticulos()
  {
    // Traer todas las filas
    $stmt = $this->conection->prepare("SELECT * FROM products ORDER BY id ASC LIMIT 20");
    $stmt->execute();
    $all_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $all_rows;
  }

}


 ?>
