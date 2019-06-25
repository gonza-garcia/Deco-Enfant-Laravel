@extends("recursos/template_main")


@section("titulo")
    Dèco Enfant - Detalle producto
@endsection


@section("principal")
  <h3>Detalle de producto: {{$product->id}}</h3>
  <p>Producto: {{$product->name}}</p>
  <p>Detalle: {{$product->short_desc}}</p>
  <p>Descripcion: {{$product->long_desc}}</p>
  <p>Precio: {{$product->price}}</p>
  <a href="{{$product->id}}/cart">Agregar al carrito</a>
@endsection
