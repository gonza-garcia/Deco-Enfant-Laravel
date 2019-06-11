@php
    use App\Category;

    $categories = Category::where('id_parent','=','0')->get();
@endphp

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
      <link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet">
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
      <link rel="stylesheet" href="/css/style.css">
      <link rel="stylesheet" href="/css/style_tabla.css">
      <link rel="stylesheet" href="/css/style_modals.css">
  </head>


  <body>
<!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
<!-- HEADER Y NAVBAR:::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
<!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
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

                          @if ($auth->usuarioLogueado())
                              <a class="pr-1 border-right border-white text-right" href="#">{{$_SESSION["user_name"]}}</a>
                              <a class="pl-1 border-left border-white text-left" href="{{route('logout')}}">Salir</a>
                          @else
                              <a class="pr-1 border-right border-white text-right" href="{{route('login')}}">Iniciar Sesión</a>
                              <a class="pl-1 border-left border-white text-left" href="{{route('registro')}}">Crear Cuenta</a>
                          @endif
                      </div>

                  </div>

                  <!-- Columna Logo --------------------------------------->
                  <div class="col-9 col-xs-8 col-md-4 p-0 my-5 my-md-0 mx-auto">
                      <a href="{{route('/')}}">
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
                      <a class="nav-link py-3" href="{{route('/')}}">inicio</a>
                  </li>

                  <li class="nav-item px-3">
                      <a class="nav-link py-3" href="#dropCats" data-toggle="collapse" aria-haspopup="true" aria-expanded="false">productos</a>
                      <div class="collapse py-2" id="dropCats" data-parent="#navMenu">
                          @foreach ($categories as $cat)
                            <div class="dropdown dropright">

                                <a id={{$cat->id}} class="dropdown-item dropdown-toggle px-2" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> {{$cat->name}} </a>

                          <!-- lista subcategorias de la categoria actual -->
                                @php $sub_categories = Category::where('id_parent','=',$cat->id)->get();
                                @endphp

                                <div id="dropSubCats" class="dropdown-menu" aria-labelledby={{$cat->id}}>
                                    @foreach ($sub_categories as $sub_cat)
                                        <a class="dropdown-item px-2" href="#"> {{$sub_cat->name}} </a>
                                    @endforeach
                                </div>
                            </div>
                          @endforeach
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
                              <a class="dropdown-item px-2" href="{{route('users')}}">Usuarios</a>
                              <a class="dropdown-item px-2" href="{{route('products')}}">Artículos</a>
                          </div>
                      </div>
                  </li>

                  <li class="nav-item d-block d-md-none px-3">
                      <a class="nav-link py-3" href="#menu"><i class="fas fa-bars"></i></a>
                  </li>

              </ul>
          </div>
      </nav>



<!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
<!-- SECCION PRINCIPAL:::::::::::::::::::::::::::::::::::::::::::::::::::::-->
<!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
      @yield("principal")



<!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
<!-- FOOTER :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
<!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
      <footer class="navbar navbar-expand-lg mt-4">
        <div class='container'>
          <div class="row p-4 w-100">


            <!-- COLUMNA NAVEGACION-------------------------------------->
            <div class="footer-nav col-sm-3">
              <div class="border-bottom border-light mr-5">
                <h5 class="footer-title m-0 pb-1">Navegación</h5>
              </div>
              <ul class="p-none pt-2">
                <li><a href="{{route('/')}}">inicio</a></li>
                <li><a href="#about">productos</a></li>
                <li><a href="#novedades">novedades</a></li>
                <li><a href="#contacto">contacto</a></li>
              </ul>
            </div>
            <!-- COLUMNA CONTACTO--------------------------------------->
            <div class="footer-nav col-sm-3">
              <div class="border-bottom border-light mr-5">
                <h5 class="footer-title m-0 pb-1">Contacto</h5>
              </div>
              <ul class="p-none pt-2">
                <li><a href="#whatsapp">+491637325192</a></li>
                <li><a href="#direccion">Elcano 5859, Mar del Plata</a></li>
                <li><a href="#email">gcostoya02@gmail.com</a></li>
              </ul>
            </div>
            <!-- COLUMNA MEDIOS DE PAGO---------------------------------->

            <!-- COLUMNA NEWSLETTER------------------------------------->
          </div>
        </div>
      </footer>

      <div class="d-flex col-12 text-secondary bg-dark">
        <p class="d-flex m-0 mx-auto">Dèco Enfant. Todos los derechos reservados. Mar del plata, Buenos Aires, Argentina.</p>
      </div>




<!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
<!-- SECCION MODALS:::::::::::::::::::::::::::::::::::::::::::::::::::::-->
<!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
      @yield("modals")



<!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
<!-- SCRIPTS DE JAVA DE BOOTSTRAP::::::::::::::::::::::::::::::::::::::::::-->
<!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


      <script type="text/javascript">
          $(document).ready(function(){
          	// Activate tooltip
          	$('[data-toggle="tooltip"]').tooltip();

          	// Select/Deselect checkboxes
          	var checkbox = $('table tbody input[type="checkbox"]');
          	$("#selectAll").click(function(){
          		if(this.checked){
          			checkbox.each(function(){
          				this.checked = true;
          			});
          		} else{
          			checkbox.each(function(){
          				this.checked = false;
          			});
          		}
          	});
          	checkbox.click(function(){
          		if(!this.checked){
          			$("#selectAll").prop("checked", false);
          		}
          	});
          });
      </script>
  </body>
</html>
