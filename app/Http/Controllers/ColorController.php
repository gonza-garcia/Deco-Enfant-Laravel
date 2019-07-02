<?php

namespace App\Http\Controllers;

use App\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $colors = Color::all();;

      $vac = compact("colors");
      return view ("colors",$vac);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view("Coloradd");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // dd($request);
      //Paso 2: Antes vamos a validar los del formulario
      $rules = [ //https://laravel.com/docs/5.8/validation#rule-size
        // "id" => "integer|max:11|filled",
        "name" => "filled|string|max:30|unique:colors",
        // "content" => "string|filled",
        // "featured-image" => "image",
      ];
      $messages = [
        "filled" => "El campo :attribute no puede estar vacío.",
        "string" => "El campo :attribute debe ser texto.",
        "max" => "El campo :attribute tiene un máximo de :max",
        "unique" => "El campo :attribute debe ser unico.",
        // "image"=>"el archivo debe ser del tipo .jpeg, .png, .bmp, .gif, o .svg"
      ];
      $this->validate($request, $rules, $messages); //Son 3 arrays asociativos


      $colorNuevo = new Color();

      $colorNuevo->id = $request["id"];
      $colorNuevo->name = $request["name"];

      $colorNuevo->save();

      return redirect("/colores");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function show(Color $myColor)
    {
      $color = Color::find($myColor->id);

      $vac = compact("color");
      return view("color",$vac);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function edit(Color $myColor)
    {
      $color = Color::find($myColor->id);

      $vac = compact("color");
      return view ("colorEdit",$vac);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Color $color)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
      // $id = $color->id;
      // $colorABorrar = Color::find($id);
      // $colorABorrar->delete();
      // return redirect("/colores");
    }

    public function delete(Request $request){
      $id = $request->id;
      $colorABorrar = Color::find($id);
      $colorABorrar->delete();
      return redirect("/colores");
    }
}
