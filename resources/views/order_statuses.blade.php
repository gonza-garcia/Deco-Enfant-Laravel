@extends("recursos/template_main")


@section("titulo")
    Dèco Enfant - Estados de ordenes
@endsection


@section("principal")

  <section class="container">

      <h3>Estados de ordenes</h3>
      <div class="row px-2">

        <!--- Generar Roles ------------->
        <ul>

          @forelse ($order_statuses as $order_status)
            <a href="/orderStatus/{{$order_status->id}}">
              <li>{{$order_status->name}}</li>
            </a>
          @empty
            No hay estados de ordenes
          @endforelse

          </ul>
      </div>

  </section>
@endsection
