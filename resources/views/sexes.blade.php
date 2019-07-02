@extends("recursos/template_main")

@section("titulo")
    Dèco Enfant - Sexos
@endsection

@section("principal")
  <section class="container">
      <h3>Sexos</h3>
      <div class="row px-2">
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
