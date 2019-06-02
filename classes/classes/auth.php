<?php

/**
 *
 */
class Auth
{

  function __construct()
  {
    session_start();
    // pasar email de la cookie a session
  }

  function loguearUsuario($email,$user_name) {
    $_SESSION["email"] = $email;
    $_SESSION["user_name"] = $user_name;
  }

  function usuarioLogueado()  {
    return isset($_SESSION["email"]);
  }

}


 ?>
