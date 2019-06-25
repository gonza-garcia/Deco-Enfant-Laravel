@extends("recursos/template_main")


@section("titulo")
    Dèco Enfant - Detalle de categoria
@endsection


@section("principal")
  <h3>Detalle de categoria: {{$category->id}}</h3>
  <p>Nombre categoria: {{$category->name}}</p>
  <p>Categoria padre: {{$category->id_parent}}</p>
@endsection
