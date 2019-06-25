<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $roles = Role::all();;

      $vac = compact("roles");
      return view ("roles",$vac);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Roladd");
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
          "name" => "filled|string|max:25|unique:roles",
        ];
        $messages = [
          "filled" => "El campo :attribute no puede estar vacío.",
          "string" => "El campo :attribute debe ser texto.",
          "max" => "El campo :attribute tiene un máximo de :max",
          "unique" => "El campo :attribute debe ser unico.",
        ];
        $this->validate($request, $rules, $messages); //Son 3 arrays asociativos


        $rolNuevo = new Role();

        $rolNuevo->id = $request["id"];
        $rolNuevo->name = $request["name"];

        $rolNuevo->save();

        return redirect("/roles");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $myRole)
    {
      $role = Role::find($myRole->id);

      $vac = compact("role");
      return view("role",$vac);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }

    public function delete(Request $request){
      $id = $request->id;
      $rolABorrar = Role::find($id);
      $rolABorrar->delete();
      return redirect("/roles");
    }
}
