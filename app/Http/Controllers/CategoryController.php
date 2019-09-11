<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Subcategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [ //https://laravel.com/docs/5.8/validation#rule-size
          // "id" => "integer|max:11|filled",
          "name" => "filled|string|max:100|unique:categories",
          "id_parent" => "integer|max:11|filled",
        ];
        $messages = [
          "filled" => "El campo :attribute no puede estar vacío.",
          "string" => "El campo :attribute debe ser texto.",
          "max" => "El campo :attribute tiene un máximo de :max",
          "unique" => "El campo :attribute debe ser unico.",
        ];
        $this->validate($request, $rules, $messages); //Son 3 arrays asociativos


        $categoriaNueva = new Category();

        $categoriaNueva->id = $request["id"];
        $categoriaNueva->name = $request["name"];
        $categoriaNueva->id_parent = $request["id_parent"];

        $categoriaNueva->save();

        return redirect("/categorias");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $myCategory)
    {
        $categories = Category::orderBy('name')->get();

        $products = Product::join('subcategories', 'subcategories.id', '=', 'subcategory_id')
        ->join('categories', 'categories.id', '=', 'category_id')
        ->where('category_id', '=', $myCategory->id)
        ->paginate(8);

        return view('products', compact('categories', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }

    public function delete(Request $request){
      $id = $request->id;
      $categoriaABorrar = Category::find($id);
      $categoriaABorrar->delete();
      return redirect("/categorias");
    }



}
