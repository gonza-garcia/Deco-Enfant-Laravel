@extends('recursos/template_main')
{{-- @extends('layouts.app') --}}


@section('titulo')
    Dèco Enfant - Mail de verificacion
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifique su direccion de mail') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Un link de verificacion ha sido enviado a su cuenta de email.') }}
                        </div>
                    @endif

                    {{ __('Antes de continuar, por favor consulte el link de verificacion en su email.') }}
                    {{ __('Si usted no recibio el email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
