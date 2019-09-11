@extends("recursos/template_main")


@section("titulo")
    Dèco Enfant - Detalle del carrito
@endsection



@section('custom_css')
    <link rel="stylesheet" href="/css/style_cart.css">
@endsection



@section('custom_js')
    {{-- <script src="/js/cart.js"></script> --}}
@endsection



@section("principal")

<section class="container">
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

        @forelse ($openCarts as $cart)
        <tbody>
            <tr>
                <td data-th="Producto">
                    <div class="row">
                        <div class="col-sm-3 d-sm-block">
                            <img src="{{$cart->thumbnail}}" alt={{ $cart->name }} class="img-fluid img-thumbnail"/>
                        </div>
                        <div class="col-sm-9">
                            <h5 class="m-0">{{ $cart->name }}</h5>
                            <p class="font-italic my-0">{{$cart->short_desc}}</p>
                            <p class="font-italic my-0">{{$cart->size->name}}</p>
                        </div>
                    </div>
                </td>

                @if($cart->discount > 25)
                    <td data-th="Precio" class="text-danger">$ {{ (number_format($cart->price - ($cart->discount/100*$cart->price),2, ',', '')) }}</td>
                @else
                    <td data-th="Precio">$ {{ (number_format($cart->price, 2, ',', '')) }}</td>
                @endif

                <td data-th="Cantidad">
                    <form class="input-group" action="/cart/update/{{$cart->id}}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input type="hidden" name="prodId" value={{ $cart->id }}>
                        <input type="number" name="cant" class="form-control" value={{ $cart->cant }} min="1" max={{ $cart->stock }}>
                        <button class="btn btn-sm ml-1" type="submit" value=""><i class="fas fa-sync-alt"></i></button>
                    </form>
                </td>

                @if($cart->discount > 25)
                    <td data-th="Subtotal" class="text-center"> $ {{ (number_format( ($cart->price - ($cart->discount / 100 * $cart->price) ) * $cart->cant , 2, ',', '')) }}</td>
                @else
                    <td data-th="Subtotal" class="text-center"> $ {{ (number_format($cart->price * $cart->cant , 2, ',', '')) }}</td>
                @endif

                <td class="actions" data-th="">
                    <form class="text-center" action="/cart/{{$cart->id}}" method="post">
                        @csrf
                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                    </form>
                </td>
            </tr>
        </tbody>

        @empty
            <p>Su carrito esta vacío</p>

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
                    @if ($openCarts->isNotEmpty())
                        <a href="/cart/close" class="btn btn-comprar btn-block">Comprar <i class="fa fa-angle-right"></i></a>
                    @endif
                </td>
            </tr>
        </tfoot>

    </table>
</div>
</section>
@endsection
