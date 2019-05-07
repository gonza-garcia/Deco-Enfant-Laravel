<?php

require_once "recursos/funciones.php";

if(usuarioLogueado()){
  header("Location:index.php");
  exit;
}

$formRegistro = buscarObjeto("recursos/db.json","formRegistro");


if (isset($_COOKIE["user"]))
  $formRegistro["email"]["value"]=$_COOKIE["user"];
else
  $formRegistro["email"]["value"] = "";

if (isset($_COOKIE["nombre"]))
  $nameOk = $_COOKIE["nombre"];
else
  $nameOk = "";

if ($_POST)
{
  $errores = validarDatos($_POST);

  if (empty($errores))   ///si NO hay errores
  {
    $usuario = armarObjeto($_POST, "usuarios", "recursos/db.json");
    $guardarOk = guardarObjeto($usuario, "usuarios", "recursos/db.json");

    if ($guardarOk === true)
    {
      // var_dump($usuario["email"]);
      setcookie("user",$usuario["email"], time() + 3 );
      header("Location: login.php");
      exit;
    }
    else
      echo "Hubo un error al intentar guardar el usuario.";

  }
  else                  ///  si HAY errores
  {
    foreach ($formRegistro as $key => $elem)
    {
      //persistir datos
      if ($key!=='pass' && $key!=='pass2')
        $formRegistro[$key]["value"] = $_POST[$key];

      //si hay error: mostrarlo y borde rojo
      if (isset($errores[$key]))
      {
        $formRegistro[$key]["class"] = "class='form-control border border-danger'";
        $formRegistro[$key]["error"] = $errores[$key];
      }
    }
  }                    ///end "si Hay errores"
}  //end if ($_POST)


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
    <?php foreach ($formRegistro as $key => $elem): ?>
      <div class="form-group">
        <label for=<?=$key;?>><?=$elem["label"];?></label>
        <input <?=$elem["class"];?> <?=$elem["parametros"];?> value=<?=$elem["value"];?>>
        <span class="small text-danger"><?=$elem["error"];?></span>
      </div>
    <?php endforeach; ?>

                    <!-- Botón Enviar -->
    <div class="form-group">
      <button type="submit" class="btn btn-light" name="submit" value="Registrarme">Registrarme</button>
      <button type="btn reset" class="btn btn-outline-primary" name="Limpiar" value="Limpiar">Limpiar</button>
    </div>
  </form><!--  end form de registro -->


  <!-- FOOTER -------------------------------------------------------->
  <?php include("recursos/footer.php") ?>

  <!-- SCRIPTS DE JAVA DE BOOTSTRAP---------------------------------->
  <?php include("recursos/scriptsJava.php") ?>

</body>

</html>
