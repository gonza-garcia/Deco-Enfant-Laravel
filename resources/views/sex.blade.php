@extends("recursos/template_main")


@section("titulo")
    Dèco Enfant - Detalle de sexo
@endsection


@section("principal")
  <h3>Detalle de sexo: {{$sex->id}}</h3>
  <p>Nombre sexo: {{$sex->name}}</p>
@endsection
