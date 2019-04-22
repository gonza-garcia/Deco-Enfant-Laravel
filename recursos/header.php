<?php
  // debo crear la sesion
  if (!isset($_SESSION)) {
    session_start();
  }

  $headerMenu = buscarObjeto("recursos/db.json","headerMenu");


?>


<!DOCTYPE html>
<!-- HEADER Busqueda, Logo y Autenticacion -------------------------------------------------------------------->
<header class="navbar navbar-expand-md py-4">
  <div class='container p-0'>
    <!-- FILA única ----------------------------------------->
    <div class="row justify-content-between align-items-center">
      <!-- Columna Busqueda ----------------------------------->
      <form id='formBuscar' class="col-lg-3 col-md-3 order-last order-md-first form-inline justify-content-center p-3 pr-md-0">
        <input id='inputBuscar' class="form-control" type="search" placeholder="Buscar" aria-label="Buscar">
        <a href="#" class="pr-3 p-md-0"><i class="fas fa-search pr-1"></i></a>
      </form>

      <!-- Columna Logo --------------------------------------->
      <div id="coluLogo" class="col-lg-6 col-md-6 text-center my-3 my-md-0 p-0">
        <a href="./index.php">
          <img class="img-fluid" src="./img/Logos/Logo_on_transparent_background/logoCustomGonza-gris.png" alt="logo">
        </a>
      </div>

      <!-- Columna CARRITO Y AUTENTICACION --------------------->
      <div class="col-lg-3 col-md-3 order-first order-md-last justify-content-between d-flex d-md-block p-3 pl-md-0">
        <!--  CARRITO------------------------->
        <a id='carrito' class="justify-content-center d-inline-flex d-md-flex" href="#carrito">
          <i class="mr-1 fas fa-shopping-cart"></i>
          <span>Carrito (0)</span>
        </a>
        <!-- AUTENTICACION-------------------->
        <div id='autenticacion' class='justify-content-center d-inline-flex d-md-flex pt-1'>
          <?php if (isset($_SESSION["nombre"])) : ?>
            <a class="login pr-1 border-right border-white text-right" href="#"><?=$_SESSION["nombre"]?></a>
            <a class="pl-1 border-left border-white text-left" href="./logout.php">Salir</a>
          <?php else : ?>
            <a class="login pr-1 border-right border-white text-right" href="./login.php">Iniciar Sesión</a>
            <a class="pl-1 border-left border-white text-left" href="./registro.php">Crear Cuenta</a>
          <?php endif; ?>
        </div>

      </div>
    </div>
  </div>
</header>

<!-- NAVBAR De Menus --------------------------------------------->
<nav id='menu' class="navbar navbar-expand-md mb-4">
  <div class="container justify-content-center">
    <ul class="navbar-nav d-flex flex-row">
      <!-- <li class="nav-item"><a class="nav-link" href="./index.php">inicio</a></li>
      <li class="nav-item"><a class="nav-link" href="#about">productos</a></li>
      <li id="liNovedades" class="nav-item d-none"><a class="nav-link" href="#novedades">novedades</a></li>
      <li class="nav-item d-none d-md-block"><a class="nav-link" href="#contacto">contacto</a></li>
      <li class="nav-item d-lg-none"><a class="nav-link" href="#menu"><i class="fas fa-bars"></i></a></li> -->

      <?php foreach ($headerMenu as $key => $value): ?>
        <li <?=$value["parametros"];?>>
            <a class="nav-link" href=<?=$value["href"];?>><?=$key;?></a>
        </li>
      <?php endforeach; ?>

    </ul>
  </div>
</nav>
