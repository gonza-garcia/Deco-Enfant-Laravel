@extends("recursos/template_main")


@section("titulo")
    Dèco Enfant - Detalle del carrito
@endsection

@section("principal")
  <section class="container">
      <h3>Carrito</h3>
      <div class="row px-2">
        <ul>
          @forelse ($cart as $items)
            <img src="/storage/product/{{$items->thumbnail}}" alt="">
            <a href="/cart/{{$items->id}}">
              <li>
                Id: {{$items->id}} <br>
                Nombre: {{$items->name}} <br>
                Descripción: {{$items->short_desc}} <br>
                Detalle: {{$items->long_desc}} <br>
                Precio: {{$items->price}}
              </li>
            </a>

          <form class="" action="/cart/{{$items->id}}" method="post">
            @csrf
            <button type="submit">Quitar del carrito</button>
          </form>

          @empty
          <p>Su carrito esta vacio.</p>
          @endforelse

          @if ($cart->isNotEmpty())
            <a href="/cart/close">Comprar</a>
          @endif
        </ul>
      </div>
  </section>
@endsection
