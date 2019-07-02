@extends("recursos/template_main")


@section("titulo")
    Dèco Enfant - Detalle de color
@endsection


@section("principal")
  <h3>Detalle de color: {{$color->id}}</h3>
  <p>Nombre color: {{$color->name}}</p>
@endsection
