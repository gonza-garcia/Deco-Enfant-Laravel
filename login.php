<?php

  require_once("recursos/funciones.php");

  if(usuarioLogueado()){
    header("Location:index.php");
    exit;
  }

  $error = "";
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
    $usuario = buscarPorEmail($_POST["email"]);
    $recordarOk = (isset($_POST["recordar"]));

    if ($recordarOk) {
      setcookie("user",$emailOk);
    } else {
      setcookie("user", null, time() -1);
    }

    if ($emailOk !== null && password_verify($_POST["pass"], $usuario["pass"])) {
      $_SESSION["email"] = $usuario["email"];
      $_SESSION["nombre"] = $usuario["nombre"];

      header("location: index.php");
      exit;

    }
      $error = "Email o contraseña incorrectos. Por favor, crear una cuenta.";
  }


 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <title>Deco Enfant</title>
  <?php include("recursos/head.php") ?>
</head>


<body>
  <!-- HEADER y NAVBAR DE MENUS---------------------------->
  <?php include("recursos/header.php") ?>


  <!-- FORM DE LOGIN------------------------------------------------------------------------------------------------------->
  <form class="col-sm-10 offset-sm-1 col-md-6 offset-md-3 col-lg-4 offset-lg-4" action="login.php" method="post">
    <div class="form-group no-gutters">
      <label for="email">Email</label>
      <input class="form-control" id="email" type="email" name="email" value="<?= $emailOk?>" placeholder="Ingrese su email aqui...">
    </div>
    <div class="form-group">
      <label for="pass">Contraseña</label>
      <input class="form-control" id="pass" type="password" name="pass" value="" placeholder="Ingrese su Contraseña aqui...">
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
      <? if ($error !== "") :?>
        <a class="nav-link" href="registro.php">
          <span class="small text-danger col-form-label"><?= $error?></span>
        </a>
      <? endif; ?>
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
