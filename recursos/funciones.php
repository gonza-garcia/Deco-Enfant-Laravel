<?php

session_start();


function usuarioLogueado()
{
    return isset($_SESSION["email"]);
}

function get_current_url()
{
    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

    $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    return $url;
}

//recibe un string y lo devuelve en minúsculas sin
//espacios ni tildes ni eñes
function formatearTexto($texto)
{
    $array1 = ['á','é','í','ó','ú','ñ','ü',' ']; //chars a reemplazar
    $array2 = ['a','e','i','o','u','n','u',''];  //chars de reemplazo

    $texto = mb_strtolower ($texto);  //pasa todo a minúscula
    $texto = str_replace($array1, $array2 ,$texto);
    //TRIMEO - me parece que al final no se usa porque se trimea todo adento de la funcion armarUsuario(). O quizás no lo entiendo bien. Pero lo comento y anda todo.

    return $texto;
}


//busca si existe un string $palabra dentro de un array de
//strings $array y devuelve true o false
function existeEnArray($palabra, $array)
{
  foreach ($array as $key => $value)
    if ($value === $palabra)
      return true;

  return false;
}


//recibe un array asociativo de datos y devuelve
//un array asociativo de errores.
function validarDatos($arrayDatos)
{
  //completar los siguientes arrays con los keys de los campos Obligatorios, alfabéticos y númericos.
  $obligatorios = ["nombre","apellido","email","fechaNac","titulo"];
  $alfabeticos = ["nombre","apellido"];
  $numericos = ["telefono","precio","cantidad","cuotas","descuento", "vendidos"];

  $key_date = "fechaNac";
  $key_email = "email";
  $key_pass = "pass";
  $key_pass2 = "pass2";

  $errores=[];

  foreach ($arrayDatos as $key => $dato)
  {
      //validar campos Obligatorios
      if (existeEnArray($key, $obligatorios))
      {
          if (!$dato){
              $errores[$key] = "Campo obligatorio.";
              continue;
          }
          else if ($dato !== trim($dato)){
              $errores[$key] = "Este campo no puede contener espacios vacíos al principio o final.";
              continue;
          }
      }
      //validar campos alfabéticos
      if ((existeEnArray($key, $alfabeticos))
          && (!ctype_alpha(formatearTexto($dato))))
      {
          $errores[$key] = "Este campo sólo puede contener letras.";
          continue;
      }

      //validar campos numéricos
      if ((existeEnArray($key, $numericos))
          && (!ctype_digit($dato)))
      {
          $errores[$key] = "Este campo sólo puede contener números.";
          continue;
      }

      //validar email
      if ($key === $key_email)
      {
          if (!filter_var($dato, FILTER_VALIDATE_EMAIL))
              $errores[$key] = "El email debe ser del formato usuario@dominio.zzz.";
          elseif (existeObjeto("recursos/db.json","usuarios",$key,$dato))
              $errores[$key] = "Ya existe un usuario con este email. Elija un email distinto";

          continue;
      }

      //validar pass
      if ($key === $key_pass)
      {
          if (!$dato)
              $errores[$key] = "Por favor ingrese su contraseña.";
          else if (isset($arrayDatos[$key_pass2]))
              if ($arrayDatos[$key_pass] !== $arrayDatos[$key_pass2])
                $errores[$key_pass2] = "Las contraseñas no coinciden.";

          continue;
      }

      //validar fecha
      if ($key === $key_date)
      {
          $arra = explode('/', $dato); //divide $dato en un array

          if (ctype_digit(implode($arra)) && (count($arra) === 3))
          {
              if (!checkdate($arra[1], $arra[0], $arra[2]))
                  $errores[$key] = "La fecha es inválida";
              continue;
          }
          else  //si $arra contiene letras o no tiene 3 campos
              $errores[$key] = "La fecha es inválida o no tiene el formato correcto dd/mm/yyyy.";
      }

  }   //end foreach

  return $errores;
}  //end function validar()



// funcion para que retorne e ingrese en armarUsuarrio() el ultimo id+1
function nuevoId($tabla, $db)
{
    $json = file_get_contents($db);
    $array = json_decode($json, true);

    $ultimoObjeto = array_pop($array[$tabla]);
    $nuevoId = $ultimoObjeto["id"];

    if ($nuevoId!==0)
        $nuevoId++;

    return $nuevoId;
}


function obtenerModelo($tabla, $modeloVacio = false)
{
  $modelo = [];

  switch ($tabla)
  {
    case 'users':
        $modelo = [ //el booleano determina si es editable o no
          "id"            => ["label_title"   => "Id",
                              "input_type"    => "text",
                              "is_editable"   => false,
                              "foreign_table" => ""],
          "email"         => ["label_title"   => "E-Mail",
                              "input_type"    => "email",
                              "is_editable"   => false,
                              "foreign_table" => ""],
          "pass"          => ["label_title"   => "Contraseña",
                              "input_type"    => "password",
                              "is_editable"   => false,
                              "foreign_table" => ""],
          "username"      => ["label_title"   => "Nombre De Usuario",
                              "input_type"    => "text",
                              "is_editable"   => true,
                              "foreign_table" => ""],
          "first_name"    => ["label_title"   => "Nombre",
                              "input_type"    => "text",
                              "is_editable"   => true,
                              "foreign_table" => ""],
          "last_name"     => ["label_title"   => "Apellido",
                              "input_type"    => "text",
                              "is_editable"   => true,
                              "foreign_table" => ""],
          "sex_id"        => ["label_title"   => "Sexo",
                              "input_type"    => "select",
                              "is_editable"   => true,
                              "foreign_table" => "sex"],
          "dateOfBirth"   => ["label_title"   => "Fecha De Nacimiento",
                              "input_type"    => "text",
                              "is_editable"   => true,
                              "foreign_table" => ""],
          "dateRegister"  => ["label_title"   => "Fecha De Alta",
                              "input_type"    => "text",
                              "is_editable"   => false,
                              "foreign_table" => ""],
          "dateUpdate"    => ["label_title"   => "Fecha Update",
                              "input_type"    => "text",
                              "is_editable"   => false,
                              "foreign_table" => ""],
          "userStatus_id" => ["label_title"   => "Estado",
                              "input_type"    => "select",
                              "is_editable"   => true,
                              "foreign_table" => "userstatus"],
          "role_id"       => ["label_title"   => "Rol",
                              "input_type"    => "select",
                              "is_editable"   => true,
                              "foreign_table" => "roles"],
        ];
        break;

    case 'products':
        $modelo = [ //el booleano determina si es editable o no
          "id"            => ["label_title"   => "Id",
                              "input_type"    => "text",
                              "is_editable"   => false,
                              "foreign_table" => ""],
          "title"         => ["label_title"   => "Título",
                              "input_type"    => "text",
                              "is_editable"   => true,
                              "foreign_table" => ""],
          "short_desc"    => ["label_title"   => "Descripción Corta",
                              "input_type"    => "text",
                              "is_editable"   => true,
                              "foreign_table" => ""],
          "long_desc"     => ["label_title"   => "Descripción Larga",
                              "input_type"    => "text",
                              "is_editable"   => true,
                              "foreign_table" => ""],
          "price"         => ["label_title"   => "Precio",
                              "input_type"    => "number",
                              "is_editable"   => true,
                              "foreign_table" => ""],
          "thumbnail"     => ["label_title"   => "Imagen",
                              "input_type"    => "text",
                              "is_editable"   => true,
                              "foreign_table" => ""],
          "color_id"      => ["label_title"   => "Color",
                              "input_type"    => "select",
                              "is_editable"   => true,
                              "foreign_table" => "colors"],
          "size_id"       => ["label_title"   => "Tamaño",
                              "input_type"    => "select",
                              "is_editable"   => true,
                              "foreign_table" => "sizes"],
          "stock"         => ["label_title"   => "Stock",
                              "input_type"    => "number",
                              "is_editable"   => true,
                              "foreign_table" => ""],
          "sold"          => ["label_title"   => "Vendidos",
                              "input_type"    => "number",
                              "is_editable"   => true,
                              "foreign_table" => ""],
          "dateUpload"    => ["label_title"   => "Fecha De Alta",
                              "input_type"    => "text",
                              "is_editable"   => false,
                              "foreign_table" => ""],
          "dateUpdate"    => ["label_title"   => "Fecha Update",
                              "input_type"    => "text",
                              "is_editable"   => true,
                              "foreign_table" => ""],
          "sale"          => ["label_title"   => "Venta",
                              "input_type"    => "text",
                              "is_editable"   => true,
                              "foreign_table" => ""],
          "discount_price"=> ["label_title"   => "Fecha De Alta",
                              "input_type"    => "text",
                              "is_editable"   => true,
                              "foreign_table" => ""],
          "discountOff"   => ["label_title"   => "Fecha Update",
                              "input_type"    => "text",
                              "is_editable"   => true,
                              "foreign_table" => ""],
          "categoria_id"  => ["label_title"   => "Categoría",
                              "input_type"    => "select",
                              "is_editable"   => true,
                              "foreign_table" => "categories"],
        ];
        break;

    default:
        break;
  }

  if($modeloVacio == true)       //si es necesario se deja el..
    foreach ($modelo as $key => $value)  //..objeto vacío
      $modelo[$key] = "";

  return $modelo;
}


//recibe array de $datos y devuelve un array modelado segun el nombre de la $tabla. Luego SOLO los keys de $datos que coincidan con los keys del objeto modelado se van a pisar y a quedar con el valor de $datos.
function armarObjeto($datos, $tabla)
{
    $objeto = obtenerModelo($tabla, true); //modelo el objeto según..
                              //..el tipo de $tabla y lo recibo vacío.
    foreach ($objeto as $key => $value)
    {
        if (($key==="pass") && isset($datos["pass"]))
        {
            $objeto[$key] = password_hash($datos[$key], PASSWORD_DEFAULT);
            continue;
        }

        if (isset($datos[$key]))  //solo se van a pisar los campos..
            $objeto[$key] = $datos[$key]; // ..si los keys de $datos..
                                  //..coindicen con los del objeto..
    }                              //..modelo, si no quedan vacíos.

    return $objeto;
}



function guardarObjeto($objeto, $tabla, $db)
{
    try
    {
        $json = file_get_contents($db);
        $array = json_decode($json, true);

        $array[$tabla][] = $objeto;
        $array = json_encode($array, JSON_PRETTY_PRINT);

        file_put_contents($db, $array);

        return true;
    }
    catch (\Exception $e)
    {
        return false;
    }
}


//devuelve el objeto buscado si el datoBuscado coincide.
//si no se recibe un dato buscado, devuelve $db[$tabla][$columna]
//si no se recibe una posicion, devuelve $db[$tabla]
function buscarObjeto($db, $tabla, $columna="", $datoBuscado="")
{
    if(file_exists($db))    //si existe la base de datos
    {
        $tempDB = file_get_contents($db);
        $arrayDB = json_decode($tempDB, true);

        if (isset($arrayDB[$tabla])) //si existe la clave
        {
            if ($columna === "")       //si no hay columna, devuelve..
                return $arrayDB[$tabla];    //..la tabla completa

            elseif ($datoBuscado === "")  //si no hay dato devuelve..
                return $arrayDB[$tabla][$columna]; //..todas las..
                                                  //..filas de..
                                                  //..la columna
            else
            {
                foreach ($arrayDB[$tabla] as $array)
                    if ((isset($array[$columna])) && ($datoBuscado == $array[$columna]))
                        return $array;
            }
        }
    }

    return null;
}


function existeObjeto($db,$tabla,$columna,$datoBuscado)
{
  return buscarObjeto($db,$tabla,$columna,$datoBuscado) !== null;
}


//ordena un array de arrays según los campos $field1 y $field2 y según los modificadores $mod1,2,3,4 que puede ser (SORT_ASC, SORT_DESC SORT_STRING,SORT_NUMERIC, etc, etc)
function ordenarArray(string $field1, $mod1,$mod2, $arrayToOrder)
{
  $args  = func_get_args(); //funcion hace un array de los argumentos
  $array = array_pop($args);
  if (! is_array($array)) return false;
  // Next we'll sift out the values from the columns we want to sort on, and put them in numbered 'subar' ("sub-array") arrays.
  //   (So when sorting by two fields with two modifiers (sort options) each, this will create $subar0 and $subar3)
  foreach($array as $key => $row)   // loop through source array
    foreach($args as $akey => $val) // loop through args (fields and modifiers)
      if(is_string($val))           // if the arg's a field, add its value from the source array to a sub-array
        ${"subar$akey"}[$key] = $row[$val];
  // $multisort_args contains the arguments that would (/will) go into array_multisort(): sub-arrays, modifiers and the source array
  $multisort_args = array();
  foreach($args as $key => $val)
    $multisort_args[] = (is_string($val) ? ${"subar$key"} : $val);
  $multisort_args[] = &$array;   // finally add the source array, by reference
  call_user_func_array("array_multisort", $multisort_args);
  return $array;
}



function tipoEspecial($tabla,$key,$tipo){




}

?>
