<?php

//recibe un string y lo devuelve en minúsculas sin
//espacios ni tildes ni eñes
function formatearTexto($texto)
{
  $array1 = ['á','é','í','ó','ú','ñ','ü',' ']; //chars a reemplazar
  $array2 = ['a','e','i','o','u','n','u',''];  //chars de reemplazo

  $texto = mb_strtolower ($texto);  //pasa todo a minúscula
  $texto = str_replace($array1, $array2 ,$texto);

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
function validarGonza($arrayDatos)
{
  $name = "name";             //completar estas variables segun los
  $lastName = "lastName";     //nombres usados como 'keys' en el
  $email = "email";           //array asociativo $arrayDatos.
  $pass = "pass";
  $rePass = "rePass";
  $date = "fechaIngreso";

  $errores=[];

  foreach ($arrayDatos as $key => $value)
  {
    //validar campos requeridos (agregar al [...] según necesario)
    if (existeEnArray($key, [$name,$lastName,$email,$date]))
    {
      if (!$value)
        $errores[$key] = "Este campo no puede estar vacío.";
      else if ($value !== trim($value))
        $errores[$key] = "Este campo no puede contener espacios vacíos al principio o final.";
    }

    if (!isset($errores[$key]))  //si todavía no hay errores...
    {
    //validar campos alfabéticos
      if (($key === $name) || ($key === $lastName))
        if (!ctype_alpha(formatearTexto($value)))
          $errores[$key] = "Este campo sólo puede contener letras.";

    //validar campos numéricos
      if (existeEnArray($key, []))
        if (!ctype_digit($value))
          $errores[$key] = "Este campo sólo puede contener números.";

    //validar email
      if ($key === $email)
        if (!filter_var($value, FILTER_VALIDATE_EMAIL))
          $errores[$key] = "El email debe ser del formato usuario@dominio.***.";

    //validar pass
      if ($key === $pass)
        if (!$value)
          $errores[$key] = "Este campo no puede estar vacío.";
        else if ($arrayDatos[$pass] !== $arrayDatos[$rePass])
            $errores[$rePass] = "Las contraseñas no coinciden.";

    //validar fecha
      if ($key === $date)
      {
        $arra = explode('/', $value); //divide $value en un array

        if ((ctype_digit(implode($arra)) && (count($arra) === 3)))
        {
          if (!checkdate($arra[1], $arra[0], $arra[2]))
            $errores[$key] = "La fecha es inválida";
        }
        else  //si $arra contiene letras o no tiene 3 campos
          $errores[$key] = "La fecha es inválida o no tiene el formato correcto dd/mm/yyyy.";
      }

    }  //end if
  }   //end foreach

  return $errores;
}  //end function validar()

$usuarios =
  [
    "id" => "user_001",
    "name" => "f f",
    "lastName" => "dsf",
    "edad" => "32",
    "sexo" => "F",
    "email" => "asdofsdfoi@hotmail.com",
    "imagen" => "./img/users/user_001.jpg",
    "fechaIngreso" => "1/1/2018",
    "compras" => 365435,
    "pass" => "dsfgsdf",
    "rePass" => "dsfgsdf",
  ];

  var_dump(validar($usuarios));


?>
