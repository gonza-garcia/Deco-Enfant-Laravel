<?php

require_once "recursos/funciones.php";

if(usuarioLogueado()){
  header("Location:index.php");
  exit;
}

$camposRegistro = [ //el booleano determina si es editable o no
      "nombre"   => [ "label_title" => "Nombre",
                      "input_class" => "class='form-control'",
                      "input_type"  => "text",
                      "input_value" => "",
                      "span_error"  => "",
                    ],
      "apellido" => [ "label_title" => "Apellido:",
                      "input_class" => "class='form-control'",
                      "input_type"  => "text",
                      "input_value" => "",
                      "span_error"  => "",
                    ],
      "email"    => [ "label_title" => "E-Mail",
                      "input_class" => "class='form-control'",
                      "input_type"  => "email",
                      "input_value" => "",
                      "span_error"  => "",
                    ],
      "fechaNac" => [ "label_title" => "Fecha De Nacimiento",
                      "input_class" => "class='form-control'",
                      "input_type"  => "text",
                      "input_value" => "",
                      "span_error"  => "",
                    ],
      "pass"     => [ "label_title" => "Contraseña",
                      "input_class" => "class='form-control'",
                      "input_type"  => "password",
                      "input_value" => "",
                      "span_error"  => "",
                    ],
      "pass2"    => [ "label_title" => "Repetir Contraseña",
                      "input_class" => "class='form-control'",
                      "input_type"  => "password",
                      "input_value" => "",
                      "span_error"  => "",
                    ],
];

// $formRegistro = buscarObjeto("recursos/db.json","formRegistro");


if (isset($_COOKIE["user"]))
  $camposRegistro["email"]["input_value"]=$_COOKIE["user"];

if (isset($_COOKIE["nombre"]))
  $nameOk = $_COOKIE["nombre"];
else
  $nameOk = "";

if ($_POST && $_POST["formulario"] == "registro")
{
    $errores = validarDatos($_POST);

    if (empty($errores))   //si NO hay errores
    {
        $usuario = armarObjeto($_POST, "usuarios", "recursos/db.json");
        $guardarOk = guardarObjeto($usuario, "usuarios", "recursos/db.json");

        if ($guardarOk === true)
        {
            setcookie("user",$usuario["email"], time() + 3 );
            header("Location: login.php");
            exit;
        }
        else
            echo "Hubo un error al intentar guardar el usuario.";
    }
    else      //  si HAY errores
    {
        foreach ($camposRegistro as $key => $campo)
        {
            //persistir datos
            if ($key!=='pass' && $key!=='pass2')
                $camposRegistro[$key]["input_value"] = $_POST[$key];

            //si hay error: mostrarlo y borde rojo
            if (isset($errores[$key]))
            {
                $camposRegistro[$key]["input_class"] = "class='form-control border border-danger'";
                $camposRegistro[$key]["span_error"] = $errores[$key];
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

    <?php foreach ($camposRegistro as $key => $campo): ?>
      <div class="form-group">
          <label for=<?=$key;?>><?=$campo["label_title"];?></label>
          <input id=<?=$key;?> <?=$campo["input_class"];?>
                name=<?=$key;?>
                type=<?=$campo["input_type"];?>
                value=<?=$campo["input_value"];?>>
          <span class="small text-danger"><?=$campo["span_error"];?></span>
      </div>
    <?php endforeach; ?>

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
