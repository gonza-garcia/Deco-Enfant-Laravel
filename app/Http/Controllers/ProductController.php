<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Product;
use App\Size;
use App\Color;
use App\Category;
use App\Subcategory;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $products = Product::paginate(8);
      $categories = Category::orderBy('name')->get();

    //   dd($products);

      $vac = compact("products", "categories");
      return view ("products",$vac);

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $prod)
    {
        $product = Product::find($prod->id);
        // dd($product->subcategory);

        $subcategory = Subcategory::select('subcategories.name')
        ->join('products', 'subcategory_id', '=', 'subcategories.id')
        ->where('subcategory_id', $prod->subcategory_id)
        ->first();
      //   dd($subcategory->name);

        $vac = compact("product", "subcategory");
        return view("product",$vac);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function search($buscado)
    {
        $products = Product::where('name', 'like', '%'.$buscado.'%')->get();
        $categories = Category::orderBy('name')->get();

      //   dd($products);

        $vac = compact("products", "categories");
        return view ("products",$vac);
    }

    public function destacados()
    {
        $products = Product::orderBy('created_at', 'desc')
        ->limit(8)
        ->get();

        // dd($products);

        $vac = compact("products");
        return view ("/index",$vac);
    }

    public function buscar() {
        return view("buscarProd");
    }

    public function api() {
        return Product::all();
    }
}
