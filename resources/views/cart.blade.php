@extends("recursos/template_main")


@section("titulo")
Dèco Enfant - Detalle del carrito
@endsection

@section("principal")

<section class="container">
  {{-- <h3>Carrito</h3>
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
    </div> --}}
    
    <div class="container">
      <table id="cart" class="table table-hover table-condensed">
        <thead>
          <tr>
            <th style="width:50%">Producto</th>
            <th style="width:10%">Precio</th>
            <th style="width:8%">Cantidad</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>
          </tr>
        </thead>
        @forelse ($cart as $items)
        <tbody>
          <tr>
            <td data-th="Product">
              <div class="row">
                <div class="col-sm-2 hidden-xs"><img src="{{$items->thumbnail}}" alt={{ $items->name }} class="img-fluid img-thumbnail"/></div>
                <div class="col-sm-10">
                  <h4 class="nomargin">{{ $items->name }}</h4>
                  <p>{{$items->short_desc}}</p>
                </div>
              </div>
            </td>
            <td data-th="Price">{{$items->price}}</td>
            <td data-th="Quantity">
              <input type="number" class="form-control text-center" value="1">
            </td>
            <td data-th="Subtotal" class="text-center">1.99</td>
            <td class="actions" data-th="">
              <button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>
              <form class="" action="/cart/{{$items->id}}" method="post">
                @csrf
                <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
              </form>
              
            </td>
          </tr>
        </tbody>
        @empty
        <p>Su carrito esta vacio</p>
        @endforelse
        
        <tfoot>
          <tr class="visible-xs">
            <td class="text-center"><strong>Total 1.99</strong></td>
          </tr>
          <tr>
            <td><a href="#" class="btn btn-warning"><i class="fa fa-angle-left"></i> Seguir Comprando</a></td>
            <td colspan="2" class="hidden-xs"></td>
            <td class="hidden-xs text-center"><strong>$ {{ $totalPrice }}</strong></td>
            
            <td class="px-0">
              @if ($cart->isNotEmpty())
                <a href="/cart/close" class="btn btn-success btn-block">Comprar <i class="fa fa-angle-right"></i></a>
              @endif
            </td>  
          </tr>
        </tfoot>
      </table>
    </div>
  </section>
  @endsection
