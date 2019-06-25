@extends("recursos/template_main")


@section("titulo")
    Dèco Enfant - Sexos
@endsection


@section("principal")

  <section class="container">
      <div class="row px-2">

        <!--- Generar Roles ------------->
        <ul>

          @forelse ($sexes as $sex)
            <a href="/sexo/{{$sex->id}}">
              <li>{{$sex->name}}</li>
            </a>
          @empty
            No hay sexos
          @endforelse

          </ul>
      </div>

  </section>
@endsection
