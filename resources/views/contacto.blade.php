
@extends("recursos/template_main")

@section('custom_css')
{{-- <link rel="stylesheet" href="/css/style_product.css"> --}}
@endsection

@section('custom_js')
{{-- <script src="/js/product.js"></script> --}}
@endsection

@section("titulo")
Dèco Enfant - Contacto
@endsection



@section("principal")

<div class="container">
    <div class="row">
        <div class="col-md-6 col-sm-12">

        </div>




        <div class="col-md-6 col-sm-12">
                <div class="map">
                        <div id="map-container shadow-lg p-3 mb-5 bg-white rounded" class="">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3142.936098548566!2d-57.57021148471669!3d-38.025269179714684!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9584de8e2f2eaacb%3A0xeebd0912be6a7ab5!2sEl+Cano+5859%2C+B7608FQW+Mar+del+Plata%2C+Buenos+Aires!5e0!3m2!1sen!2sar!4v1563109175655!5m2!1sen!2sar" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>                    
                    </div>
        </div>
    </div>
    
</div>



@endsection