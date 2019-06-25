@extends("recursos/template_main")


@section("titulo")
    Dèco Enfant - Categorias
@endsection


@section("principal")

  <section class="container">
      <div class="row px-2">

        <!--- Generar Roles ------------->
        <ul>

          @forelse ($categories as $category)
            <a href="/categoria/{{$category->id}}">
              <li>{{$category->name}}</li>
            </a>
          @empty
            No hay Categorias
          @endforelse

          </ul>
      </div>

  </section>
@endsection
