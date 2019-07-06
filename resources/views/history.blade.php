@extends("recursos/template_main")


@section("titulo")
    Dèco Enfant - Historial de compras
@endsection


@section("principal")
  <ul>
  @forelse ($history as $cart)
    <li>
      {{-- Como todos los items tienen el mismo nro de carrito y la misma fecha de compra, con traer el dato del primer items podemos mostrar todos los datos generales de la compra --}}
      Codigo de carrito: {{$cart->first()->cart_number}} <br>
      Enviado el: {{$cart->first()->updated_at}} <br>
      <ul>
        {{-- Con este detalle vemos el contenido de cada item --}}
        @foreach ($cart as $item)
          <li>Nombre: {{$item->name}}</li>
        @endforeach
        <br>
      </ul>
    </li>
  @empty
    <p>Su historial de compra está vacío</p>
  @endforelse
  </ul>
@endsection
