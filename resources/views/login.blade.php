@extends("recursos/template_main")


@section("titulo")
    Dèco Enfant - Login
@endsection


@section("principal")
    <!-- FORM DE LOGIN------------------------------------------------------------------------------------------------------->
  <form class="col-sm-10 offset-sm-1 col-md-6 offset-md-3 col-lg-4 offset-lg-4" action="{{ route('login') }}" method="POST">
      @csrf
      <div class="form-group no-gutters">
          <label for="email">Email</label>
          <input class="form-control" id="email" type="email" name="email" value="{{$emailOk}}" placeholder="Ingrese su email aqui...">
          @if (isset($errores["email"]))
              <span class="small text-danger">{{$errores["email"]}}</span>
          @endif
      </div>

      <div class="form-group">
          <label for="password">Contraseña</label>
          <input class="form-control" id="password" type="password" name="password" value="" placeholder="Ingrese su Contraseña aqui...">
          @if (isset($errores["password"]))
            <span class="small text-danger">{{$errores["password"]}}</span>
          @endif
      </div>

      <div class="form-group form-check">
          <!-- <input class="form-check-input" type="checkbox" name="recordar" value="recordar" id="CheckRecordar" > -->
          @if ($recordarOk)
            <input class="form-check-input" type="checkbox" name="recordar" value="recordar" id="CheckRecordar" checked >
          @else
            <input class="form-check-input" type="checkbox" name="recordar" value="recordar" id="CheckRecordar" >
          @endif
          <label class="form-check-label" for="CheckRecordar">Recordarme</label>
      </div>

      <div class="form-group">
          <input type="submit" class="btn btn-outline-primary" name="Ingresar" value="Ingresar">
      </div>
  </form>
@endsection


@section("modals")

@endsection
