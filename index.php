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
            <!-- <h3>sale <br>25&#37 off</h3> -->
            <h3>sale <br>25&#37 off</h3>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--SECCION DESTACADOS----------------------------------------------------------------------------------------------------------->

  <section class="destacados">
    <div class="container">
      <div class="destacados-titulos">
        <h2 class="titulos"><img src="https://img.icons8.com/doodle/48/000000/paper-plane.png"> destacados</h2>
        <hr>
      </div>
      <div class="row">
        <article class="col-md-3 col-sm-6 descatados-item">
          <img class="img-fluid descatados-img" src="./img/Almohadones_Tusor_Pack_x3.jpg" alt="Almohadon Tusor">
          <div class="dest-item-descrip">
            <div class="descrip-item">Almohadón de Tusor 40x40</div>
            <button class="btn btn-destacados btn-block">ver mas</button>
          </div>
          <hr>
        </article>
        <article class="col-md-3 col-sm-6">
          <img class="img-fluid" src="./img/Banquito_Nordico_funda_Pelo.jpg" alt="Banquito Nordico">
          <div class="dest-item-descrip">
            <div class="descrip-item">Mini Banco Nórdico </div>
            <button class="btn btn-destacados">ver mas</button>
          </div>
          <hr>
        </article>
        <article class="col-md-3 col-sm-6">
          <img class="img-fluid" src="./img/Puff_Pequeno.jpg" alt="Puff_Pequeno">
          <div class="dest-item-descrip">
            <div class="descrip-item">Puff Pequeño</div>
            <button class="btn btn-destacados">ver mas</button>
          </div>
          <hr>
        </article>
        <article class="col-md-3 col-sm-6">
          <img class="img-fluid" src="./img/Bolsas_de_dormir.jpg" alt="Bolsas_de_dormir">
          <div class="dest-item-descrip">
            <div class="descrip-item">Bolsas de Dormir</div>
            <button class="btn btn-destacados">ver mas</button>
          </div>
          <hr>
        </article>
        <article class="col-md-3 col-sm-6">
          <img class="img-fluid" src="./img/Almohadon_Conejo.jpg" alt="Almohadon_Conejo">
          <div class="dest-item-descrip">
            <div class="descrip-item">Almohadón Conejo</div>
            <button class="btn btn-destacados">ver mas</button>
          </div>
          <hr>
        </article>
        <article class="col-md-3 col-sm-6">
          <img class="img-fluid" src="./img/Sillon_mimbre_2_cuerpos.jpg" alt="Sillon_mimbre_2_cuerpos">
          <div class="dest-item-descrip">
            <div class="descrip-item">Sillon de Mimbre 2 cuerpos</div>
            <button class="btn btn-destacados">ver mas</button>
          </div>
          <hr>
        </article>
        <article class="col-md-3 col-sm-6">
          <img class="img-fluid" src="./img/Almohadon_con_Conejo_Blue.jpg" alt="Almohadon_con_Conejo_Blue">
          <div class="dest-item-descrip">
            <div class="descrip-item">Almohadón de Tusor Estampado</div>
            <button class="btn btn-destacados btn-block">ver mas</button>
          </div>
          <hr>
        </article>
        <article class="col-md-3 col-sm-6">
          <img class="img-fluid" src="./img/Puff_Grande.jpg" alt="Puff_Grande">
          <div class="dest-item-descrip">
            <div class="descrip-item">Puff Grande</div>
            <button class="btn btn-destacados">ver mas</button>
          </div>
          <hr>
        </article>
      </div>
    </div>
  </section>




  <!-- FOOTER -------------------------------------------------------->
<?php include("recursos/footer.php") ?>


  <!-- SCRIPTS DE JAVA ---------------------------------------------->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
