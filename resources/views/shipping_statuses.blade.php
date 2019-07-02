@extends("recursos/template_main")

@section("titulo")
    Dèco Enfant - Estados de despachos
@endsection

@section("principal")
  <section class="container">
      <h3>Estados de despachos</h3>
      <div class="row px-2">
        <ul>
          @forelse ($shipping_statuses as $shipping_status)
            <a href="/shippingStatus/{{$shipping_status->id}}">
              <li>{{$shipping_status->name}}</li>
            </a>
          @empty
            No hay estados de despachos
          @endforelse
          </ul>
      </div>
  </section>
@endsection
