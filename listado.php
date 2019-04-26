<?php
  require_once "recursos/funciones.php";

  if(!usuarioLogueado()){
    header("Location:index.php");
    exit;
  }
  $usuarios = listaDeUsuarios()["usuarios"];
  $usuario = traerUsuarioLogueado();

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Deco Enfant</title>
    <?php include("recursos/head.php") ?>
    <title></title>
  </head>
  <body>

    <!-- HEADER y NAVBAR DE MENUS---------------------------->
    <?php include("recursos/header.php") ?>

    <div class="container">
    <h2>Listado de usuarios registrados</h2>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Telefono</th>
            <th scope="col">Email</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($usuarios as $datos): ?>
          <tr>
            <td><?= $datos["id"] ?></td>
            <td><?= $datos["nombre"] ?></td>
            <td><?= $datos["apellido"] ?></td>
            <td><?= $datos["phone"] ?></td>
            <td><?= $datos["email"] ?></td>
            <td><a class="btn btn-primary btn-sm" href="<?= 'edit.php?id=' . $datos["id"] ?>">Editar</a></td>
          </tr>
        <?php endforeach; ?>
        </tbody>

      </table>
    </div>





    <!-- FOOTER -------------------------------------------------------->
    <?php include("recursos/footer.php") ?>

    <!-- SCRIPTS DE JAVA DE BOOTSTRAP---------------------------------->
    <?php include("recursos/scriptsJava.php") ?>

  </body>
</html>
