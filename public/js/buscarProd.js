window.addEventListener("load", function() {

    var form_buscador = document.querySelector('form#formBuscar')
    var container_resultados = document.querySelector('div#resultados')

    var accion_original = form_buscador.action;
    var input_buscador = document.querySelector('input#buscador')
    var submit_buscador = document.querySelector('a#submit_buscador')
    var ul_resultados_1 = document.querySelector('ul#resultados_1');
    var ul_resultados_2 = document.querySelector('ul#resultados_2');
    var ul_resultados_3 = document.querySelector('ul#resultados_3');
    var h1_error = document.querySelector("h1#error");

    form_buscador.addEventListener('input', function(event) {
        if (input_buscador.value == '')
        {
            container_resultados.style.display = 'none';
            ul_resultados_1.innerHTML = '';
            ul_resultados_2.innerHTML = '';
            ul_resultados_3.innerHTML = '';
            h1_error.innerText = '';

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
    fetch("http://localhost:8000/api/products")
    // fetch("http://deco-enfant.dhalumnos.com/api/products", {
    //     headers: {
    //       'Access-Control-Allow-Origin': '*'
    //     },
    //   })
    .then(function(respuesta) {
        return respuesta.json()
    })
    .then(function(informacion)
    {
        var form_buscador = document.querySelector('form#formBuscar')
        var container_resultados = document.querySelector('div#resultados')
        var input_buscador = document.querySelector('input#buscador')

        var ul_resultados_1 = document.querySelector('ul#resultados_1');
        var ul_resultados_2 = document.querySelector('ul#resultados_2');
        var ul_resultados_3 = document.querySelector('ul#resultados_3');
        var h1_error = document.querySelector("h1#error");

        ul_resultados_1.innerHTML = '';
        ul_resultados_2.innerHTML = '';
        ul_resultados_3.innerHTML = '';
        h1_error.innerText = '';

        for (var i = 0; i < informacion.length; i++)
        {
          console.log(form_buscador.getAttribute('action'));
            if (informacion[i].name.toLowerCase().indexOf(buscador.toLowerCase()) != -1)
            {
                container_resultados.style.display = 'block';

                if (i <= 10)
                {
                    ul_resultados_1.innerHTML += "<li class='p-2'><a href=/producto/" + informacion[i].id + ">" + informacion[i].name + "</a></li>";
                    continue;

                }

                if ((i > 10) && (i <= 20))
                {
                    ul_resultados_2.innerHTML += "<li class='p-2'><a href=/producto/" + informacion[i].id + ">" + informacion[i].name + "</a></li>";
                    continue;
                }

                if ((i > 20) && (i <= 29))
                {
                    ul_resultados_3.innerHTML += "<li class='p-2'><a href=/producto/" + informacion[i].id + ">" + informacion[i].name + "</a></li>";
                    continue;
                }

                if (i > 29)
                {
                    ul_resultados_3.innerHTML += "<li class='p-2'><a href=/productos/buscar/" + input_buscador.value + ">" + "Más resultados..." + "</a></li>";
                    break;
                }


            }
        }
    })
    .catch(function(e) {
        document.querySelector("h1#error").innerText = "Error. Intente luego nuevamente.";
        console.log(e);
    })
}

// window.addEventListener("load", function() {



//     get_api_data(masters_url).then(function(json_data){         //obtengo todos los países (masters)
//         fill_select(select_masters, json_data, master_val);})   //relleno el select de países

// })



// //recibe una url de una api, espera la respuesta y la devuelve en formato json
// async function get_api_data(url)
// {
//     const response  = await fetch(url, {});
//     const json_data = await response.json();

//     return json_data;
// }
