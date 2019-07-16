
@extends("recursos/template_main")

@section('custom_css')
<link rel="stylesheet" href="/css/style_contacto.css">
@endsection

{{-- @section('custom_js')
<script src="/js/contacto.js"></script>
@endsection --}}

@section("titulo")
Dèco Enfant - Contacto
@endsection



@section("principal")

<div class="container my-5">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="text-center">
                <h3 class="my-0 mx-auto w-100 text-uppercase"><img src="/img/icon-paper-plane.png">  Contactanos</h3>
                <hr>
            </div>
            <div class="card mb-2">
                <div class="card-body">
                    {{-- <ul class="p-none pt-2 text-center">
                        <li><a class="text-decoration-none text-muted font-weight-light" href="#phone"><i class="fas fa-mobile-alt"></i> +49 163 7325192</a></li>
                        <li><a class="text-decoration-none text-muted font-weight-light"  href="https://maps.google.com/maps?ll=-38.025852,-57.567293&z=17&t=m&hl=en&gl=AR&mapclient=embed&q=El%20Cano%205859%20B7608FQW%20Mar%20del%20Plata%20Buenos%20Aires"><i class="fas fa-map-pin"></i> Elcano 5859 - Mar del Plata</a></li>
                        <li><a class="text-decoration-none text-muted font-weight-light"  href="mailto:gcostoya02@gmail.com"><i class="fa fa-envelope"></i> gcostoya02@gmail.com</a></li>
                    </ul>  --}}
                    <ul class="p-none pt-2 list-inline d-flex justify-content-around">
                        <li class="social list-inline-item"><a href="https://www.instagram.com/decoenfant_/"><i class="text-muted fab fa-instagram"></i></a></li>
                        <li class="social list-inline-item"><a href="https://www.facebook.com/decoenfant0/"><i class="text-muted fab fa-facebook"></i></a></li>
                        <li class="social list-inline-item"><a href="#whatsapp"><i class="text-muted fab fa-whatsapp"></i></a></li>
                    </ul>
                    <form>
                        <h6 class="pl-2 mb-1">Contactanos:</h6>
                        <input type="email" class="form-control mb-1" placeholder="tuEmail@email.com" required>
                        <textarea  class="form-control w-100 border mb-2" rows="3" placeholder="dejanos tu consulta..." required></textarea>
                        <button class="btn btn-secondary float-right btn-enviar" type="submit">Enviar</button>
                        <p class="d-none msg-consulta text-danger pl-3 pt-2">Gracias por su consulta!!</p>
                    </form>
                    
                </div>
            </div>            
        </div>

        <div class="col-md-6 col-sm-12">
            <div class="w-100 mt-">
                <iframe class="border" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3142.936098548566!2d-57.57021148471669!3d-38.025269179714684!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9584de8e2f2eaacb%3A0xeebd0912be6a7ab5!2sEl+Cano+5859%2C+B7608FQW+Mar+del+Plata%2C+Buenos+Aires!5e0!3m2!1sen!2sar!4v1563109175655!5m2!1sen!2sar" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
    
</div>



@endsection