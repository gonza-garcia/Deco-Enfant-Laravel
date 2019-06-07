<?php

    require_once "./recursos/pdo.php";
    require_once "./init.php";

    // Traer todas las categorias
    $stmt = $db->prepare("SELECT * FROM categories WHERE id_parent = 0");
    $stmt->execute();
    $all_categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<!-- HEADER Busqueda, Logo y Autenticacion -------------------------------------------------------------------->
<header class="navbar navbar-expand-md pb-0 py-md-4">
    <div class='container'>
        <!-- FILA única ----------------------------------------->
        <div class="row justify-content-between align-items-center">
            <!-- Columna Busqueda ----------------------------------->
            <form id='formBuscar' class="col-5 col-md-3 form-inline justify-content-center pl-0" action="./tabla.php" method="GET">
                <input class="form-control w-100 pr-4 py-0" type="search" placeholder="Buscar" aria-label="Buscar">
                <a type="submit" href="#"><i class="fas fa-search"></i></a>
            </form>

            <!-- Columna CARRITO Y AUTENTICACION --------------------->
            <div class="col-7 col-md-3 justify-content-end d-flex d-md-block order-md-last pr-0">

                <!--  CARRITO------------------------->
                <a id='carrito' class="justify-content-center d-inline-flex d-md-flex ml-1 ml-md-0" href="#carrito">
                    <i class="mr-1 fas fa-shopping-cart"></i>
                    <span>Carrito (0)</span>
                </a>

                <!-- AUTENTICACION-------------------->
                <div id='autenticacion' class='justify-content-center d-inline-flex d-md-flex p-0 order-first my-auto'>

                    <?php if ($auth->usuarioLogueado()) : ?>
                        <a class="pr-1 border-right border-white text-right" href="#"><?=$_SESSION["user_name"]?></a>
                        <a class="pl-1 border-left border-white text-left" href="./logout.php">Salir</a>
                    <?php else : ?>
                        <a class="pr-1 border-right border-white text-right" href="<?='./login.php'?>">Iniciar Sesión</a>
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
<nav id='navMenu' class="navbar navbar-expand-md p-1 mb-4">
    <div class="container justify-content-center py-0">
        <ul class="navbar-nav d-flex flex-row py-0">

            <li class="nav-item d-none d-md-block px-3">
                <a class="nav-link py-3" href="./index.php">inicio</a>
            </li>

            <li class="nav-item px-3">
                <a class="nav-link py-3" href="#dropCats" data-toggle="collapse" aria-haspopup="true" aria-expanded="false">productos</a>
                <div class="collapse py-2" id="dropCats" data-parent="#navMenu">
                    <?php foreach ($all_categories as $cat) : ?>
                      <div class="dropdown dropright">

                          <a id=<?=$cat["id"]?> class="dropdown-item dropdown-toggle px-2" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <?=$cat["name"]?> </a>

                    <!-- lista subcategorias de la categoria actual -->
                          <div id="dropSubCats"class="dropdown-menu" aria-labelledby=<?=$cat["id"]?>>
                              <?php
                                  $stmt = $db->prepare("SELECT * FROM categories WHERE id_parent = :id");
                                  $stmt->bindValue(":id", $cat["id"]);
                                  $stmt->execute();
                                  $sub_cats = $stmt->fetchAll(PDO::FETCH_ASSOC);
                              ?>
                              <?php foreach ($sub_cats as $subCat) : ?>
                                  <a class="dropdown-item px-2" href="#"> <?=$subCat["name"]?> </a>
                              <?php endforeach; ?>
                          </div>
                      </div>
                    <?php endforeach; ?>
                </div>
            </li>

            <li class="nav-item d-none d-md-block px-3">
                <a class="nav-link py-3" href="#novedades">novedades</a>
            </li>

            <li class="nav-item d-none d-md-block px-3">
                <a class="nav-link py-3" href="#contacto">contacto</a>
            </li>

            <li class="nav-item d-none d-md-block px-3">
                <a class="nav-link py-3" href="#admin" data-toggle="collapse" aria-haspopup="true" aria-expanded="false">administrar</a>
                <div class="collapse py-2" id="admin" data-parent="#navMenu">
                    <div>
                        <a class="dropdown-item px-2" href="./usuarios.php">Usuarios</a>
                        <a class="dropdown-item px-2" href="./articulos.php">Artículos</a>
                    </div>
                </div>
            </li>

            <li class="nav-item d-block d-md-none px-3">
                <a class="nav-link py-3" href="#menu"><i class="fas fa-bars"></i></a>
            </li>

        </ul>
    </div>
</nav>
