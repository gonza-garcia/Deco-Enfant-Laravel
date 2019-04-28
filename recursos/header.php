<?php

  $headerMenu = buscarObjeto("recursos/db.json","headerMenu");

?>


<!DOCTYPE html>
<!-- HEADER Busqueda, Logo y Autenticacion -------------------------------------------------------------------->
<header class="navbar navbar-expand-md py-4">
  <div class='container p-1'>
    <!-- FILA única ----------------------------------------->
    <div class="row justify-content-between align-items-center">
      <!-- Columna Busqueda ----------------------------------->
      <form id='formBuscar' class="col-5 col-md-3 form-inline justify-content-center p-1">
        <input class="form-control w-100 pr-4 py-0" type="search" placeholder="Buscar" aria-label="Buscar">
        <a href="#" class="pr-2"><i class="fas fa-search"></i></a>
      </form>

      <!-- Columna CARRITO Y AUTENTICACION --------------------->
      <div class="col-7 col-md-3 justify-content-end d-flex d-md-block p-2 order-md-last">
        <!--  CARRITO------------------------->
        <a id='carrito' class="justify-content-center d-inline-flex d-md-flex ml-1" href="#carrito">
          <i class="mr-1 fas fa-shopping-cart"></i>
          <span>Carrito (0)</span>
        </a>
        <!-- AUTENTICACION-------------------->
        <div id='autenticacion' class='justify-content-center d-inline-flex d-md-flex p-0 order-first my-auto'>
          <?php if (isset($_SESSION["email"])) : ?>
            <a class="pr-1 border-right border-white text-right" href="#">Hola, <?=$_SESSION["email"]?></a>
            <a class="pl-1 border-left border-white text-left" href="./logout.php">Salir</a>
          <?php else : ?>
            <a class="pr-1 border-right border-white text-right" href="./login.php">Iniciar Sesión</a>
            <a class="pl-1 border-left border-white text-left" href="./registro.php">Crear Cuenta</a>
          <?php endif; ?>
        </div>
      </div>

      <!-- Columna Logo --------------------------------------->
      <div class="col-9 col-xs-8 col-md-4 p-0 my-5 my-md-0 mx-auto">
        <a href="./index.php">
          <img class="img-fluid" src="./img/Logos/Logo_on_transparent_background/logoCustomGonza-gris.png" alt="logo">
        </a>
      </div>
    </div>
  </div>
</header>

<!-- NAVBAR De Menus --------------------------------------------->
<nav id='menu' class="navbar navbar-expand-md mb-4 p-1">
  <div class="container justify-content-center py-0">
    <ul class="navbar-nav d-flex flex-row py-0">
      <!-- <li class="nav-item"><a class="nav-link" href="./index.php">inicio</a></li>
      <li class="nav-item"><a class="nav-link" href="#about">productos</a></li>
      <li id="liNovedades" class="nav-item d-none"><a class="nav-link" href="#novedades">novedades</a></li>
      <li class="nav-item d-none d-md-block"><a class="nav-link" href="#contacto">contacto</a></li>
      <li class="nav-item d-lg-none"><a class="nav-link" href="#menu"><i class="fas fa-bars"></i></a></li> -->

      <?php foreach ($headerMenu as $key => $value): ?>
        <li <?=$value["parametros"];?>>
            <a class="nav-link py-3" href=<?=$value["href"];?>><?=$key;?></a>
        </li>
      <?php endforeach; ?>

    </ul>
  </div>
</nav>
