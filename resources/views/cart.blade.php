@extends("recursos/template_main")


@section("titulo")
Dèco Enfant - Detalle del carrito
@endsection

@section('custom_css')
<link rel="stylesheet" href="/css/style_cart.css">
@endsection
{{-- 
  @section('custom_js')
  <script src="/js/cart.js"></script>
  @endsection --}}
  
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
        <div class="historial float-right mb-2">
            <a href="/history" class="btn btn-secondary">Ver historial de compras <i class="far fa-list-alt"></i></a>
        </div>
        <table id="cart" class="table table-hover">
          <thead class="cart-thead text-left">
            <tr>
              <th style="width:45%">Producto</th>
              <th style="width:15%">Precio x Unid.</th>
              <th style="width:15%">Cantidad</th>
              <th style="width:15%" class="text-center">Subtotal</th>
              <th style="width:10%"></th>
            </tr>
          </thead>
          @forelse ($cart as $items)
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
              @if($items->discount > 25)
              <td data-th="Price" class="text-danger">$ {{ (number_format($items->price - ($items->discount/100*$items->price),2, ',', '')) }}</td>
              @else
              <td data-th="Price">$ {{ (number_format($items->price, 2, ',', '')) }}</td>
              @endif
              
              <td data-th="Quantity">
                <form class="input-group" action="/cart/update/{{$items->id}}" method="post">
                  {{ csrf_field() }}     
                  {{ method_field('PUT') }}
                  <input type="hidden" name="prodId" value={{ $items->id }}>
                  <input type="number" name="cant" class="form-control" value={{ $items->cant }} min="1" max={{ $items->stock }}>   
                  <button class="btn btn-sm ml-1" type="submit" value=""><i class="fas fa-sync-alt"></i></button>                  
                </form>
                
              </td>
              @if($items->discount > 25)
              <td data-th="Subtotal" class="text-center"> $ {{ (number_format( ($items->price - ($items->discount / 100 * $items->price) ) * $items->cant , 2, ',', '')) }}</td>
              @else
              <td data-th="Subtotal" class="text-center"> $ {{ (number_format($items->price * $items->cant , 2, ',', '')) }}</td>
              @endif

              <td class="actions" data-th="">
                <form class="text-center" action="/cart/{{$items->id}}" method="post">
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
            <tr class="d-sm-none">
              <td class="text-center"><strong> Total $ {{ (number_format($totalPrice , 2, ',', '')) }}</strong></td>
            </tr>
            <tr>
              <td><a href="/productos" class="btn btn-seguir"><i class="fa fa-angle-left"></i> Seguir Comprando</a></td>
              <td colspan="2" class="hidden-xs"></td>
              <td class="d-none d-sm-block text-center"><strong> Total $ {{ (number_format($totalPrice, 2, ',', '')) }}</strong></td>
              
              <td class="px-0">
                @if ($cart->isNotEmpty())
                <a href="/cart/close" class="btn btn-comprar btn-block">Comprar <i class="fa fa-angle-right"></i></a>
                @endif
              </td>  
            </tr>
          </tfoot>
          
        </table>
      </div>
    </section>
    @endsection
