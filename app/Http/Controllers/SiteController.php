<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Cart;
use Auth;


class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $products = \App\Product::paginate(8);
        $categories = \App\Category::all();

        return view ('products', compact('products','categories'));
    }


    public function contacto(){
        $mensaje = '';
        return view('/contacto', compact('mensaje'));
    }

    public function mensaje(){
        $mensaje = 'Su consulta ha sido enviada. Muchas gracias';
        return view('/contacto', compact('mensaje'));
    }

    public function perfil($id){
        // $history = \App\Cart::all()->where('user_id', '=', $id)->where('status', '=', 1)->groupBy('cart_number'); //Agrupamos por nro de carrito para mostrarlo en la vista.
        $history = Cart::all()->where('user_id', '=', Auth::User()->id)->where('status', '=', 1)->groupBy('cart_number');
        // dd($history[0]);//Agrupamos por nro de carrito para mostrarlo en la vista.
        return view('perfil',compact('history'));
    }
}
