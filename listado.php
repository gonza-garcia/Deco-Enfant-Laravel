<?php
  require_once "recursos/funciones.php";

  if(!usuarioLogueado()){
    header("Location:index.php");
    exit;
  }
  $usuarios = listaDeUsuarios()["usuarios"];
  $usuario = traerUsuarioLogueado();

  //Dump de errores;
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

        <!-- <div class="nav-scroller py-1 mb-2">
          <nav class="nav d-flex justify-content-between">
            <a class="p-2 text-muted" href="#">World</a>
            <a class="p-2 text-muted" href="#">U.S.</a>
            <a class="p-2 text-muted" href="#">Technology</a>
            <a class="p-2 text-muted" href="#">Design</a>
            <a class="p-2 text-muted" href="#">Culture</a>
            <a class="p-2 text-muted" href="#">Business</a>
            <a class="p-2 text-muted" href="#">Politics</a>
            <a class="p-2 text-muted" href="#">Opinion</a>
            <a class="p-2 text-muted" href="#">Science</a>
            <a class="p-2 text-muted" href="#">Health</a>
            <a class="p-2 text-muted" href="#">Style</a>
            <a class="p-2 text-muted" href="#">Travel</a>
          </nav>
        </div> -->
        <div class="row">
          <div class="col">
            <h2>Listado de usuarios registrados</h2>
            <table class="table">
              <thead>
                <tr>
                  <!-- <th scope="col">#</th> -->
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
                  <!-- <td><?= $datos["id"] ?></td> -->
                  <td><?= $datos["nombre"] ?></td>
                  <td><?= $datos["apellido"] ?></td>
                  <td><?= $datos["phone"] ?></td>
                  <td><?= $datos["email"] ?></td>
                  <!-- <td><a class="btn btn-primary btn-sm" href="<?= 'edit.php?id=' . $datos["id"] ?>">Editar</a></td> -->
                </tr>
              <?php endforeach; ?>
              </tbody>

            </table>
          </div>
        </div>
      </div>





    <!-- FOOTER -------------------------------------------------------->
    <?php include("recursos/footer.php") ?>

    <!-- SCRIPTS DE JAVA DE BOOTSTRAP---------------------------------->
    <?php include("recursos/scriptsJava.php") ?>

  </body>
</html>
