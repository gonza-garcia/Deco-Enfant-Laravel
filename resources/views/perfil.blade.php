@extends("recursos/template_main")


@section("titulo")
    Dèco Enfant - Perfil de Ususario
@endsection

@section('custom_css')
<link rel="stylesheet" href="/css/style_cart.css">
@endsection


@section("principal")

  <div class="container mt-0 mb-4" id='resultados'>
      <h1 id='error'></h1>
      <div class='row p-0'>
          <ul class="d-flex flex-column justify-content-between col-6" id='resultados_1'>
              <li class='p-3 mb-3'><h1>Historial De Compras</h1></li>
              <li>
                  @forelse ($history as $cart)
                  <p class="text-dark m-0">Codigo de compra: <span class="text-muted"> {{$cart->first()->cart_number}}</span></p>
                  <p class="text-dark my-1">Enviado el: <span class="text-muted"> {{$cart->first()->updated_at}} </span></p>

                      @foreach ($cart as $items)
                            <div class="card-deck my-2 h-100">
                                <div class="card">
                                    <img class="card-img-top" src="{{ url($items->thumbnail)}}" alt={{ $items->name }}>
                                    <div class="card-body">
                                        <h6 class="card-title">{{ $items->name }}</h6>
                                        <p class="card-text"><small>{{ $items->short_desc }}</small></p>
                                    </div>
                                    <div class="card-footer btn">
                                        <a href="/producto/{{$items->id}}" class="d-block text-decoration-none"><small class="text-muted">Volver a comprar</small></a>
                                    </div>
                                </div>
                            </div>
                      @endforeach

                  @empty
                  <p>Su historial de compra está vacío</p>
                  @endforelse
              </li>

          </ul>
          {{-- <ul class="d-flex flex-column justify-content-between col-4" id='resultados_2'>

          </ul> --}}
          <ul class="d-flex flex-column justify-content-between col-6" id='resultados_3'>

          </ul>
      </div>
  </div>

{{-- <div class="container">


    <div class="row">
        <div class="col-md-6 col-sm-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Mi Perfil</h5>
              <p class="card-text">Username: {{ Auth::user()->name }}</p>
              <p class="card-text">Nombre: {{ Auth::user()->first_name }}</p>
              <p class="card-text">Apellido: {{ Auth::user()->last_name }}</p>
              <p class="card-text">Email: {{ Auth::user()->email }}</p>
              <p class="card-text">Usuario desde : {{ Auth::user()->created_at }}</p>
              <a href="/" class="btn btn-warning">Editar Perfil</a>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Ultima compra</h5>
              <img src="" alt="">
              <p class="card-text">
                  @forelse ($history as $cart)
                  @if(!$cart->first() == null)
                  <p class="card-text text-dark m-0">Codigo de compra: <span class="text-muted"> {{$cart->first()->cart_number}}</span></p>
                  <p class="card-text text-dark my-1">Enviado el: <span class="text-muted"> {{$cart->first()->updated_at}} </span></p>
                  @break
                  @endIf
                  @empty
                  <p>Su historial de compra está vacío</p>
                  @endforelse
              </p>
              <a href="/history" class="btn btn-secondary">Ver mi histrial de compras</a>
            </div>
          </div>
        </div>
      </div>
      </div>


{{-- 
  <h1>Historial De Compras</h1>
  @forelse ($history as $cart)
  <p class="text-dark m-0">Codigo de compra: <span class="text-muted"> {{$cart->first()->cart_number}}</span></p>
  <p class="text-dark my-1">Enviado el: <span class="text-muted"> {{$cart->first()->updated_at}} </span></p>


  <div class="row mb-5">
    @foreach ($cart as $items)
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="card-deck my-2 h-100">
        <div class="card">
          <img class="card-img-top" src="{{ url($items->thumbnail)}}" alt={{ $items->name }}>
          <div class="card-body">
            <h6 class="card-title">{{ $items->name }}</h6>
            <p class="card-text"><small>{{ $items->short_desc }}</small></p>
          </div>
          <div class="card-footer btn">
            <a href="/producto/{{$items->id}}" class="d-block text-decoration-none"><small class="text-muted">Volver a comprar</small></a>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>



  @empty
  <p>Su historial de compra está vacío</p>
  @endforelse

</div> --}}
<<<<<<< HEAD

=======
>>>>>>> d3511fe430be296737f94aac8863e89dc377237c

@endsection




  {{-- <ul> --}}
  {{-- @forelse ($history as $cart)
    <li> --}}
      {{-- Como todos los items tienen el mismo nro de carrito y la misma fecha de compra, con traer el dato del primer items podemos mostrar todos los datos generales de la compra --}}
      {{-- Codigo de carrito: {{$cart->first()->cart_number}} <br>
      Enviado el: {{$cart->first()->updated_at}} <br>
      <ul> --}}
        {{-- Con este detalle vemos el contenido de cada item --}}
        {{-- @foreach ($cart as $item)
          <li>Nombre: {{$item->name}}</li>
        @endforeach
        <br>
      </ul>
    </li>
  @empty
    <p>Su historial de compra está vacío</p>
  @endforelse
  </ul> --}}


{{-- <div class="container">
@forelse ($history as $cart)
<p>
  Codigo de carrito: {{$cart->first()->cart_number}} <br>
  Enviado el: {{$cart->first()->updated_at}} <br>
</p>
<table id="cart" class="table table-hover">
<thead class="cart-thead text-left">
<tr>
<th style="width:50%">Producto</th>
<th style="width:15%">Precio x Unid.</th>
<th style="width:15%">Cantidad</th>
<th style="width:20%" class="text-center">Subtotal</th>
</tr>
</thead>

@foreach ($cart as $items)
<tbody>
<tr>
<td data-th="Product">
<div class="row">
<div class="col-sm-3 d-sm-block"><img src="{{$items->thumbnail}}" alt={{ $items->name }} class="img-fluid img-thumbnail"/></div>
<div class="col-sm-9">
<h5 class="m-0">{{ $items->name }}</h5>
<p class="font-italic my-0">{{$items->short_desc}}</p>
<p class="font-italic my-0">{{$items->size->name}}</p>
</div>
</div>
</td>

<td data-th="Price">$ {{$items->price}}</td>

<td data-th="Quantity">{{ $items->cant }}</td>

<td data-th="Subtotal" class="text-center"> $ {{ $items->cant * $items->price }} </td>

<td class="actions" data-th=""></td>

</tr>
</tbody>
@endforeach
</table>
@empty
<p>Su historial de compra está vacío</p>
@endforelse
</div> --}}
