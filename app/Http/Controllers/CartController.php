<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\User;
use Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $carts = Cart::paginate(8);;
        $openCart = Cart::all()->where('user_id', '=', Auth::User()->id)->where('status', '=', 0);

        // $vac = compact("openCarts");
        // return view("carts",$vac);
        return view('cart')->with('cart',$openCart);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
      //dd($req->cant);
      // dd($id);
      $product = Product::find($req->prodId);
      // dd($product);
      // dd($product->price);
      $newItem = new Cart();

      $newItem->name = $product->name;
      $newItem->short_desc = $product->short_desc;
      $newItem->long_desc = $product->long_desc;
      $newItem->price = $product->price;
      $newItem->thumbnail = $product->thumbnail;
      $newItem->discount = $product->discount;
      $newItem->size_id = $product->size_id;
      $newItem->color_id = $product->color_id;
      $newItem->subcategory_id = $product->subcategory_id;
      $newItem->cant =  $req->cant; //Vamos a hardcodear el número pero debería venir de un form o del array.
      $newItem->user_id = Auth::User()->id;


      $newItem->save();
      return redirect('/cart');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Cart::find($id);

        $item->cant = $request->cant;
        $item->save();

        return redirect('cart');

        // if($cant<$stock){
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $item = Cart::find($id);
      $item->delete();
      return redirect('cart');
    }

    public function closeCart()
    {
        //Traemos los carritos abiertos: status = 0;
        $openCart = Cart::all()->where('user_id', '=', Auth::User()->id)->where('status', '=', 0);
        //Identificamos cual es el último nro de carrito cerrado
        $cartNumber = Cart::max('cart_number');
        //Actualizamos carrito a "cerrado" y asignamos el nro de carrito a todos los items.
        foreach ($openCart as $item) {
            $item->cart_number = $cartNumber + 1;
            $item->status = 1;
            $item->save();
        }
        return view('thanks');
    }

    public function history()
    {
        $history = Cart::all()->where('user_id', '=', Auth::User()->id)->where('status', '=', 1)->groupBy('cart_number'); //Agrupamos por nro de carrito para mostrarlo en la vista.
        return view('history')->with('history', $history);
    }

    public function totalPrice() {

        $totalPrice = 0;
        $discTotal = 0;
        $noDiscTotal = 0;
        // $subtotal = 0;
        $openCart = Cart::all()->where('user_id', '=', Auth::User()->id)->where('status', '=', 0);

        foreach ($openCart as $item) {
            if($item->discount >= 25){
                $discTotal += ($item->price - ($item->discount/100*$item->price)) * $item->cant;
            }
        }
        foreach ($openCart as $item) {
            if($item->discount < 25){
                $noDiscTotal += $item->price * $item->cant;
            }
        }
        $totalPrice = $discTotal + $noDiscTotal;
        // dd($totalPrice);


        // $vac = compact("totalPrice", "openCart");
        return view("/cart")->with('cart', $openCart)->with('totalPrice', $totalPrice);
    }

    public function api() {
        return Cart::all();
    }

    public function single_cart_api($id){
        return Cart::find($id);
    }


}
