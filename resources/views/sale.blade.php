@extends("recursos/template_main")

@section('custom_css')
<link rel="stylesheet" href="/css/style_sale.css">
@endsection

@section("titulo")
    Dèco Enfant - Sale
@endsection


@section("principal")

<section class="container">

        <div class="text-center pt-4">
            <h2 class="my-0 mx-auto w-100 text-uppercase"><img src="/img/icon-paper-plane.png"> sale</h2>
            <hr>
        </div>
    
        <div class="">
            <div class="d-flex flex-row justify-content-around">
                @forelse ($categories as $cat)
                    <a href="/productos/{{ $cat->id }}" class="flex-item text-muted text-decoration-none" > {{ $cat->name }}</a>
                @empty
                @endforelse
            </div>
            <hr>
    
        </div>
    
    
        <div class="row px-2">
    
            <!--- Generar Articulos ------------->
            @forelse ($products as $product)
            {{-- @dd($product); --}}
            <article class="col-6 col-md-4 col-lg-3 p-1">
                <a href="/producto/{{$product->id}}">
                    <div class="sale-img">
                        <img class="img-fluid img-thumbnail destacados-img"
                    src={{ url($product->thumbnail)}} alt={{$product->name}}>
                        <h5 class="sale-off text-danger display-inline-block">{{ (number_format($product->discount , 2, ',', '')) }}% Off</h5>
                    </div>
                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                        <div id="descrip-item" class="col-12 col-lg-8 d-flex align-items-center p-2"><a class="text-decoration-none text-dark pt-2" href="/producto/{{$product->id}}">{{$product->name}}</a></div>
                        <div class="col-12 col-lg-4 p-1">
                            <a href="/producto/{{$product->id}}" id="btn-destacados" class="btn text-uppercase p-0 w-100 py-2">ver más
                            </a>
                        </div>
                    </div>
                </a>
                <hr class="mr-2 w-85">
            </article>
            @empty
            @endforelse
    
        </div>
    
    </section>
    @endsection
    
    @section("links")
        <div class="container">
            @if (method_exists($products,'links'))
              <div class="d-flex justify-content-center">{{$products->links()}}</div>
            @endif
        </div>




@endsection
