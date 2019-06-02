<?php

  require_once "init.php";

  if (isset($_GET["url"]))
  {
    $ultima_url = $_GET["url"];
  }

  if($auth->usuarioLogueado()){
    header("Location:index.php");
    exit;
  }

  $errores = [];
  $recordarOk = false;

  if (isset($_COOKIE["user"])) {
    $emailOk = $_COOKIE["user"];
    $recordarOk = true;
  } else {
    $emailOk = "";
    $recordarOk = false;
  }

  if ($_POST) {

    $emailOk = $_POST["email"];

    $errores = Validator::validarLog($_POST);

    if (empty($errores)) {

      $usuario = new Usuario($_POST);

      $recordarOk = (isset($_POST["recordar"]));

      if ($recordarOk) {
        setcookie("user",$emailOk);
      } else {
        setcookie("user", null, time() -1);
      }

    var_dump($_POST["pass"],password_hash($_POST["pass"], PASSWORD_DEFAULT),$usuario->getPass());
    var_dump(password_verify($_POST["pass"],$usuario->getPass()));

    if (password_verify($_POST["pass"],$usuario->getPass())) {
      // $auth->loguearUsuario($_POST["email"]);
      $auth->loguearUsuario($usuario->getEmail(),$usuario->getUser_name());

      header("location: index.php");
      exit;
    } else {
      $errores["pass"] = "Usuario o contraseña invalida";
    }
  }
}

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <title>Dèco Enfant</title>
  <?php include("recursos/head.php") ?>
</head>


<body>
  <!-- HEADER y NAVBAR DE MENUS---------------------------->
  <?php include("recursos/header.php") ?>


  <!-- FORM DE LOGIN------------------------------------------------------------------------------------------------------->
  <form class="col-sm-10 offset-sm-1 col-md-6 offset-md-3 col-lg-4 offset-lg-4" action="./login.php" method="POST">
    <div class="form-group no-gutters">
      <label for="email">Email</label>
      <input class="form-control" id="email" type="email" name="email" value="<?= $emailOk?>" placeholder="Ingrese su email aqui...">
      <?php if (isset($errores["email"])):?>
        <span class="small text-danger"><?=$errores["email"]?></span>
      <?php endif;?>
    </div>
    <div class="form-group">
      <label for="pass">Contraseña</label>
      <input class="form-control" id="pass" type="password" name="pass" value="" placeholder="Ingrese su Contraseña aqui...">
      <?php if (isset($errores["pass"])):?>
        <span class="small text-danger"><?=$errores["pass"]?></span>
      <?php endif;?>
    </div>
    <div class="form-group form-check">
      <!-- <input class="form-check-input" type="checkbox" name="recordar" value="recordar" id="CheckRecordar" > -->
      <?php if ($recordarOk) :?>
        <input class="form-check-input" type="checkbox" name="recordar" value="recordar" id="CheckRecordar" checked >
      <?php else :?>
        <input class="form-check-input" type="checkbox" name="recordar" value="recordar" id="CheckRecordar" >
      <?php endif; ?>
      <label class="form-check-label" for="CheckRecordar">Recordarme</label>
    </div>
    <div class="form-group">
      <input type="submit" class="btn btn-outline-primary" name="Ingresar" value="Ingresar">
    </div>
  </form>


  <!-- FOOTER -------------------------------------------------------->
<?php include("recursos/footer.php") ?>


<!-- SCRIPTS DE JAVA DE BOOTSTRAP---------------------------------->
<?php include("recursos/scriptsJava.php") ?>


</body>

</html>
