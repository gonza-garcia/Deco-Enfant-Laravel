<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Validator extends Model
{
    // public static function validarRegistro ($datos)
    // {
    //     $errores = [];
    //
    //     // USUARIO
    //     if (strlen($datos["user_name"]) == 0) {
    //         $errores["user_name"] = "Campo obligatorio";
    //     }
    //
    //     // FIRST NAME
    //     if (strlen($datos["first_name"]) == 0) {
    //         $errores["first_name"] = "Campo obligatorio";
    //     }
    //
    //     // LAST NAME
    //     if (strlen($datos["last_name"]) == 0) {
    //         $errores["last_name"] = "Campo obligatorio";
    //     }
    //
    //     // FECHA DE NACIMIENTO
    //     // if (strlen($datos["date_of_birth"]) == 0) {
    //     //     $errores["date_of_birth"] = "Campo obligatorio";
    //     // }
    //
    //     //TELEFONO - ver
    //     //campo vacio
    //     if (strlen($datos["phone"]) == 0) {
    //         // $errores["phone"] = "Campo obligatorio";
    //     }
    //     // ingresar solo numeros
    //     elseif (is_numeric($datos["phone"]) == false) {
    //         $errores["phone"] = "El campo solo acepta numeros";
    //     }
    //
    //     // EMAIL
    //     // campo vacio
    //
    //     if (strlen($datos["email"]) == 0) {
    //         $errores["email"] = "Campo obligatorio";
    //     }
    //     // formato email valido
    //     elseif (filter_var($datos["email"], FILTER_VALIDATE_EMAIL) == false) {
    //         $errores["email"] = "Ingrese un email válido";
    //     }
    //     // email ya registrado
    //     elseif(dbMysql::existeUsuario($datos["email"])){
    //         $errores["email"] = "El email ingresado ya se encuentra registrado";
    //     }
    //
    //     //PASSWORD
    //     //campo vacio
    //     if (strlen($datos["pass"]) == 0) {
    //         $errores["pass"] = "Campo obligatorio";
    //     }
    //     //campo vacio de reescribir contraseña
    //     elseif (strlen($datos["pass2"]) == 0) {
    //         $errores["pass2"] = "Por favor repita la contraseña";
    //     }
    //     //coincidencia en las dos contraseñas
    //     elseif ($datos["pass"] !== $datos["pass2"]) {
    //         $errores["pass2"] = "Las contraseñas no coinciden";
    //     }
    //
    //     return $errores;
    // }

    //recibe un array asociativo de datos y devuelve
    //un array asociativo de errores.
    public static function validarRegistro(Array $arrayDatos)
    {
      //completar los siguientes arrays con los keys de los campos Obligatorios, alfabéticos y númericos.
      $obligatorios = ["user_name","first_name","last_name","email","date_of_birth"];
      $alfabeticos = ["first_name","last_name"];
      $numericos = ["phone","price","stock","discount_off","sold"];

      $key_date = "date_of_birth";
      $key_email = "email";
      $key_pass = "pass";
      $key_pass2 = "pass2";

      $errores=[];

      foreach ($arrayDatos as $key => $dato)
      {
          //validar campos Obligatorios
          if (in_array($key, $obligatorios))
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
          if ((in_array($key, $alfabeticos))
              && (!Validator::es_castellano($dato)) && ($dato!=""))
          {
              $errores[$key] = "Este campo sólo puede contener letras.";
              continue;
          }

          //validar campos numéricos
          if ((in_array($key, $numericos))
              && (!ctype_digit($dato)) && ($dato!=""))
          {
              $errores[$key] = "Este campo sólo puede contener números.";
              continue;
          }

          //validar email
          if ($key === $key_email)
          {
              if (!filter_var($dato, FILTER_VALIDATE_EMAIL))
                  $errores[$key] = "El email debe ser del formato usuario@dominio.zzz.";
              elseif (dbMysql::existeUsuario($dato))
                  $errores[$key] = "Este email ya está en uso. Por favor elija uno distinto.";

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


    public static function validarLog ($datos)
    {
        $errores = [];

        if (strlen($datos["email"]) == 0)
            $errores["email"] = "Campo obligatorio";

        else if (filter_var($datos["email"], FILTER_VALIDATE_EMAIL) == false)
            $errores["email"] = "Ingrese un email válido.";

        else if(!dbMysql::existeUsuario($datos["email"]))
            $errores["email"] = "El email no existe";


        //PASSWORD
        //campo vacio
        if (strlen($datos["pass"]) == 0)
        {
            $errores["pass"] = "Campo obligatorio";
        }
        else
        {
            $usuario = dbMysql::buscarPorEmail($datos["email"]);

            if(!password_verify($datos["pass"], $usuario[0]->pass))
            {
                $errores["pass"] = "La contraseña es incorrecta.";
            }
        }

        return $errores;
    }

    // public static function validarLogin($datos){
    //   $errores =[];
    //   $datosFinales = [];
    //
    //   foreach ($datos as $posicion => $valor) {
    //     $datosFinales[$posicion] = trim($valor);
    //   }
    //   //email
    //   if(strlen($datosFinales["email"]) == 0){
    //     $errores["email"] = "Campo obligatorio";
    //   } else if (filter_var($datosFinales["email"], FILTER_VALIDATE_EMAIL) == false){
    //       $errores["email"] = "Ingrese un email válido.";
    //   // } else if(!existeElUsuario($datosFinales["email"])){
    //   //     $errores["email"] = "El email no existe";
    //   }
    //   //pass
    //   if(strlen($datosFinales["pass"]) == 0){
    //     $errores["pass"] = "Campo obligatorio";
    //   } else {
    //     $usuario = buscarPorEmail($datosFinales["email"]);
    //
    //     if(!password_verify($datosFinales["pass"], $usuario["password"])==false){
    //       $errores["pass"] = "La contraseña es incorrecta.";
    //     }
    //   }
    //   return $errores;
    // }

    public static function es_castellano(string $texto)
    {
        $array1 = ['á','é','í','ó','ú','ñ','ü']; //chars a reemplazar
        $array2 = ['a','e','i','o','u','n','u']; //chars de reemplazo

        $texto = str_replace($array1, $array2, $texto);

        return ctype_alpha($texto);
    }
}
