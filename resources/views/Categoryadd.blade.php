@extends("recursos/template_main")


@section("titulo")
    Dèco Enfant - Agregar categoria
@endsection


@section("principal")
  <form class="" action="/categorias/add" method="post">
    {{csrf_field()}}

    <div class="">
      <input type="hidden" name="id" value="{{old("id")}}">
    </div>

    <div class="">
      <label for="name">Nombre:</label>
      <div class="col-md-offset-3 col-md-6">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old("name")}}">
        @error('name')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>

    <div class="">
      <label for="id_parent">Categoria padre:</label>
      <div class="col-md-offset-3 col-md-6">
        <input id="id_parent" type="text" class="form-control @error('id_parent') is-invalid @enderror" name="id_parent" value="{{old("id_parent")}}">
        @error('id_parent')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>

    <div class="">
      <input type="submit" name="" value="Agregar categoria">
    </div>

  </form>
  </form>
@endsection
