@extends("recursos/template_main")


@section("titulo")
    Dèco Enfant - Editar color
@endsection


@section("principal")
  <form class="" action="/color/{id}" method="post">
    {{csrf_field()}}
    <input type="hidden" name="id" value="{{$color["id"]}}">
    <div class="">
      <label for="name">Nombre:</label>
      <input type="text" name="name" value="{{$color["name"]}}">
    </div>
    <div class="">
      <button type="submit" name="button">Actualizar</button>
    </div>
  </form>
@endsection
