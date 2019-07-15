<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <title>
      @yield("titulo")
  </title>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Fuentes Custom---------------------------------------------->
  {{-- <link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet"> --}}
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Sacramento&amp;subset=latin-ext" rel="stylesheet">


  <!-- REVISARRR ESTE ICONO -->
  <a href="https://icons8.com/icon/80664/paper-plane"></a>

  <!-- Bootstrap CDN, Google Fonts, Font Awesome------------------->
  <link href="https://fonts.googleapis.com/css?family=Lato|Montserrat:400,700" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


  <!-- Hojas de Estilo-------------------------------------------->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>


  <link rel="stylesheet" href="{{asset('css/style.css')}}">

  <script src="{{asset('js/buscarProd.js')}}"></script>

  @yield('custom_css')

</head>


<body>
<!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
<!-- :::::::::::::::::::::::::::::::HEADER:::::::::::::::::::::::::::::::::-->
<!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
  <header class="navbar navbar-expand-md pb-0 py-md-4">
      <div class='container'>
          <!-- FILA única ----------------------------------------->
          <div class="row justify-content-between align-items-center">

          <!-- COLUMNA 1   BUSQUEDA:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
              <form id='formBuscar' class="col-5 col-md-3 form-inline justify-content-center pl-0" action="/productos/buscar" method='GET'>
                  <input class='d-none' type="text">
                  <input id='buscador' class="form-control w-100 pr-4 py-0" type="search" placeholder="Buscar" aria-label="Buscar" name='palabra'>

                  <a id='submit_buscador' type="submit" href="#"><i class="fas fa-search"></i></a>
              </form>

          <!-- COLUMNA 2   CARRITO Y AUTENTICACION::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
              <div class="col-7 col-md-3 justify-content-end d-flex d-md-block order-md-last pr-0">

              <!-- ::::::::::::::::::::::::::::::CARRITO::::::::::::::::::::::::::::::::::-->
                  <a id='carrito' class="justify-content-center d-inline-flex d-md-flex ml-1 ml-md-0" href="/cart">
                      <i class="mr-1 fas fa-shopping-cart"></i>
                      <span>Carrito</span>
                  </a>

              <!-- ::::::::::::::::::::::::::::::AUTENTICACION::::::::::::::::::::::::::::::::::-->
                  <div id='autenticacion' class='justify-content-center d-inline-flex d-md-flex p-0 order-first my-auto'>
                    @if (Route::has('login'))
                        <div class="top-right links">
                            @auth
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @else
                                <a href="{{ route('login') }}">INICIAR SESIÓN</a> |
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}">CREAR CUENTA</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                  </div>

              </div>

          <!-- COLUMNA 3   LOGO::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
              <div class="col-9 col-xs-8 col-md-4 p-0 my-5 my-md-0 mx-auto">
                  <a href="/">
                      <img class="img-fluid" src="/img/Logos/Logo_on_transparent_background/logoCustomGonza-gris.png" alt="logo">
                  </a>
              </div>
          </div>

      </div>
  </header>

  <div class="container mt-0 mb-4" id='resultados' style="display: none;">
      <h1 id='error'></h1>
      <div class='row p-0'>
          <ul class="d-flex flex-column justify-content-between col-4" id='resultados_1'></ul>
          <ul class="d-flex flex-column justify-content-between col-4" id='resultados_2'></ul>
          <ul class="d-flex flex-column justify-content-between col-4" id='resultados_3'></ul>
      </div>
  </div>


<!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
<!-- ::::::::::::::::::::::::::::::NAVBAR::::::::::::::::::::::::::::::::::-->
<!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->

  <nav id='navMenu' class="navbar navbar-expand-md p-1 mb-4">
      <div class="container justify-content-center py-0">

          <ul class="navbar-nav d-flex flex-row py-0">

              {{-- <li class="nav-item d-none px-3">
                <a id='link_resultados' class="nav-link py-0" href="#resultados" data-toggle="collapse" aria-haspopup="true" aria-expanded="false"></a></li> --}}

              <li class="nav-item d-none d-md-block px-3">
                <a class="nav-link py-0" href="/">
                  inicio</a></li>

              <li class="nav-item d-block px-3">
                <a class="nav-link py-0" href="/productos">
                  productos</a></li>

              <li class="nav-item d-none d-md-block px-3">
                <a class="nav-link py-0" href="/sale">
                  ofertas</a></li>

              <li class="nav-item d-none d-md-block px-3">
                <a class="nav-link py-0" href="/contacto">
                  contacto</a></li>

              @auth
                @if (Auth::user()->role_id == 1)
                    <li class="nav-item d-none d-md-block px-3   ">
                        <a class="nav-link py-0" href="#admin" data-toggle="collapse" aria-haspopup="true" aria-expanded="false">
                          Administrar</a>
                        <div class="collapse py-2" id="admin" data-parent="#navMenu">
                            <div class="dropdown dropright">
                                <a class="dropdown-item px-2" href="admin/products" aria-haspopup="true" aria-expanded="false">
                                  Productos</a>
                                <a class="dropdown-item px-2" href="admin/users" aria-haspopup="true" aria-expanded="false">
                                  Usuarios</a>
                                <a class="dropdown-item px-2" href="admin/carts" aria-haspopup="true" aria-expanded="false">
                                  Carritos</a>
                                <a class="dropdown-item px-2" href="admin/categories" aria-haspopup="true" aria-expanded="false">
                                  Categorías</a>
                                <a class="dropdown-item px-2" href="admin/subcategories" aria-haspopup="true" aria-expanded="false">
                                  Subcategorías </a>
                                <a class="dropdown-item px-2" href="admin/countries" aria-haspopup="true" aria-expanded="false">
                                  Países </a>
                                <a class="dropdown-item px-2" href="admin/provinces" aria-haspopup="true" aria-expanded="false">
                                  Provincias </a>
                                <a class="dropdown-item px-2" href="admin/colors" aria-haspopup="true" aria-expanded="false">
                                  Colores</a>
                                <a class="dropdown-item px-2" href="admin/sizes" aria-haspopup="true" aria-expanded="false">
                                  Tamaños </a>
                                <a class="dropdown-item px-2" href="admin/roles" aria-haspopup="true" aria-expanded="false">
                                  Roles </a>
                                <a class="dropdown-item px-2" href="admin/sexes" aria-haspopup="true" aria-expanded="false">
                                  Sexos </a>
                                <a class="dropdown-item px-2" href="admin/user_statuses" aria-haspopup="true" aria-expanded="false">
                                  Estados De Usuario </a>
                                <a class="dropdown-item px-2" href="admin/order_statuses" aria-haspopup="true" aria-expanded="false">
                                  Estados De Carrito</a>
                            </div>
                        </div>
                    </li>
                @endif
              @endauth

              <li class="nav-item d-block d-md-none px-3">
                  <a class="nav-link py-3" href="#menu" data-toggle="collapse" aria-haspopup="true" aria-expanded="false"><i class="fas fa-bars"></i></a>

                  <div class="collapse py-2" id='menu' data-parent="#navMenu">
                      <div class="dropdown dropright">
                          <a class="dropdown-item px-2" href="/" aria-haspopup="true" aria-expanded="false"> Inicio</a>
                          <a class="dropdown-item px-2" href="/productos" aria-haspopup="true" aria-expanded="false"> Productos </a>
                          <a class="dropdown-item px-2" href="/sale" aria-haspopup="true" aria-expanded="false"> Ofertas </a>
                          <a class="dropdown-item px-2" href="/contacto" aria-haspopup="true" aria-expanded="false"> Contacto </a>
                          @auth
                            @if (Auth::user()->role_id == 1)
                                <a class="dropdown-item px-2" href="admin/products" aria-haspopup="true" aria-expanded="false"> Administrar </a>
                            @endif
                          @endauth
                      </div>
                  </div>
              </li>
          </ul>

      </div>
  </nav>


<!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
<!-- SECCION PRINCIPAL:::::::::::::::::::::::::::::::::::::::::::::::::::::-->
<!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
  @yield("principal")


  @yield("links")


<!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
<!-- FOOTER :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
<!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
  <footer class="navbar navbar-expand-lg mt-4">
      <div class='container'>
          <div class="row p-1 w-100">

          <!-- COLUMNA 1   NAVEGACION::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
              <div class="footer-nav col-sm-3 p-0">
                  <div class="border-bottom border-light mr-5">
                      <h5 class="footer-title m-0 pb-1">Navegación</h5>
                  </div>
                  <ul class="p-none pt-2">
                      <li><a href="/">Inicio</a></li>
                      <li><a href="/productos">Productos</a></li>
                      <li><a href="/sale">Sale</a></li>
                  </ul>
              </div>
          <!-- COLUMNA 2   CONTACTO::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
              <div class="footer-nav col-sm-3 p-0">
                  <div class="border-bottom border-light mr-5">
                      <h5 class="footer-title m-0 pb-1">Contacto</h5>
                  </div>
                  <ul class="p-none pt-2">
                      <li><a href="#phone"><i class="fas fa-mobile-alt"></i> +49 163 7325192</a></li>
                      <li><a href="#direccion"><i class="fas fa-map-pin"></i> Elcano 5859 - Mar del Plata</a></li>
                      <li><a href="#email"><i class="fa fa-envelope"></i> gcostoya02@gmail.com</a></li>
                  </ul>
              </div>
        <!-- COLUMNA 3   SOCIAL:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
              <div class="footer-nav col-sm-3 p-0">
                  <div class="border-bottom border-light mr-5">
                      <h5 class="footer-title m-0 pb-1">Social</h5>
                  </div>
                  <ul class="p-none pt-2">
                      <li><a href="https://www.instagram.com/decoenfant_/"><i class="fab fa-instagram"></i> Instagram</a></li>
                      <li><a href="https://www.facebook.com/decoenfant0/"><i class="fab fa-facebook"></i> Facebook</a></li>
                      <li><a href="#whatsapp"><i class="fab fa-whatsapp"></i> Whatsapp</a></li>
                  </ul>
              </div>

        <!-- COLUMNA 4   NEWSLETTER:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
              <div class="footer-nav col-sm-3 p-0">
                  <div class="border-bottom border-light mr-5">
                      <h5 class="footer-title m-0 pb-1">Newsletter</h5>
                  </div>
                  <form>
                      <p class="p-none pt-2 text-white mb-1">Suscribite a nuestra newsletter:</p>
                      <div class="input-group">
                          <input class="form-control w-75 border-white" type="email" placeholder="Email" required>
                          <button class="btn btn-sm text-white mt-2 border-white">Suscribirme</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </footer>

  <div class="d-flex col-12 text-secondary bg-dark">
      <p class="d-flex m-0 mx-auto">Dèco Enfant. Todos los derechos reservados. Mar del plata, Buenos Aires, Argentina.</p>
  </div>


<!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
<!-- ::::::::::::::::::::::::::::MODALS::::::::::::::::::::::::::::::::::::-->
<!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->

@yield('modals')


{{-- <!-- :::::::::::::::::::::::::::::::: ADD Modal HTML ::::::::::::::::::::::::::::::::::::-->
<!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->



<div id="add_modal_form" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            @yield()

        </div>
    </div>
</div>


<!-- :::::::::::::::::::::::::::::::: EDIT Modal HTML :::::::::::::::::::::::::::::::::::-->
<!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
<div class="container">
    <div id="edit_modal_form" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">

            </div>
        </div>
    </div>
</div>


<!-- :::::::::::::::::::::::::::::::: DELETE Modal HTML :::::::::::::::::::::::::::::::::-->
<!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
<div id="delete_modal_form" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
    </div>
</div> --}}


<!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
<!-- SCRIPTS DE JAVA DE BOOTSTRAP::::::::::::::::::::::::::::::::::::::::::-->
<!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>


  @yield("custom_js")


</body>
</html>
