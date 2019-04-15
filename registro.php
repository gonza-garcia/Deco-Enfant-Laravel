<?php

require_once "recursos/funciones.php";

$errores = [];

$nameOk = "";
$emailOk = "";
$telOk = "";

if ($_POST) {
  //validar los campos y devolver errores.

  // var_dump(existeUsuario($_POST["email"]));

  $errores = validarRegistro($_POST);
  // var_dump($errores);

  $nameOk = trim($_POST["nombre"]);
  $emailOk = trim($_POST["email"]);
  $telOk = trim($_POST["telefono"]);


  if (empty($errores)) { 
    // Si no hay errores
      //Crear usuario
      if(!existeUsuario($_POST["email"])){
        $usuario = armarUsuario();
        //Guardar usuario      
        guardarUsuario($usuario);
        //redireccionar el usuario a la pagina de exito.
        header("Location:registradoExito.php"); //nombre de archivo inventado. no existe todavia.  
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
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>eCommerce</title>

  <!-- Fuentes Custom---------------------------------------------->
  <link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Sacramento&amp;subset=latin-ext" rel="stylesheet">


  <!-- REVISARRR ESTE ICONO -->
  <a href="https://icons8.com/icon/80664/paper-plane"></a>

  <!-- Bootstrap CDN, Google Fonts, Font Awesome------------------->
  <link href="https://fonts.googleapis.com/css?family=Lato|Montserrat:400,700" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!-- Hojas de Estilo-------------------------------------------->
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <!-- HEADER y NAVBAR DE MENUS---------------------------->
  <?php include("recursos/header.php") ?>






  <!-- FORM DE REGISTRO------------------------------------------------------------------------------------------------------->
  <form class="col-sm-10 offset-sm-1 col-md-6 offset-md-3 col-lg-4 offset-lg-4" action="registro.php" method="POST" enctype="multipart/form-data">
    <?php if (!isset($errores["nombre"])) : ?>
      <div class="form-group">
        <label for="nombre">Nombre</label>
        <input class="form-control" id="nombre" type="text" name="nombre" value="<?= $nameOk ?>" placeholder="Ingrese su nombre aqui...">
        <span class="small"></span>
      </div>
    <?php else : ?>
      <div class="form-group">
        <label for="nombre">Nombre</label>
        <input class="form-control border border-danger" id="nombre" type="text" name="nombre" value="" placeholder="Ingrese su nombre aqui...">
        <span class="small text-danger"><?= $errores["nombre"] ?></span>
      </div>
    <?php endif; ?>
    <?php if (!isset($errores["telefono"])) : ?>
      <div class="form-group">
        <label for="telefono">Telefono</label>
        <input class="form-control" id="telefono" type="text" name="telefono" value="<?= $telOk ?>" placeholder="Ingrese su telefono aqui...">
        <span class="small"></span>
      </div>
    <?php else : ?>
      <div class="form-group">
        <label for="telefono">Telefono</label>
        <input class="form-control border border-danger" id="telefono" type="tel" name="telefono" value="" placeholder="Ingrese su telefono aqui...">
        <span class="small text-danger"><?= $errores["telefono"] ?></span>
      </div>
    <?php endif; ?>

    <?php if (!isset($errores["email"])) : ?>
    <div class="form-group">
      <label for="email">Email</label>
      <input class="form-control" id="email" type="email" name="email" value="<?= $emailOk ?>" placeholder="Ingrese su email aqui...">
    </div>
    <?php else : ?>
    <div class="form-group">
      <label for="email">Email</label>
      <input class="form-control border border-danger" id="email" type="email" name="email" value="" placeholder="Ingrese su email aqui...">
      <span class="small text-danger"><?= $errores["email"] ?></span>
    </div>
    <?php endif; ?>

    <div class="form-group">
      <label for="pass">Contraseña</label>
      <input class="form-control" id="pass" type="password" name="pass" value="" placeholder="Ingrese su Contraseña aqui...">
    </div>

    <div class="form-group">
      <label for="pass2">Confirmar Contraseña</label>
      <input class="form-control " id="pass2" type="password" name="pass2" value="" placeholder="Repita su Contraseña aqui...">
    </div>
    <div class="form-group">
      <label for="avatar">Imagen de Perfil
        <input class="form-contro" id="avatar" type="file" id="avatar" name="avatar" value="" placeholder="">
    </div>
    <div class="form-group">
      <button type="btn submit" class="btn btn-outline-primary" name="Registrarme" value="Registrarme">Registrarme</button>
      <button type="btn reset" class="btn btn-outline-primary" name="Limpiar" value="Limpiar">Limpiar</button>
    </div>
  </form>






  <!-- FOOTER -------------------------------------------------------->
  <?php include("recursos/footer.php") ?>




  <!-- SCRIPTS DE JAVA DE BOOTSTRAP--------------------------------------------------------------------------------------->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>