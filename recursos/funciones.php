<?php

function validarRegistro($datos){
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
    elseif (filter_var($datos["email"], FILTER_VALIDATE_EMAIL) == false) {
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
function lastId(){
    $json = file_get_contents("recursos/db.json");
    $array = json_decode($json, true);
  
      if($json==""){
        return $lastId=0;
      }
    $ultimoElemento = array_pop($array["usuarios"]);
  
    $lastId = $ultimoElemento["id"] + 1;
    return $lastId;
  }
  

// Armar array de usuario
function armarUsuario()
{
    return [
        "id" => lastId(), // resultado de lastId()
        "nombre" => trim($_POST["nombre"]),
        "telefono" => trim($_POST["telefono"]),
        "email" => trim($_POST["email"]),
        "password" => password_hash($_POST["pass"], PASSWORD_DEFAULT),
    ];
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

//buscar por email para comprobar que el usuario no este ya registrado
function buscarPorEmail($email){
    if(!file_exists("recursos/db.json")){
        $usuarios = "";
    }
    else {
        $usuarios = file_get_contents("recursos/db.json");
    }

    if($usuarios == ""){
        return null;
    }

    $array = json_decode($usuarios, true);

    foreach ($array["usuarios"] as $usuario) {
        if ($email === $usuario["email"]) { 
            return $usuario;
        } // aca iría un else?
        return null;
    }
}

function existeUsuario($email){
    return buscarPorEmail($email) !== null;
}
