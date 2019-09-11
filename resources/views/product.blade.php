@extends("recursos/template_main")

@section('custom_css')
<link rel="stylesheet" href="/css/style_product.css">
@endsection

@section('custom_js')
<script src="/js/product.js"></script>
@endsection

@section("titulo")
Dèco Enfant - Detalle producto
@endsection



@section("principal")
{{-- <h3>Detalle de producto: {{$product->name}}</h3>
<p>Codigo de Producto: {{$product->id}}</p>
<p>Detalle: {{ $product->short_desc }}</p>
<p>Descripcion: {{$product->long_desc}}</p>
<p>Precio: {{$product->price}}</p>
<a href="{{$product->id}}/cart">Agregar al carrito</a> --}}




<div class="container py-3">
  <div class="row">
    <div class="col-md-12 mb-0 mb-2">
      <a class="menu-esc" href="/">Inicio</a><span class="mx-2 mb-0">/</span>
      <a class="menu-esc" href="/products">Productos</a> <span class="mx-2 mb-0">/</span>
      <a class="menu-esc" href="/products/{{ $product->subcategory->category->id }}">{{ $product->subcategory->category->name }}</a><span class="mx-2 mb-0">/</span>
      <span class="text-black">{{ $product->subcategory->name }}</span>
    </div>
  </div>
</div>


<div class="detalle-producto">
  <div class="container">
    <div class="row">

      {{-- COLUMNA IZQUIERDA - IMAGEN DEL PRODUCTO --}}
        <div class="col-md-6">
            <div>
                <img src="{{url($product->thumbnail)}}" alt="{{ $product->name }}" class="img-fluid mx-auto d-block rounded">
            </div>
        </div>

      {{-- COLUMNA DERECHA - DETALLE DEL PRODUCTO Y SLICK DE IMG--}}

        <div class="col-md-6">
          <div class="d-flex flex-column align-items-start">

                <h2 class="prod-title text-dark">{{ $product->name }}</h2>
                <p>{{$product->short_desc}}</p>
                <p class="mb-3 text-justify">{{ $product->long_desc }}</p>
                @if($product->discount > 0)
                <p class="prod-price"><strong class="text-secondary h5"><del>$ {{ number_format($product->price, 2, ',', '') }}</del></strong></p>
                <p class="prod-price"><strong class="text-danger h4">$ {{ number_format($product->price - ($product->discount/100*$product->price),2, ',', '') }}</strong></p>
                @else
                <p class="prod-price"><strong class="text-secondary h4">$ {{ number_format($product->price, 2, ',', '') }}</strong></p>
                @endif

                <div class="mb-1 d-flex">
                    <label for="option-sm" class="d-flex mr-3 mb-3">
                        <span class="d-inline-block mr-2 position-relative">
                          <input type="radio" id="option-sm" name="shop-sizes">
                        </span>
                        <span class="d-inline-block text-black">{{ $product->size->name }}</span>
                    </label>

                    <label for="option-md" class="d-flex mr-3 mb-3">
                        <span class="d-inline-block mr-2 position-relative">
                          <input type="radio" id="option-md" name="shop-sizes">
                        </span>
                        <span class="d-inline-block text-black">Chico</span>
                    </label>

                    <label for="option-lg" class="d-flex mr-3 mb-3">
                        <span class="d-inline-block mr-2 position-relative">
                          <input type="radio" id="option-lg" name="shop-sizes">
                        </span>
                        <span class="d-inline-block text-black">Mediano</span>
                    </label>

                    <label for="option-xl" class="d-flex mr-3 mb-3">
                        <span class="d-inline-block mr-2 position-relative">
                          <input type="radio" id="option-xl" name="shop-sizes">
                        </span>
                        <span class="d-inline-block text-black">Grande</span>
                    </label>
                </div>

                <div class="product-configuration">
                  <div class="product-color mb-3 ">
                    <div class="color-choose">
                      <div>
                        <input data-image="color1" type="radio" id="color1" name="color" value="color1" checked>
                        <label for="color1"><span></span></label>
                      </div>
                      <div>
                        <input data-image="color2" type="radio" id="color2" name="color" value="color2">
                        <label for="color2"><span></span></label>
                      </div>
                      <div>
                        <input data-image="color3" type="radio" id="color3" name="color" value="color3">
                        <label for="color3"><span></span></label>
                      </div>
                    </div>
                  </div>
                </div>

                <form class="" action="{{ url('/addToCart') }}" method="post">
                  {{ csrf_field() }}
                  <div class="mb-3 ml-1">
                    <div class="qty mt-1">
                      <span class="qty-sp minus bg-dark">-</span>
                      <input type="text" class="qty-in count" name="cant" value=1 min="1" max="{{ $product->stock }}">
                      <span class="qty-sp plus bg-dark">+</span>
                      <input type="hidden" name="prodId" value="{{ $product->id }}">
                    </div>
                  </div>

                  <p>
                    <button type="submit" class="btn-cart btn btn-sm height-auto px-3 py-2 float-left"> Agregar  <i class="mr-1 fas fa-shopping-cart"></i>
                    </button>
                  </p>

                  </form>

                  <div class="center slider ml-3">
                      <div class="slider-item"><img src="{{url($product->thumbnail)}}" alt=""></div>
                      <div class="slider-item"><img src="{{url($product->thumbnail)}}" alt=""></div>
                      <div class="slider-item"><img src="{{url($product->thumbnail)}}" alt=""></div>
                      <div class="slider-item"><img src="{{url($product->thumbnail)}}" alt=""></div>
                      <div class="slider-item"><img src="{{url($product->thumbnail)}}" alt=""></div>
                      <div class="slider-item"><img src="{{url($product->thumbnail)}}" alt=""></div>
                  </div>

          </div>
        </div>

    </div>
  </div>
</div>


@endsection
