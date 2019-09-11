@extends("recursos/template_main")


@section("titulo")
    @yield('alert')
@endsection


@section("principal")
{{-- <h1>Muchas gracias por su compra</h1>
<a href="/history"> Ver historial de compra</a> --}}

    <div class="container">
        <div class="jumbotron bg-transparent border text-center text-muted">
            <h1 class="display-6"> @yield('title_h1') </h1>
            <hr class="my-4">
            <p> @yield('message') </p>
            <p class="lead mt-5">
                <a class="btn btn-secondary btn" href="@yield('link_href')" role="button">@yield('link_text')</a>
            </p>
        </div>
    </div>

@endsection
