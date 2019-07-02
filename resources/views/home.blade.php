@extends('recursos/template_main')
{{-- @extends('layouts.app') --}}

@section('titulo')
    Dèco Enfant - Home
@endsection

{{-- @section('content') --}}
@section('principal')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Informacion</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Se ha logueado!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
