<?php

require_once 'recursos/funciones.php';

if(!usuarioLogueado()){
  header("Location:index.php");
  exit;
}

$nameOk = "";
$emailOk = "";

// $usuario = buscarPorID($_GET["id"]);
if ($_GET) {
  $usuario = buscarObjeto("recursos/db.json","usuarios", buscarPorID($_GET["id"]));
  $formRegistro = buscarObjeto("recursos/db.json","formRegistro");

  // var_dump($formRegistro);
  // var_dump($usuario);

  // $formRegistro["nombre"]["value"]=$usuario["nombre"];
  foreach ($formRegistro as $key => $valor) {
    foreach ($usuario as $ukey => $uvalor) {
      if ($key == $ukey && $key !== "pass") {
        $formRegistro[$key]["value"] = $uvalor;
      }
    }
  }
  // var_dump($formRegistro);
}

$errores = [];

// $nameOk = $usuario["nombre"];
// $emailOk = $usuario["email"];

if($_POST){
  //Validar los campos y a devolver errroes.
  //var_dump($_POST);
  //exit;
  //var_dump(existeElUsuario($_POST["email"]));
  //exit;

  // $errores = validarRegistro($_POST);
  //var_dump($errores);
  //
  // $nameOk = trim($_POST["name"]);
  // $emailOk = trim($_POST["email"]);


  if(empty($errores)){
    //Si no hay $errores
      // Crear usaurio
      // if(!existeElUsuario($_POST["email"])){ //Esta validación se puede pasar tambien en los errores. En ese caso hay que chequear previamente que el archivo .json exista.
      // $usuario = armarUsuario();
      //var_dump($usuario);
      // Guardar usuario.
      // guardarUsuario($usuario);

      // Guardar imagen
      // $ext = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
      // move_uploaded_file($_FILES["avatar"]["tmp_name"], "img/" . $usuario["id"] . "." . $ext);

      // loguearUsuario($_POST["email"]);

      // Redirigir  a home logueado.
      header("Location:listado.php");
      exit;
    // }
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
  <form class="col-sm-10 offset-sm-1 col-md-6 offset-md-3 col-lg-4 offset-lg-4" action="edit.php" method="POST" enctype="multipart/form-data">

    <h3 class="col-md-6 offset-md-3"> Editar Perfil </h3>
    <h5 class="col-md-6 offset-md-3"> <?=$emailOk?> </h5>

                    <!-- Generar Campos -->
    <?php foreach ($formRegistro as $key => $elem): ?>
      <!-- <?php var_dump($formRegistro[$key]); ?> -->
      <?php if ($elem["label"] !== "E-mail") : ?>
        <div class="form-group">
          <label for=<?=$key;?>><?=$elem["label"];?></label>
          <input <?=$elem["class"];?> <?=$elem["parametros"];?> value=<?=$elem["value"];?>>
          <span class="small text-danger"><?=$elem["error"];?></span>
        </div>
      <?php endif; ?>
    <?php endforeach; ?>

                    <!-- Botón Enviar -->
    <div class="form-group">
      <button type="btn submit" class="btn btn-light" name="submit" value="Registrarme">Guardar</button>
      <!-- <button type="btn reset" class="btn btn-outline-primary" name="Limpiar" value="Limpiar">Limpiar</button>

              <button class="btn btn-info" type="submit" >Guardar</button> -->
    </div>
  </form><!--  end form de registro -->


  <!-- FOOTER -------------------------------------------------------->
  <?php include("recursos/footer.php") ?>

  <!-- SCRIPTS DE JAVA DE BOOTSTRAP---------------------------------->
  <?php include("recursos/scriptsJava.php") ?>

</body>

</html>
