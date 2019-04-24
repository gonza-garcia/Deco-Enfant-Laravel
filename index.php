<?php

  require_once("recursos/funciones.php");

  $articulos = buscarObjeto("recursos/db.json","articulos");

  $articulos = ordenarArray('vendidos', SORT_DESC, SORT_NUMERIC, $articulos);

  $counter = 0;

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


  <!-- FIRST MESSAGE ---------------------------------------------------------------------------------------------------------->
  <div id="first-msg" class="container px-3">
      <h2 id="msg-text">¡ Comprá online y recibí tu producto donde quieras ! <i class="fas fa-truck"></i></h2>
  </div>

  <!-- LANDING------------------------------------------------------------------------------------------------------------------>
  <div class="home-landing">
    <div class="container">
      <div class="landing-carousel">
        <img src="https://scontent.faep8-2.fna.fbcdn.net/v/t1.0-9/53517189_2345018265510441_2876957437766664192_o.jpg?_nc_cat=100&_nc_ht=scontent.faep8-2.fna&oh=a975c64c095eda2a3c7d7afdcef00285&oe=5D0B89BF" alt="banderines" class="carousel-img">
        <h2>llegaron los banderines</h2>
      </div>
      <div class="landing-features">
        <div class="feature-one">
          <div class="feature-img">
            <img src="./img/general_04.jpg" alt="novedades" class="feature-img-one">
          </div>
          <div class="feature-title">
            <h3>novedades</h3>
          </div>
        </div>
        <div class="feature-two">
          <div class="feature-img">
            <img src="./img/general_03.jpg" alt="sale" class="feature-img-two">
          </div>
          <div class="feature-title">
            <h3>sale <br>25 & 37 off</h3>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--SECCION DESTACADOS----------------------------------------------------------------------------------------------------------->
  <section class="destacados">
    <div class="container">

      <div class="destacados-titulos">
        <h2 class="titulos"><img src="https://img.icons8.com/doodle/48/000000/paper-plane.png">destacados</h2>
        <hr>
      </div>

      <div class="row">
        <!--- Generar Articulos ------>
        <?php foreach ($articulos as $key => $articulo): ?>
          <article class="col-md-3 col-sm-6 descatados-item">
            <img class="img-fluid descatados-img" src=<?= $articulo["imagen"]?> alt=<?= $articulo["titulo"]?>>
            <div class="dest-item-descrip">
              <div class="descrip-item pr-1"><?= $articulo["titulo"]?></div>
              <button class="btn btn-destacados btn-block">ver más</button>
            </div>
            <hr>
          </article>
        <?php
            $counter++;
            if ($counter===8){    //Corta a los 8 artículos
              $counter = 0;
              break;
            }?>
        <?php endforeach; ?>
      </div>

    </div>
  </section>




  <!-- FOOTER -------------------------------------------------------->
  <?php include("recursos/footer.php") ?>

  <!-- SCRIPTS DE JAVA DE BOOTSTRAP---------------------------------->
  <?php include("recursos/scriptsJava.php") ?>

</body>

</html>
