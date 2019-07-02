@extends("recursos/template_main")


@section("titulo")
    Dèco Enfant - Detalle de estado de despacho
@endsection


@section("principal")
  <h3>Detalle de estado de despacho: {{$shipping_status->id}}</h3>
  <p>Nombre estado de despacho: {{$shipping_status->name}}</p>
@endsection
