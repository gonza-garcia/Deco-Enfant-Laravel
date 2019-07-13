window.addEventListener("load", function() {
    

    document.querySelector("form").onsubmit = function(evento) {
        evento.preventDefault()
        var buscador = document.querySelector(".buscar").value
        buscarProds(buscador)
    }
})

function buscarProds(buscador) {
    fetch("http://localhost:8000/api/productos")
    .then(function(respuesta) {
        return respuesta.json()
    })
    .then(function(informacion) {
        document.querySelector(".resultados").innerHTML = ""
        // console.log(informacion);
        for (var i = 0; i < informacion.length; i++) {
            // console.log(informacion[i].name.indexOf(buscador));
            if (informacion[i].name.indexOf(buscador) != -1) {
              document.querySelector(".resultados").innerHTML += "<li><a href=producto/" + informacion[i].id + "><p>" + informacion[i].name + "</p></a></li>"
              // document.querySelector(".resultados").innerHTML += "<li><a href=" + informacion[i].thumbnail + "><p>" + informacion[i].name + "</p><img src=" + informacion[i].thumbnail + "></a></li>"
            }
        }
    })
    .catch(function(e) {
        document.querySelector("h1").innerText = "Error. Intente luego nuevamente."
    })
}





// window.addEventListener("load", function() {
//     document.querySelector("form").onsubmit = function(evento) {
//         evento.preventDefault()
//         var buscador = document.querySelector(".buscar").value
//         buscarProds(buscador)
//     }
// })
//
// function buscarProds(buscador) {
//     fetch("http://localhost:8000/api/productos")
//     .then(function(respuesta) {
//         return respuesta.json()
//     })
//     .then(function(informacion) {
//         document.querySelector(".resultados").innerHTML = ""
//         // console.log(informacion);
//         for (var i = 0; i < informacion.length; i++) {
//             // console.log(informacion[i].name.indexOf(buscador));
//             if (informacion[i].name.indexOf(buscador) != -1) {
//               document.querySelector(".resultados").innerHTML += "<li><a href=producto/" + informacion[i].id + "><p>" + informacion[i].name + "</p></a></li>"
//               // document.querySelector(".resultados").innerHTML += "<li><a href=" + informacion[i].thumbnail + "><p>" + informacion[i].name + "</p><img src=" + informacion[i].thumbnail + "></a></li>"
//             }
//         }
//     })
//     .catch(function(e) {
//         document.querySelector("h1").innerText = "Error. Intente luego nuevamente."
//     })
// }
