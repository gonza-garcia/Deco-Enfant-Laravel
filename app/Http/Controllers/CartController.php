<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
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
        //
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
    public function store($id)
    {
      // dd($id);
      $product = Product::find($id);
      dd($product);

      $newItem = new Cart();

      $newItem->name = $product->name;
      $newItem->short_desc = $product->short_desc;
      $newItem->long_desc = $product->long_desc;
      $newitem->price = $product->price;
      $newItem->thumbnail = $product->thumbnail;
      $newitem->discount_off = $product->discount_off;
      $newitem->size_id = $product->size_id;
      $newitem->color_id = $product->color_id;
      $newitem->category_id = $product->category_id;
      $newItem->cant =  1; //Vamos a hardcodear el número pero debería venir de un form o del array.
      $newItem->user_id = Auth::User()->id;

      dd($newItem);
      $newItem->save();
      return('/productos');

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
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
