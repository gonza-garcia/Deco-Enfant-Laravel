<?php

require_once 'recursos/funciones.php';

if(!usuarioLogueado()){
  header("Location:index.php");
  exit;
}

$nameOk = "";
$emailOk = "";
$usuario=[];
// $usuario = buscarPorID($_GET["id"]);
if ($_GET)
{
  // $usuario = buscarObjeto("recursos/db.json","usuarios", buscarPorID($_GET["id"]));
  $usuario = buscarObjeto("recursos/db.json","usuarios", "id", $_GET["id"]);
  //$formRegistro = buscarObjeto("recursos/db.json","formRegistro");

  // // $formRegistro["nombre"]["value"]=$usuario["nombre"];
  // foreach ($formRegistro as $key => $valor)
  //   foreach ($usuario as $ukey => $uvalor)
  //     if ($key == $ukey && $key !== "pass")
  //       $formRegistro[$key]["value"] = $uvalor;



  // var_dump($formRegistro);
}

// $nameOk = $usuario["nombre"];
// $emailOk = $usuario["email"];

if ($_POST)
{
  $errores = validarDatos($_POST);

  if (empty($errores))   ///si NO hay errores
  {
    $usuario = armarObjeto($_POST, "usuarios", "recursos/db.json");
    $guardarOk = guardarObjeto($usuario, "usuarios", "recursos/db.json");

    if ($guardarOk === true)
    {
      header("Location:listado.php");
      exit;
    }
    else
      echo "Hubo un error al intentar guardar el usuario.";

  }
                   ///  si HAY errores

  //   foreach ($usuario as $key => $elem)
  //   {
  //     //persistir datos
  //     if ($key!=='pass' && $key!=='pass2')
  //       $usuario[$key]["value"] = $_POST[$key];
  //
  //     //si hay error: mostrarlo y borde rojo
  //     if (isset($errores[$key]))
  //     {
  //       $usuario[$key]["class"] = "class='form-control border border-danger'";
  //       $usuario[$key]["error"] = $errores[$key];
  //     }
  //   }
  // }                    ///end "si Hay errores"
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
  <form class="col-sm-10 offset-sm-1 col-md-6 offset-md-3 col-lg-4 offset-lg-4" action="edit.php" method="POST" enctype="multipart/form-data">

    <h3 class="col-md-6 offset-md-3"> Editar Perfil </h3>
    <h5 class="col-md-6 offset-md-3"> <?=$emailOk?> </h5>

                    <!-- Generar Campos -->

    <?php foreach ($usuario as $key => $elem): ?>
      <?php if ($key === "pass") continue; ?>
      <div class="form-group">
        <label for=<?=$key;?>><?=$key;?></label>
        <input id=<?=$key;?> class="form-control" type="text" name=<?=$key;?> value=<?=$elem;?>>
        <?php if (isset($errores[$key])) : ?>
          <span class="small text-danger"><?=$errores[$key]?></span>
        <?php endif; ?>
      </div>
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
