<?php

    require_once "./recursos/pdo.php";


    // Traer los articulos que se van a mostrar en Destacados
    $stmt = $db->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 8");
    $stmt->execute();
    $articulos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <title>Dèco Enfant</title>
  <?php include("recursos/head.php") ?>
</head>

<body>

  <!-- HEADER y NAVBAR DE MENUS---------------------------->
  <?php include("recursos/header.php") ?>

  <!--SECCION LANDING---------------------------------------------------------------------------------------------------------->

  <section class="container">

      <!-- FIRST MESSAGE --------------------------------------->
      <div class="row p-3">
          <div id="first-msg" class="d-flex col-12">
              <h2 class="px-0 py-3 m-0 mx-auto text-center">¡ Comprá online y recibí tu producto donde quieras ! <i class="fas fa-truck"></i></h2>
          </div>
      </div>

      <!-- LANDING------------------------------------------------>
      <div id="row-landing" class="row">

          <div id="landing-carousel" class="col-lg-9">
              <img class="img-fluid" src="./img/landing-carousel-01.jpg" alt="banderines">
              <h2 class="p-4 text-center">llegaron los banderines</h2>
          </div>

          <div id="landing-features" class="col-lg-3 pl-lg-0 mt-3 mt-lg-0 d-flex flex-lg-column justify-content-between">

              <div id="feature-one">
                  <img class="img-fluid pr-2 pr-lg-0 pb-lg-1" src="./img/landing-feature-01.jpg" alt="novedades">
                  <h2 class="p-0 text-center">novedades</h2>
              </div>

              <div id="feature-two">
                  <img class="img-fluid pl-2 pl-lg-0 pt-lg-1" src="./img/landing-feature-02.jpg" alt="sale">
                  <h2 class="p-0 m-0 text-center">sale<br>25 & 37 off</h2>
              </div>
          </div>

      </div>

  </section>

  <!--SECCION DESTACADOS---------------------------------------------------------------------------------------------------------->
  <section class="container">

      <div class="text-center pt-4">
          <h2 class="my-0 mx-auto w-100 text-uppercase"><img src="./img/icon-paper-plane.png">destacados</h2>
          <hr>
      </div>

      <div class="row px-2">

        <!--- Generar Articulos ------------->
          <?php foreach ($articulos as $key => $articulo): ?>
              <article class="col-6 col-md-4 col-lg-3 p-1">
                  <img class="img-fluid img-thumbnail destacados-img"
                  src=<?=$articulo["thumbnail"]?> alt=<?= $articulo["title"]?>>

                  <div class="d-flex flex-wrap align-items-center justify-content-between">
                      <div id="descrip-item" class="col-12 col-lg-8 d-flex align-items-center p-2"><?= $articulo["short_desc"]?></div>
                      <div class="col-12 col-lg-4 p-1">
                          <button id="btn-destacados" class="btn text-uppercase p-0 w-100 py-2">ver más
                          </button>
                      </div>
                  </div>
                  <hr class="m-3">
              </article>
          <?php endforeach; ?>

      </div>

  </section>




  <!-- FOOTER -------------------------------------------------------->
  <?php include("recursos/footer.php") ?>

  <!-- SCRIPTS DE JAVA DE BOOTSTRAP---------------------------------->
  <?php include("recursos/scriptsJava.php") ?>

</body>

</html>
