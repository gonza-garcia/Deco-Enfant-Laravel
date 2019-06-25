@extends("recursos/template_main")


@section("titulo")
    Dèco Enfant - Agregar estado de despacho
@endsection


@section("principal")
  <form class="" action="/shippingStatuses/add" method="post">
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
      <input type="submit" name="" value="Agregar estado de despacho">
    </div>

  </form>
  </form>
@endsection
