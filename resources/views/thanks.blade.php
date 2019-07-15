@extends("recursos/template_main")


@section("titulo")
    Dèco Enfant - Gracias por su compra
@endsection


@section("principal")
{{-- <h1>Muchas gracias por su compra</h1>
<a href="/history"> Ver historial de compra</a> --}}

<div class="container">
<div class="jumbotron bg-transparent border text-center text-muted">
    <h1 class="display-6">Muchas gracias por tu compra! <i class="far fa-thumbs-up"></i></h1>
    <hr class="my-4">
    <p>Te enviamos un correo con toda la informacion de tu compra a {{ Auth::user()->email }}</p>
    <p class="lead mt-5">
        <a class="btn btn-secondary btn" href="/" role="button">Seguir Navegando en Dèco Enfant</a>
    </p>
</div>
</div>




@endsection
