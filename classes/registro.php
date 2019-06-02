<?php

require_once "init.php";

if($auth->usuarioLogueado()) {
  header("Location:index.php");
  exit;
}


$errores = [];

$user_nameOk = "";
$first_nameOk = "";
$last_nameOk = "";
$date_of_birthOk = "";
$phoneOk = "";
$emailOk = "";
// $sex_idOk = "";

if (isset($_COOKIE["user"])) {
  $emailOk = $_COOKIE["user"];
} else {
  $emailOk = "";
}
if (isset($_COOKIE["first_name"])) {
  $first_nameOk = $_COOKIE["first_name"];
} else {
  $first_nameOk = "";
}

if ($_POST && $_POST["formulario"] == "registro")
{
    $errores = Validator::validarRegistro($_POST);


    $user_nameOk = trim($_POST["user_name"]);
    $first_nameOk =trim($_POST["first_name"]);
    $last_nameOk = trim($_POST["last_name"]);
    $date_of_birthOk = trim($_POST["date_of_birth"]);
    $phoneOk = trim($_POST["phone"]);
    $emailOk = trim($_POST["email"]);
    // $sex_idOk = trim($_POST["sex_id"]);



      if (empty($errores)) {
        // Si no hay errores
          //Crear usuario
          if(!$dbMysql->existeUsuario($_POST["email"])){

            $usuario = new Usuario($_POST);
            // $usuario = armarUsuario();

            //Guardar usuario
            $dbMysql->guardarUsuario($usuario);

            //redireccionar el usuario a la pagina de exito.
            // header("Location: registradoExito.php"); //nombre de archivo inventado. no existe todavia.

            //redireccionar el usuario a la pagina de login.
            setcookie("user",$emailOk, time() + 3 );
            header("Location: login.php");
            exit;
          }

          else{
           return "el usuario ya existe";
          }
          //Guardar Imagen
      }
    }

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <title>Registro</title>
  <?php include("recursos/head.php") ?>
</head>


<body>

  <!-- HEADER y NAVBAR DE MENUS---------------------------->
  <?php include("recursos/header.php") ?>


  <!-- FORM DE REGISTRO------------------------------------------------------------------------------------------------------->
  <form class="col-sm-10 offset-sm-1 col-md-6 offset-md-3 col-lg-4 offset-lg-4" action="registro.php" method="POST" enctype="multipart/form-data">

                    <!-- Generar Campos -->
    <div class="form-group">
        <label for="user_name">Usuario *</label>
        <input id="user_name" class="form-control"
              name="user_name"
              type="text"
              value="<?= $user_nameOk ?>"
              placeholder="Ingrese su nombre de usuario aqui ...">
        <?php if (isset($errores["user_name"])):?>
          <span class="small text-danger"><?= $errores["user_name"] ?></span>
        <?php endif;?>
    </div>
    <div class="form-group">
        <label for="first_name">Nombre *</label>
        <input id="first_name" class="form-control"
              name="first_name"
              type="text"
              value="<?= $first_nameOk ?>"
              placeholder="Ingrese su nombre aqui ...">
        <?php if (isset($errores["first_name"])):?>
          <span class="small text-danger"><?=$errores["first_name"]?></span>
        <?php endif;?>
    </div>
    <div class="form-group">
        <label for="last_name">Apellido *</label>
        <input id="last_name" class="form-control"
              name="last_name"
              type="text"
              value="<?= $last_nameOk ?>"
              placeholder="Ingrese su apellido aqui...">
        <?php if (isset($errores["last_name"])):?>
          <span class="small text-danger"><?= $errores["last_name"] ?></span>
        <?php endif;?>
    </div>
    <div class="form-group">
        <label for="date_of_birth">Fecha de nacimiento</label>
        <input id="date_of_birth" class="form-control"
              name="date_of_birth"
              type="text"
              value="<?= $date_of_birthOk ?>"
              placeholder="Ingrese su fecha de nacimiento aqui...">
        <?php if (isset($errores["date_of_birth"])):?>
          <span class="small text-danger"><?= $errores["date_of_birth"] ?></span>
        <?php endif;?>
    </div>
    <div class="form-group">
        <label for="phone">Telefono</label>
        <input id="phone" class="form-control"
              name="phone"
              type="text"
              value="<?= $phoneOk ?>"
              placeholder="Ingrese su telefono aqui...">
        <?php if (isset($errores["phone"])):?>
          <span class="small text-danger"><?= $errores["phone"] ?></span>
        <?php endif;?>
    </div>
    <div class="form-group">
        <label for="email">E-Mail *</label>
        <input id="email" class="form-control"
              name="email"
              type="email"
              value="<?= $emailOk ?>"
              placeholder="Ingrese su email aqui...">
        <?php if (isset($errores["email"])):?>
          <span class="small text-danger"><?= $errores["email"] ?></span>
        <?php endif;?>
    </div>
    <div class="form-group">
        <label for="pass">Contraseña *</label>
        <input id="pass" class="form-control"
              name="pass"
              type="password"
              placeholder="Ingrese su contraseña aqui...">
        <?php if (isset($errores["pass"])):?>
          <span class="small text-danger"><?= $errores["pass"] ?></span>
        <?php endif;?>
    </div>
    <div class="form-group">
        <label for="pass2">Repetir Contraseña *</label>
        <input id="pass2" class="form-control"
              name="pass2"
              type="password"
              placeholder="Repita su contraseña aqui...">
        <?php if (isset($errores["pass2"])):?>
          <span class="small text-danger"><?= $errores["pass2"] ?></span>
        <?php endif;?>
    </div>

                    <!-- Botón Enviar -->

    <div class="form-group">
        <button type="submit" class="btn btn-light" name="formulario" value="registro">Registrarme</button>
        <button type="reset" class="btn btn-outline-primary">Limpiar</button>
    </div>
  </form><!--  end form de registro -->


  <!-- FOOTER -------------------------------------------------------->
  <?php include("recursos/footer.php") ?>

  <!-- SCRIPTS DE JAVA DE BOOTSTRAP---------------------------------->
  <?php include("recursos/scriptsJava.php") ?>

</body>

</html>
