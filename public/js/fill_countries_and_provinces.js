//Rellena dos elementos select del DOM (Master y Slave) que se relacionan de 1 a N en una db.
//Cuando el select Master cambia de value, el select Slave se rellena con lo que corresponda a ese value.
//Se asumen 2 cosas:
//La tabla slaves tiene un campo (en este caso 'country_id') que referencia a un master de la tabla masters
//AMBAS tablas tienen un id 'id' y un nombre 'name'. Cambiar si se quiere abajo en la funcion fill_select

//Se necesitan los siguientes datos:
const master_selector = 'form#register select#country_id';      //El selector para capturar el select Master
const slave_selector  = 'form#register select#province_id';     //Lo mismo para el select Slave
// const masters_url     = 'http://deco-enfant.dhalumnos.com/api/countries';  //La url de la api que trae todos los países
// const slaves_url      = 'http://deco-enfant.dhalumnos.com/api/provinces';  //Esta debe traer las provs de TODOS los países
// const options         = {
//     headers: {
//       'Access-Control-Allow-Origin': '*'
//     },
//   };
const masters_url     = 'http://localhost:8000/api/countries';  //La url de la api que trae todos los países
const slaves_url      = 'http://localhost:8000/api/provinces';  //Esta debe traer las provs de TODOS los países
const master_id       = 'country_id';       //El nombre del campo de slaves por el cual se relaciona con masters

const master_val_selector = 'input#old_country_id';    //Selector del input que contiene el valor que se quiere..
const slave_val_selector  = 'input#old_province_id';   //..dejar seleccionado en ambos select

window.addEventListener('load', function()
{
    const select_masters    = document.querySelector(master_selector);
    const select_slaves     = document.querySelector(slave_selector);

    var master_val = document.querySelector(master_val_selector).value;  //Valores que se quiere dejar seleccionados,..
    var slave_val  = document.querySelector(slave_val_selector).value;   //..si no se quiere ninguno, setear en false

    var all_slaves = [];

    get_api_data(masters_url).then(function(json_data){         //obtengo todos los países (masters)
        fill_select(select_masters, json_data, master_val);})   //relleno el select de países

    get_api_data(slaves_url).then(function(json_data){          //obtengo las provincias (slaves) de TODOS los países
        all_slaves = json_data;                                 //guardo los datos en all_provinces
        select_masters.dispatchEvent(new Event('change'));})    //fuerzo el evento 'change' una vez traídas las provincias

    select_masters.addEventListener('change', function()        //agrego un CHANGE listener al select de países
    {
        var filtered = all_slaves.filter(function(slav){        //filtro del array de all_provinces..
            return slav[master_id] == select_masters.value;     //..sólo las del país seleccionado
        });

        fill_select(select_slaves, filtered, slave_val);        //..y relleno el select de provincias

        slave_val = false;                                      //cambio el valor para que después del primer change
    })                                                          //..no quede ninguna opcion seleccionada por default
})



//recibe un elemento select del DOM y le agrega nuevas Options que arma del array 'data'.
//Si se encuentra un selected_value, selecciona esa opcion, si no, deselecciona todo
function fill_select(select, data, selected_value)
{
    select.options.length = 0;                                  //vacío el select

    for (item of data)                                          //por cada item de data..
    {
        var option = new Option(item.name, item.id);            //creo una nueva opcion

        select.add(option);                                     //la agrego al select

        if (option.value == selected_value) option.selected = true;    //si su valor es el deseado la selecciono
    }

    if (!selected_value) select.selectedIndex = -1;             //si no se encuentra el valor deselecciono
}



//recibe una url de una api, espera la respuesta y la devuelve en formato json
async function get_api_data(url)
{
    const response  = await fetch(url, {});
    const json_data = await response.json();

    return json_data;
}
