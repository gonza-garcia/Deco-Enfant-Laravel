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



<div class="py-3 pl-0">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-0 pl-0 mb-2">
        <a class="menu-esc" href="/">Inicio</a> <span class="mx-2 mb-0">/</span>
        <a class="menu-esc" href="/productos">Productos</a> <span class="mx-2 mb-0">/</span>
        {{-- //falta agregar esto en el controlador para que busque el nombre de la categoria del producto. y sea link a la vista de todos lo productos de esa categoria. --}}
        <a class="menu-esc" href="/productos/{{ $subcategory->name }}">{{ $product->subcategory->name }}</a> <span class="mx-2 mb-0">/</span>

        <span class="text-black">{{ $product->name }}</span>
      </div>
    </div>
  </div>
</div>

<div class="detalle-producto">
  <div class="container pl-0">
    <div class="row">
      <div class="col-md-6">
        <div class="border rounded">
          {{-- @dd($product->thumbnail) --}}
          <img src="{{url($product->thumbnail)}}" alt="{{ $product->name }}" class="img-fluid rounded">
        </div>
        <div class="center slider">
          <div class="slider-item"><img src="{{url($product->thumbnail)}}" alt=""></div>
          <div class="slider-item"><img src="{{url($product->thumbnail)}}" alt=""></div>
          <div class="slider-item"><img src="{{url($product->thumbnail)}}" alt=""></div>
          <div class="slider-item"><img src="{{url($product->thumbnail)}}" alt=""></div>
          <div class="slider-item"><img src="{{url($product->thumbnail)}}" alt=""></div>
          <div class="slider-item"><img src="{{url($product->thumbnail)}}" alt=""></div>
        </div>
      </div>
      <div class="col-md-6">
        <h2 class="prod-title text-dark">{{ $product->name }}</h2>
        <p>{{$product->short_desc}}</p>
        <p class="mb-4 text-justify">{{ $product->long_desc }}
        </p>
        <p class="prod-price"><strong class="text-secondary h4">$ {{ $product->price }}</strong></p>

        <div class="mb-1 d-flex">

          {{-- @foreach ($product as $prod)
          <label for="option-sm" class="d-flex mr-3 mb-3">
            <span class="d-inline-block mr-2 position-relative">
              <input type="radio" id="option-sm" name="shop-sizes">
            </span>
            <span class="d-inline-block text-black">{{ $prod->size }}</span>
          </label>
          @endforeach --}}


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
            <span class="d-inline-block text-black">Medium</span>
          </label>

          <label for="option-lg" class="d-flex mr-3 mb-3">
            <span class="d-inline-block mr-2 position-relative">
              <input type="radio" id="option-lg" name="shop-sizes">
            </span>
            <span class="d-inline-block text-black">Large</span>
          </label>

          <label for="option-xl" class="d-flex mr-3 mb-3">
            <span class="d-inline-block mr-2 position-relative">
              <input type="radio" id="option-xl" name="shop-sizes">
            </span>
            <span class="d-inline-block text-black">Extra Large</span>
          </label>

        </div>

        <!-- Product Configuration -->
        <div class="product-configuration">

          <!-- Product Color -->
          <div class="product-color mb-3 ">
            {{-- <span class="mb-10">Color</span> --}}

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

          <div class="mb-3 ml-1">
            <div class="qty mt-1">
              <span class="qty-sp minus bg-dark">-</span>
              <input type="number" class="qty-in count" name="qty" value="1">
              <span class="qty-sp plus bg-dark">+</span>
            </div>

          </div>

          <p><a href="{{$product->id}}/cart" class="btn-cart btn btn-sm height-auto px-3 py-2 float-left "><i class="mr-1 fas fa-shopping-cart"></i>
            Agregar</a></p>

          </div>
        </div>
      </div>
    </div>
  </div>



  @endsection
