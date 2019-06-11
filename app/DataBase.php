<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

abstract class DataBase extends Model
{
    public abstract static function guardarUsuario(User $user);
    public abstract static function buscarPorEmail(string $email);
}
