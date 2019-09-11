@extends('recursos/templates/template_alert')


@section("alert")
    Dèco Enfant - Gracias por su compra
@endsection

@section("title_h1")
    Muchas gracias por tu compra! <i class="far fa-thumbs-up"></i>
@endsection

@section("message")
    Te enviamos un correo con toda la información de tu compra a {{ Auth::user()->email }}
@endsection

@section("link_href")
    /
@endsection

@section("link_text")
    Seguir Navegando en Dèco Enfant
@endsection
