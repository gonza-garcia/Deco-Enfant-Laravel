@extends("recursos/template_main")


@section("titulo")
    Dèco Enfant - Detalle de rol
@endsection


@section("principal")
  <h3>Detalle de rol {{$role->id}}</h3>
  <p>Nombre rol: {{$role->name}}</p>
@endsection
