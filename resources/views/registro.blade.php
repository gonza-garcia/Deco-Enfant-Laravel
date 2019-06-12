@extends ("recursos/template_main")


@section("titulo")
    Dèco Enfant - Registro
@endsection


@section("principal")
    <!-- FORM DE REGISTRO------------------------------------------------------------------------------------------------------->
    <form class="col-sm-10 offset-sm-1 col-md-6 offset-md-3 col-lg-4 offset-lg-4" action="{{ route('registro')}}" method="POST" enctype="multipart/form-data">
        @csrf
                        <!-- User Name-->
        <div class="form-group">
            <label for="user_name">Usuario *</label>
            <input id="user_name" class="form-control"
                  name="user_name"
                  type="text"
                  value="{{$user_nameOk}}"
                  placeholder="Ingrese su nombre de usuario aqui ...">
            @if (isset($errores["user_name"]))
                <span class="small text-danger">{{$errores["user_name"]}}</span>
            @endif
        </div>
                        <!-- Nombre-->
        <div class="form-group">
            <label for="first_name">Nombre *</label>
            <input id="first_name" class="form-control"
                  name="first_name"
                  type="text"
                  value="{{$first_nameOk}}"
                  placeholder="Ingrese su nombre aqui ...">
            @if (isset($errores["first_name"]))
              <span class="small text-danger">{{$errores["first_name"]}}</span>
            @endif
        </div>
                        <!-- Apellido-->
        <div class="form-group">
            <label for="last_name">Apellido *</label>
            <input id="last_name" class="form-control"
                  name="last_name"
                  type="text"
                  value="{{$last_nameOk}}"
                  placeholder="Ingrese su apellido aqui...">
            @if (isset($errores["last_name"]))
                <span class="small text-danger">{{$errores["last_name"]}}</span>
            @endif
        </div>
                        <!-- Fecha De Nacimiento-->
        <div class="form-group">
            <label for="date_of_birth">Fecha de nacimiento</label>
            <input id="date_of_birth" class="form-control"
                  name="date_of_birth"
                  type="text"
                  value="{{$date_of_birthOk}}"
                  placeholder="Ingrese su fecha de nacimiento aqui...">
            @if (isset($errores["date_of_birth"]))
                <span class="small text-danger">{{$errores["date_of_birth"]}}</span>
            @endif
        </div>
                        <!-- Telefono-->
        <div class="form-group">
            <label for="phone">Telefono</label>
            <input id="phone" class="form-control"
                  name="phone"
                  type="text"
                  value="{{$phoneOk}}"
                  placeholder="Ingrese su telefono aqui...">
            @if (isset($errores["phone"]))
                <span class="small text-danger">{{$errores["phone"]}}</span>
            @endif
        </div>
                        <!-- E-Mail-->
        <div class="form-group">
            <label for="email">E-Mail *</label>
            <input id="email" class="form-control"
                  name="email"
                  type="email"
                  value="{{$emailOk}}"
                  placeholder="Ingrese su email aqui...">
            @if (isset($errores["email"]))
                <span class="small text-danger">{{$errores["email"]}}</span>
            @endif
        </div>
                        <!-- Contraseña-->
        <div class="form-group">
            <label for="password">Contraseña *</label>
            <input id="password" class="form-control"
                  name="password"
                  type="password"
                  placeholder="Ingrese su contraseña aqui...">
            @if (isset($errores["password"]))
                <span class="small text-danger">{{$errores["password"]}}</span>
            @endif
        </div>
                        <!-- Repetir Contraseña-->
        <div class="form-group">
            <label for="password2">Repetir Contraseña *</label>
            <input id="password2" class="form-control"
                  name="password2"
                  type="password"
                  placeholder="Repita su contraseña aqui...">
            @if (isset($errores["password2"]))
                <span class="small text-danger">{{$errores["password2"]}}</span>
            @endif
        </div>
                        <!-- Botón Enviar -->
        <div class="form-group">
            <button type="submit" class="btn btn-light" name="formulario" value="registro">Registrarme</button>
            <button type="reset" class="btn btn-outline-primary">Limpiar</button>
        </div>
    </form>
@endsection


@section("modals")

@endsection
