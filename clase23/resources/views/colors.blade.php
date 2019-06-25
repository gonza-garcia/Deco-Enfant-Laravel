@extends("recursos/template_main")


@section("titulo")
    Dèco Enfant - Colores
@endsection


@section("principal")

  <section class="container">
      <div class="row px-2">

        <!--- Generar Roles ------------->
        <ul>

          @forelse ($colors as $color)
            <a href="/color/{{$color->id}}">
              <li>{{$color->name}}</li>
            </a>
          @empty
            No hay colores
          @endforelse

          </ul>
      </div>

      {{-- <form class="" action="/colores/add" method="get">
          <div class="">
            <button type="submit" name="button">Actualizar</button>
          </div>
      </form> --}}

  </section>
@endsection
