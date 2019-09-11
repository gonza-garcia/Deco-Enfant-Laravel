<?php

namespace App\Http\Controllers;

use Auth;
use App\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{

    //Display a listing of the resource.                    --gets: void --returns: Response
    public function index()
    {
        $cart = \App\Cart::all()->where('user_id', Auth::User()->id)
                                ->where('status', 0);

        return view('cart', compact('cart'));
    }



    //Show the form for creating a new resource.            --gets: void --returns: Response
    public function create()
    {

    }



    //Store a newly created resource in storage.            --gets: Request --returns: Response
    public function store(Request $req)
    {
      //dd($req->cant);
      // dd($id);
      $product = \App\Product::find($req->prodId);
      // dd($product);
      // dd($product->price);
      $newItem = new Cart();

      $newItem->name = $product->name;
      $newItem->short_desc = $product->short_desc;
      $newItem->long_desc = $product->long_desc;
      $newItem->thumbnail = $product->thumbnail;
      $newItem->price = $product->price;
      $newItem->discount = $product->discount;
      $newItem->color_id = $product->color_id;
      $newItem->size_id = $product->size_id;
      $newItem->subcategory_id = $product->subcategory_id;
      $newItem->cant =  $req->cant; //Vamos a hardcodear el número pero debería venir de un form o del array.
      $newItem->user_id = Auth::User()->id;


      $newItem->save();
      return redirect('/cart');

    }



    //Display the specified resource.                       --gets: Cart --returns: Response
    public function show(Cart $cart)
    {

    }



    //Show the form for editing the specified resource.     --gets: Cart --returns: Response
    public function edit(Cart $cart)
    {

    }



    //Update the specified resource in storage.             --gets: Request, Cart --returns: Response
    public function update(Request $request, Cart $cart)
    {
        $cart->cant = $request->cant;
        $cart->save();

        return redirect('cart');
    }


    //Remove the specified resource from storage.           --gets: Cart --returns: Response
    public function destroy(Cart $cart)
    {
      $cart->delete();

      return redirect('cart');
    }



    public function closeCart()
    {
        //Traemos los carritos abiertos (con status = 0)
        $openCarts = Cart::all()->where('user_id', Auth::User()->id)
                                ->where('status', 0);

        //Identificamos cual es el último nro de carrito cerrado
        $cartNumber = Cart::max('cart_number');

        //Actualizamos carrito a "cerrado" y asignamos el nro de carrito a todos los items.
        foreach ($openCarts as $cart)
        {
            $cart->cart_number = $cartNumber + 1;
            $cart->status = 1;
            $cart->save();
        }

        return view('thanks');
    }



    public function history()
    {
        $history = Cart::all()->where('user_id', '=', Auth::User()->id)->where('status', '=', 1)->groupBy('cart_number'); //Agrupamos por nro de carrito para mostrarlo en la vista.
        return view('history')->with('history', $history);
    }



    public function totalPrice()
    {
        $totalPrice = 0;
        $discTotal = 0;
        $noDiscTotal = 0;
        $openCarts = Cart::all()->where('user_id', Auth::User()->id)
                                ->where('status', 0);

        foreach ($openCarts as $cart)
        {
            if($cart->discount < 25)
                $noDiscTotal += $cart->price * $cart->cant;
            else
                $discTotal += ($cart->price - ($cart->discount/100*$cart->price)) * $cart->cant;
        }

        $totalPrice = $discTotal + $noDiscTotal;

        return view("/cart", compact('openCarts', 'totalPrice'));
    }


}
