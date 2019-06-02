<?php

  /**
   *
   */
  class Validator
  {

    public function validarRegistro ($datos) {
      $errores = [];
      // $datosFinales = []; //NO VEO QUE SE USE EN OTRO LADO.

      //TRIMEO - me parece que al final no se usa porque se trimea todo adento de la funcion armarUsuario(). O quizás no lo entiendo bien. Pero lo comento y anda todo.

      // foreach ($datos as $posicion => $valor) {
      //     $datosFinales[$posicion] = trim($valor);
      // }


      // USUARIO
      if (strlen($datos["user_name"]) == 0) {
          $errores["user_name"] = "Campo obligatorio";
      }

      // FIRST NAME
      if (strlen($datos["first_name"]) == 0) {
          $errores["first_name"] = "Campo obligatorio";
      }

      // LAST NAME
      if (strlen($datos["last_name"]) == 0) {
          $errores["last_name"] = "Campo obligatorio";
      }

      // FECHA DE NACIMIENTO
      // if (strlen($datos["date_of_birth"]) == 0) {
      //     $errores["date_of_birth"] = "Campo obligatorio";
      // }

      //TELEFONO - ver
      //campo vacio
      if (strlen($datos["phone"]) == 0) {
          // $errores["phone"] = "Campo obligatorio";
      }
      // ingresar solo numeros
      elseif (is_numeric($datos["phone"]) == false) {
          $errores["phone"] = "El campo solo acepta numeros";
      }


      // var_dump($datos["email"]);
      // var_dump($dbMysql);

      // EMAIL
      // campo vacio
      if (strlen($datos["email"]) == 0) {
          $errores["email"] = "Campo obligatorio";
      }
      // formato email valido
      elseif (filter_var($datos["email"], FILTER_VALIDATE_EMAIL) == false) {
          $errores["email"] = "Ingrese un email válido";
      }
      // email ya registrado
      // elseif($dbMysql->existeUsuario($datos["email"])){
      //     $errores["email"] = "El email ingresado ya se encuentra registrado";
      // }

      //PASSWORD
      //campo vacio
      if (strlen($datos["pass"]) == 0) {
          $errores["pass"] = "Campo obligatorio";
      }
      //campo vacio de reescribir contraseña
      elseif (strlen($datos["pass2"]) == 0) {
          $errores["pass2"] = "Por favor repita la contraseña";
      }
      //coincidencia en las dos contraseñas
      elseif ($datos["pass"] !== $datos["pass2"]) {
          $errores["pass2"] = "Las contraseñas no coinciden";
      }

      return $errores;
    }

    public function validarLog ($datos) {
      $errores = [];

      if (strlen($datos["email"]) == 0) {
          $errores["email"] = "Campo obligatorio";
      }
      //PASSWORD
      //campo vacio
      if (strlen($datos["pass"]) == 0) {
          $errores["pass"] = "Campo obligatorio";
      }
      return $errores;
    }
    public static function validarLogin($datos){
      $errores =[];
      $datosFinales = [];

      foreach ($datos as $posicion => $valor) {
        $datosFinales[$posicion] = trim($valor);
      }
      //email
      if(strlen($datosFinales["email"]) == 0){
        $errores["email"] = "Campo obligatorio";
      } else if (filter_var($datosFinales["email"], FILTER_VALIDATE_EMAIL) == false){
          $errores["email"] = "Ingrese un email válido.";
      // } else if(!existeElUsuario($datosFinales["email"])){
      //     $errores["email"] = "El email no existe";
      }
      //pass
      if(strlen($datosFinales["pass"]) == 0){
        $errores["pass"] = "Campo obligatorio";
      } else {
        $usuario = buscarPorEmail($datosFinales["email"]);

        if(!password_verify($datosFinales["pass"], $usuario["password"])==false){
          $errores["pass"] = "La contraseña es incorrecta.";
        }
      }

      return $errores;

    }
  }


 ?>
