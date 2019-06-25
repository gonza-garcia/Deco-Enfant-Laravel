@extends("recursos/template_main")


@section("titulo")
    Dèco Enfant - Roles
@endsection


@section("principal")

  <section class="container">
      <div class="row px-2">

        <!--- Generar Roles ------------->
        <ul>

          @forelse ($roles as $role)
            <a href="/role/{{$role->id}}">
              <li>{{$role->name}}</li>
            </a>
          @empty
            No hay roles
          @endforelse

          </ul>
      </div>

  </section>
@endsection
