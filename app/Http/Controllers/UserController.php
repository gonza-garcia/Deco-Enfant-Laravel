<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function api() {
        return User::all();
    }

    public function single_user_api($id){
        return User::find($id);
    }
}
