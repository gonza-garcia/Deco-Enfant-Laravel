<?php

session_start();
// var_dump($_SESSION);

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
  $key_name = "nombre";            //completar estas variables segun los
  $key_lastName = "apellido";    //nombres usados como 'keys' en
  $key_email = "email";          //$arrayDatos pasado como parámetro
  $key_pass = "pass";
  $key_rePass = "pass2";
  $key_date = "date";
  $key_phone = "phone";

  $errores=[];

  foreach ($arrayDatos as $key => $dato)
  {
    //validar campos requeridos (agregar al [...] según necesario)
    if (existeEnArray($key, [$key_name,$key_lastName,$key_email,$key_date]))
    {
      if (!$dato)
        $errores[$key] = "Campo obligatorio.";
      else if ($dato !== trim($dato))
        $errores[$key] = "Este campo no puede contener espacios vacíos al principio o final.";
    }

    if (!isset($errores[$key]))  //si todavía no hay errores...
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
      if ($key === $key_email){
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
function nuevoId($categoria, $db)
{
  $json = file_get_contents($db);
  $array = json_decode($json, true);

  $ultimoObjeto = array_pop($array[$categoria]);
  $nuevoId = $ultimoObjeto["id"];

  if ($nuevoId!==0)
    $nuevoId++;

  return $nuevoId;
}



function armarObjeto($datos, $categoria, $db)
{
  $objeto = [];

  foreach ($datos as $key => $dato)
  {
    if ($key==="pass2" || $key==="submit")
      continue;

    if ($key==="pass"){
      $objeto[$key] = password_hash($dato, PASSWORD_DEFAULT);
      continue;
    }

    $objeto[$key] = $dato;
  }

  if (!$objeto)
    $objeto["id"] = nuevoId($categoria,$db);

  return $objeto;
}




function guardarObjeto($objeto, $categoria, $db)
{
  try
  {
    $json = file_get_contents($db);
    $array = json_decode($json, true);

    $array[$categoria][] = $objeto;
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
//si no se recibe un dato buscado, devuelve $db[$categoria][$posicion]
//si no se recibe una posicion, devuelve $db[$categoria]
function buscarObjeto($db, $categoria, $posicion="", $datoBuscado="")
{
  if(file_exists($db))    //si existe la base de datos
  {
    $tempDB = file_get_contents($db);
    $arrayDB = json_decode($tempDB, true);

    if (isset($arrayDB[$categoria])) //si existe la clave
    {
      if ($posicion === "")   //si $posicion vacia, devuelve $categoria
        return $arrayDB[$categoria];
      elseif ($datoBuscado === "")  //si dato vacio devuelve $posicion
              return $arrayDB[$categoria][$posicion];
      else
      {
        foreach ($arrayDB[$categoria] as $array)
          if ((isset($array[$posicion])) && ($datoBuscado === $array[$posicion]))
            return $array;
      }
    }
  }

  return null;
}


function existeObjeto($db,$categoria,$posicion,$datoBuscado)
{
  return buscarObjeto($db,$categoria,$posicion,$datoBuscado) !== null;
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






function validarRegistro($datos)
{
  $errores = [];
  $datosFinales = []; //NO VEO QUE SE USE EN OTRO LADO.

  //TRIMEO - me parece que al final no se usa porque se trimea todo adento de la funcion armarUsuario(). O quizás no lo entiendo bien. Pero lo comento y anda todo.

  // foreach ($datos as $posicion => $valor) {
  //     $datosFinales[$posicion] = trim($valor);
  // }


  // NOMBRE
  if (strlen($datos["nombre"]) == 0) {
    $errores["nombre"] = "Campo obligatorio";
  }

  //TELEFONO - ver
  //campo vacio
  if (strlen($datos["telefono"]) == 0) {
    $errores["telefono"] = "Campo obligatorio";
  }
  // ingresar solo numeros
  elseif (is_numeric($datos["telefono"]) == false) {
    $errores["telefono"] = "El campo solo acepta numeros";
  }

  // EMAIL
  // campo vacio
  if (strlen($datos["email"]) == 0) {
    $errores["email"] = "Campo obligatorio";
  }
  // formato email valido
  elseif (filter_var($datos["email"], FILTER_VALIDATE_EMAIL) == false)
  {
          $errores["email"] = "Ingrese un email válido";
  }
  // email ya registrado
  elseif(existeUsuario($datos["email"])){
    $errores["email"] = "El email ingresado ya se encuentra registrado";
  }

  //PASSWORD
  //campo vacio
  if (strlen($datos["pass"]) == 0) {
    $errores["pass"] = "Campo obligatorio";
  }
  //campo vacio de reescribir contraseña
  elseif (strlen($datos["pass2"]) == 0) {
    $errores["pass"] = "Por favor repita la contraseña";
  }
  //coincidencia en las dos contraseñas
  elseif ($datos["pass"] !== $datos["pass2"]) {
    $errores["pass"] = "Las contraseñas no coinciden";
  }

  return $errores;
}




// funcion para que retorne e ingrese en armarUsuarrio() el ultimo id+1
function lastId()
{
  $json = file_get_contents("recursos/db.json");
  $array = json_decode($json, true);

  if($json==""){
    return $lastId=0;
  }

  $ultimoElemento = array_pop($array["usuarios"]);

  $lastId = $ultimoElemento["id"] + 1;
  return $lastId;
}



//Guardar usuario nuevo en archivo JSON
function guardarUsuario($user)
{
  $json = file_get_contents("recursos/db.json");
  $array = json_decode($json, true);

  $array["usuarios"][] = $user;
  $array = json_encode($array, JSON_PRETTY_PRINT);

  file_put_contents("recursos/db.json", $array);
}

  // Armar array de usuario
function armarUsuario()
{
  return  [
          "id" => lastId(), // resultado de lastId()
          "nombre" => trim($_POST["nombre"]),
          "telefono" => trim($_POST["telefono"]),
          "email" => trim($_POST["email"]),
          "password" => password_hash($_POST["pass"], PASSWORD_DEFAULT),
          ];
}



//buscar por email para comprobar que el usuario no este ya registrado
function buscarPorEmail($email)
{
  if(!file_exists("recursos/db.json"))
    $usuarios = "";
  else
    $usuarios = file_get_contents("recursos/db.json");

  if($usuarios == "")
    return null;

  $array = json_decode($usuarios, true);

  foreach ($array["usuarios"] as $usuario)
  {
    if ($email === $usuario["email"])
      return $usuario;
  }

  return null;
}

function existeUsuario($email){
  return buscarPorEmail($email) !== null;
}

function usuarioLogueado(){
  return isset($_SESSION["email"]);
}

function listaDeUsuarios(){
  $json = file_get_contents("recursos/db.json");
  $array = json_decode($json, true);

  return $array;
}

function traerUsuarioLogueado(){
  if(isset($_SESSION["email"])){
  return buscarPorEmail($_SESSION["email"]);
  }
  return false;
}

?>
