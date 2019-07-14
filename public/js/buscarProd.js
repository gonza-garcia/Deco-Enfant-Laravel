window.addEventListener("load", function() {

    var form_buscador = document.querySelector('form#formBuscar')
    var accion_original = form_buscador.action;
    var input_buscador = document.querySelector('input#buscador')
    var submit_buscador = document.querySelector('a#submit_buscador')
    var ul_res = document.querySelector('ul#resultados');

    form_buscador.addEventListener('input', function(event) {
        if (input_buscador.value == '')
        {
            ul_res.innerHTML = '';
            return false;
        }

        form_buscador.action = accion_original + '/' + input_buscador.value;

        buscarProds(input_buscador.value);
    });

    form_buscador.addEventListener('keypress', function(event){
        if (event.key == 'Enter')
            if (!input_buscador.value == '')
                form_buscador.submit();
    });

    form_buscador.addEventListener('submit', function(event){
        event.preventDefault;

        if (!input_buscador.value == '')
            form_buscador.submit();
    });

    submit_buscador.addEventListener('click', function(event){
        if (input_buscador.value == '')
            event.preventDefault;
        else
            form_buscador.submit();
    });



})

function buscarProds(buscador) {
    fetch("http://localhost:8000/api/productos")
    .then(function(respuesta) {
        return respuesta.json()
    })
    .then(function(informacion)
    {
        var ul_res = document.querySelector('ul#resultados');
        ul_res.innerHTML = "";

        for (var i = 0; i < informacion.length; i++)
        {
            // console.log(informacion[i].name.indexOf(buscador));
            if (informacion[i].name.toLowerCase().indexOf(buscador.toLowerCase()) != -1)
            {
                ul_res.innerHTML += "<li><a href=producto/" + informacion[i].id + "><p>" + informacion[i].name + "</p></a></li>";

            }
        }
    })
    .catch(function(e) {
        document.querySelector("h1#error").innerText = "Error. Intente luego nuevamente.";
        console.log(e);
    })
}
