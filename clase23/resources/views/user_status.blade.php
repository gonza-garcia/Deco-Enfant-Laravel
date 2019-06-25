@extends("recursos/template_main")


@section("titulo")
    Dèco Enfant - Detalle de estado de usuario
@endsection


@section("principal")
  <h3>Detalle de estado de usuario {{$user_status->id}}</h3>
  <p>Nombre estado de usuario: {{$user_status->name}}</p>
@endsection
