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
  $key_name = "nombre";        //completar estas variables segun los
  $key_lastName = "apellido";  //nombres usados como 'keys' en
  $key_email = "email";        //$arrayDatos pasado como parámetro
  $key_pass = "pass";
  $key_rePass = "pass2";
  $key_date = "fechaNac";
  $key_phone = "telefono";

  $errores=[];

  foreach ($arrayDatos as $key => $dato)
  {
    //validar campos REQUERIDOS (agregar al [...] según necesario)
    if (existeEnArray($key, [$key_name,$key_lastName,$key_email,$key_date]))
    {
      if (!$dato)
        $errores[$key] = "Campo obligatorio.";
      else if ($dato !== trim($dato))
        $errores[$key] = "Este campo no puede contener espacios vacíos al principio o final.";
    }

    if (!isset($errores[$key]))  //si todavía no hay errores en key...
    {
    //validar campos alfabéticos
      if (($key === $key_name) || ($key === $key_lastName))
        if (!ctype_alpha(formatearTexto($dato)))
          $errores[$key] = "Este campo sólo puede contener letras.";

    //validar campos numéricos
      if (existeEnArray($key, [$key_phone]))
        if (!ctype_digit($dato))
          $errores[$key] = "Este campo sólo puede contener números.";

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
        else if (isset($arrayDatos[$key_rePass]))
              if ($arrayDatos[$key_pass] !== $arrayDatos[$key_rePass])
                $errores[$key_rePass] = "Las contraseñas no coinciden.";

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
        }
        else  //si $arra contiene letras o no tiene 3 campos
          $errores[$key] = "La fecha es inválida o no tiene el formato correcto dd/mm/yyyy.";

          continue;
      }

    }  //end if
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

//recibe array de $datos y devuelve un array modelado segun un usuario o un articulo. Luego SOLO los keys de $datos que coincidan con los keys del objeto modelado se van a pisar y a quedar con el valor de $datos.
function armarObjeto($datos, $tabla, $db)
{
  $objeto = [];

  if ($tabla === "usuarios"){ // si la $tabla es usuarios
    $objeto = [               //modelo el $objeto como un usuario
      "id" => nuevoId($tabla,$db),
      "nombre" => "",
      "apellido" => "",
      "email" => "",
      "fechaNac" => "",
      "fechaAlta" => date('Y/m/d H:i:s a', time()),
      "domicilio" => "",
      "telefono" => "",
      "rol_id" => 2, // 2 es 'usuario normal' en la db
      "pass" => "",
    ];
  }
  else if ($tabla === "articulos"){ //si la $tabla es articulos
    $objeto = [               //modelo el $objeto como un artículo
      "id" => nuevoId($tabla,$db),
      "titulo" => "",
      "descripcion" => "",
      "medidas" => "",
      "precio" => "",
      "imagen" => "",
      "fechaAlta" => date('Y/m/d H:i:s a', time()),
      "cuotas" => "",
      "descuento" => "",
      "categoriaPadre_id" => 0, // 0 es 'sin padre' en la db
    ];
  }

  foreach ($objeto as $key => $value)
  {
    if (($key==="pass") && isset($datos["pass"]))
    {
      $objeto[$key] = password_hash($datos[$key], PASSWORD_DEFAULT);
      continue;
    }

    if (isset($datos[$key]))         //solo se van a pisar los campos
      $objeto[$key] = $datos[$key]; // si los keys coindicen, los que
  }                              //no coincidan no se tienen en cuenta

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


//devuelve el objeto buscado si el datoBuscado coincide
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
      if ($columna === "")   //si $columna vacia, devuelve $tabla
        return $arrayDB[$tabla];
      elseif ($datoBuscado === "")  //si dato vacio devuelve $columna
              return $arrayDB[$tabla][$columna];
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


?>
