<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auth extends Model
{
    function __construct()
    {
        session_start();

        if (isset($_COOKIE["user"]) && isset($_SESSION["email"]) == false)
        {
            $_SESSION["email"] = $_COOKIE["user"];
        }

        // if (isset($_COOKIE["user"])) {
        //   $emailOk = $_COOKIE["user"];
        //   $recordarOk = true;
        // } else {
        //   $emailOk = "";
        //   $recordarOk = false;
        // }

    }


    function loguearUsuario($email)
    {
        global $dbMysql;

        $user_name = dbMysql::buscarPorEmail($email)[0]->user_name;
        $_SESSION["user_name"] = $user_name;
        $_SESSION["email"] = $email;
    }

    function usuarioLogueado()
    {
        return isset($_SESSION["user_name"]);
    }
}