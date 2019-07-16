
window.addEventListener("load", function() {

      var $_GET = {};
      if(document.location.toString().indexOf('?') !== -1)
      {
          var query = document.location
                         .toString()
                         // get the query string
                         .replace(/^.*?\?/, '')
                         // and remove any existing hash string (thanks, @vrijdenker)
                         .replace(/#.*$/, '')
                         .split('&');

          for(var i=0, l=query.length; i<l; i++) {
             var aux = decodeURIComponent(query[i]).split('=');
             $_GET[aux[0]] = aux[1];
          }
      }

      var add_form = document.querySelector('form#add_' + $_GET['table'] + '_form')
      var edit_form = document.querySelector('form#edit_' + $_GET['table'] + '_form')

      // add_form.addEventListener('submit', function (e) {
      //     e.preventDefault;
      //     var reader = new FileReader();
      //     var file    = document.querySelector('input#browseForAdd').files[0];
      //
      //     if (file) {
      //       console.log(file);
      //         reader.readAsDataURL(file);
      //     } else {
      //         preview.src = "";
      //     }
      //
      // })

      var rows = document.querySelectorAll('table tbody tr');

      for (var i=0; i < rows.length; i++)
      {
          rows[i].querySelector('td a#edit').addEventListener('click',function(e){
              fetch('http://localhost:8000/api/' + $_GET['table'] + '/' + this.getAttribute('value'))
              .then(function(respuesta) {
                  return respuesta.json()
              })
              .then(function(item)
              {
                  var campos_editables = edit_form.querySelectorAll('.campo_editable');
                  var campos_no_editables = edit_form.querySelectorAll('.campo_no_editable')

                  for (var i=0; i < campos_editables.length; i++)
                  {
                      campos_editables[i].value = item[campos_editables[i].name];
                  }
                  for (var i=0; i < campos_no_editables.length; i++)
                  {
                      campos_no_editables[i].value = item[campos_no_editables[i].name];
                  }

                  edit_form.action = edit_form.action + item.id;


              })
              .catch(function(e) {
                  // document.querySelector("h1#error").innerText = "Error. Intente luego nuevamente.";
                  console.log(e);
              })

          })

          // console.log(rows[i].getAttribute('id'))
      }











//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//::::::::::::::::::::::::::::Script para que funcionen los Checkboxes::::::::::::::::::::::::::


// var a = document.querySelector('a[data-toggle=tooltip]')
// console.log(a.tooltip())

  $(document).ready(function(){
      // // Activate tooltip
      // $('[data-toggle="tooltip"]').tooltip();

      // Select/Deselect checkboxes
      var checkbox = $('table tbody input[type="checkbox"]');
      $("#selectAll").click(function(){
          if(this.checked){
              checkbox.each(function(){
                  this.checked = true;
              });
          } else{
              checkbox.each(function(){
                  this.checked = false;
              });
          }
      });
      checkbox.click(function(){
          if(!this.checked){
              $("#selectAll").prop("checked", false);
          }
      });
  });




})


function previewFileForAdd() {
    var preview = document.querySelector('img#previewForAdd');
    var file    = document.querySelector('input#browseForAdd').files[0];
    var reader  = new FileReader();

    reader.onloadend = function () {
      preview.src = reader.result;
    }

    if (file) {
      reader.readAsDataURL(file);
    } else {
      preview.src = "";
    }
}

function previewFileForEdit() {
    var preview = document.querySelector('img#previewForEdit');
    var file    = document.querySelector('input#browseForEdit').files[0];
    var reader  = new FileReader();

    reader.onloadend = function () {
      preview.src = reader.result;
      // document.querySelector('input#browseForEdit').value = './img/products/' + file.name;
      console.log(document.querySelector('input#browseForEdit').value)
    }

    if (file) {
      reader.readAsDataURL(file);
    } else {
      preview.src = "";
    }
}
