<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\User;

class dbMysql extends DataBase
{
    // protected $connection;

    function __construct()
    {
        // $dsn = "mysql:dbname=deco_enfant;host=127.0.0.1;port=3306";
        // $usuario= "root";
        // $pass = "";
        //
        // try {
        //     $this->conection = new PDO ($dsn, $usuario, $pass);
        //     $this->conection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //     // echo "Bienvenido. La base funciona bien";
        //
        // } catch (\Exception $e) {
        //     echo $e->getMessage();
        //     echo "Hubo un error <br>";
        //     exit;
        // }
    }

    public static function guardarUsuario(User $user)
    {
      // dd($user);
        $is_true = DB::insert('INSERT INTO users
          (id, user_name, first_name, last_name, date_of_birth, phone, email, password, role_id, sex_id, user_status_id) VALUES
          (default, :user_name, :first_name, :last_name, :date_of_birth, :phone, :email, :password, 2, 1, 1)',
          ['user_name' => $user->user_name,
          'first_name' => $user->first_name,
          'last_name' => $user->last_name,
          // 'date_of_birth' => date('Y-m-d', strtotime(str_replace('-', '/', $user->date_of_birth))),
          'date_of_birth' => (Carbon::createFromFormat('d/m/Y', $user->date_of_birth))->format('Y-m-d'),
          'phone' => $user->phone,
          'email' => $user->email,
          'password' => $user->password,
          ]);

        // dd($is_true);
        // // global $db;
        // $stmt = $this->connection->prepare("INSERT INTO users
        //   (id, user_name, first_name, last_name, date_of_birth, phone, email, pass, role_id) VALUES
        //   (default, :user_name, :first_name, :last_name, :date_of_birth, :phone, :email, :pass, 2)");
        //
        // $stmt->bindValue(":user_name", $user->getUser_name());
        // $stmt->bindValue(":first_name", $user->getFirst_name());
        // $stmt->bindValue(":last_name", $user->getLast_name());
        // $stmt->bindValue(":date_of_birth", $user->getDate_of_birth());
        // $stmt->bindValue(":phone", $user->getPhone());
        // $stmt->bindValue(":email", $user->getEmail());
        // $stmt->bindValue(":pass", $user->getPass());
        //
        // $stmt->execute();
    }


    public static function buscarPorId($id)
    {
        $stmt = $db->prepare("SELECT * FROM users WHERE id=:id");

        $stmt->bindValue(":id",  $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public static function buscarPorEmail(string $email)
    {
        // $stmt = $this->conection->prepare("SELECT * FROM users WHERE email = :email");
        // $stmt->bindValue(":email",$email);
        // $stmt->execute();
        // $consulta = $stmt->fetch(PDO::FETCH_ASSOC);
        // $user = User::where('email', '=', $email)->get();
        $user = DB::select("SELECT * FROM users WHERE email=?", [$email]);

        return $user;
        // // var_dump($consulta);
        // if(!$consulta)
        // {
        //     return null;
        // } else {
        //     $user = new User($consulta);
        //     return $user;
        // }
    }


    public static function existeUsuario($email)
    {
        return dbMysql::buscarPorEmail($email) != null;
    }

}
