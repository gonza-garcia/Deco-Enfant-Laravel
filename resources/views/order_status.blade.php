@extends("recursos/template_main")


@section("titulo")
    Dèco Enfant - Detalle de estado de orden
@endsection


@section("principal")
  <h3>Detalle de estado de orden: {{$order_status->id}}</h3>
  <p>Nombre estado de orden: {{$order_status->name}}</p>
@endsection
