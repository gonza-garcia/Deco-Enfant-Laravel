@extends("recursos/template_main")

@section("titulo")
    Dèco Enfant - Detalle producto
@endsection

@section("principal")
  <h3>Detalle de producto: {{$product->name}}</h3>
  <p>Codigo de Producto: {{$product->id}}</p>
  <p>Detalle: {{$product->short_desc}}</p>
  <p>Descripcion: {{$product->long_desc}}</p>
  <p>Precio: {{$product->price}}</p>
  <a href="{{$product->id}}/cart">Agregar al carrito</a>
@endsection
