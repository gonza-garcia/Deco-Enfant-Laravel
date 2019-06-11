<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Auth;
use App\dbMysql;
use App\Category;
use App\User;
use App\Validator;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::skip(0)->take(8)->get();
        $auth = new Auth();

        // dd(collect(DB::select("SELECT name FROM categories WHERE id=29")));

        return view("home", compact("auth", "products"));
    }



    public function registro()
    {
        $auth = new Auth;

        if($auth->usuarioLogueado()) {
          header("Location:".route('/'));
          exit;
        }

        $errores = [];
        $user_nameOk = "";
        $first_nameOk = "";
        $last_nameOk = "";
        $date_of_birthOk = "";
        $phoneOk = "";
        $emailOk = "";
        // $sex_idOk = "";

        if (isset($_COOKIE["user"]))
            $emailOk = $_COOKIE["user"];

        if (isset($_COOKIE["first_name"]))
            $first_nameOk = $_COOKIE["first_name"];


        if ($_POST)
        {
            $errores = Validator::validarRegistro($_POST);
            $user_nameOk = $_POST["user_name"];
            $first_nameOk = $_POST["first_name"];
            $last_nameOk = $_POST["last_name"];
            $date_of_birthOk = $_POST["date_of_birth"];
            $phoneOk = $_POST["phone"];
            $emailOk = $_POST["email"];

            if (empty($errores))
            {
                if(!dbMysql::existeUsuario($_POST["email"]))
                {
                    $usuario = new User($_POST);

                    //Guardar usuario
                    dbMysql::guardarUsuario($usuario);

                    //redireccionar el usuario a la pagina de login.
                    setcookie("user",$emailOk, time() + 3 );
                    header("Location:".route('login'));
                    exit;
                }
                // else{
                //  return "el usuario ya existe";
                // }
            }
        }

        return view("registro", compact("auth","errores","user_nameOk","first_nameOk","last_nameOk","date_of_birthOk","phoneOk","emailOk"));

    }



    public function login()
    {
        $auth = new Auth();
        $usuario = [];

        if (isset($_GET["url"]))
        {
            $ultima_url = $_GET["url"];
        }

        if($auth->usuarioLogueado()){
            header("Location:".route('/'));
            exit;
        }

        $errores = [];
        $recordarOk = false;
        $emailOk = "";
        // if (isset($_COOKIE["user"])) {
        //   $emailOk = $_COOKIE["user"];
        //   $recordarOk = true;
        // } else {
          // $emailOk = "";
        //   $recordarOk = false;
        // }

        if ($_POST)
        {
            $emailOk = $_POST["email"];

            $errores = Validator::validarLog($_POST);

            if (empty($errores))
            {
                $usuario = new User($_POST);

                $recordarOk = (isset($_POST["recordar"]));

                if ($recordarOk)
                    setcookie("user", $emailOk);
                else
                    setcookie("user", null, time() -1);

                $auth->loguearUsuario($_POST["email"]);

                header("location:".route('/'));
                exit;

            }
            else
            {
                $errores["pass"] = "Usuario o contraseña inválida";
            }
        }

        return view("login", compact("auth","errores","recordarOk","emailOk","usuario"));
    }



    public function logout()
    {
        // session_start();
        if (!isset($_SESSION))
            session_start();

        session_destroy();

        header("Location:".route('/'));
        exit;
    }
}
