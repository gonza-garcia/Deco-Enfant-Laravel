<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
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
      $categories = Category::all();;

      $vac = compact("categories");
      return view ("categories",$vac);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Categoryadd");
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
      
      $category = Category::find($myCategory->id);

      $vac = compact("category");
      return view("category",$vac);
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

    // public function Subcategories($myCategory){
    //   // dd($myCategory);
    //   $subCategory = Category::where('categories.id_parent', $myCategory->id)->get();
    //   // dd($subCategory);
    //   foreach($subCategory as $subCat){
    //     $ids [] = $subCat->id;
    //   }
    //   dd($ids);
    //   $products = Product::where('category_id', $subCategory->id)
    //   ->get();
    //   dd($products);
    // }



}
