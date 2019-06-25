<?php

namespace App\Http\Controllers;

use App\Sex;
use Illuminate\Http\Request;

class SexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $sexes = Sex::all();

      $vac = compact("sexes");
      return view ("sexes",$vac);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Sexadd");
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
        "name" => "filled|string|max:25|unique:sexes",
      ];
      $messages = [
        "filled" => "El campo :attribute no puede estar vacío.",
        "string" => "El campo :attribute debe ser texto.",
        "max" => "El campo :attribute tiene un máximo de :max",
        "unique" => "El campo :attribute debe ser unico.",
      ];
      $this->validate($request, $rules, $messages); //Son 3 arrays asociativos


      $sexNuevo = new Sex();

      $sexNuevo->id = $request["id"];
      $sexNuevo->name = $request["name"];

      $sexNuevo->save();

      return redirect("/sexos");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sex  $sex
     * @return \Illuminate\Http\Response
     */
    public function show(Sex $mySex)
    {
      $sex = Sex::find($mySex->id);

      $vac = compact("sex");
      return view("sex",$vac);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sex  $sex
     * @return \Illuminate\Http\Response
     */
    public function edit(Sex $sex)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sex  $sex
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sex $sex)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sex  $sex
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sex $sex)
    {
        //
    }

    public function delete(Request $request){
      $id = $request->id;
      $sexABorrar = Sex::find($id);
      $sexABorrar->delete();
      return redirect("/sexos");
    }
}
