<?php

namespace App\Http\Controllers;

use App\User_status;
use Illuminate\Http\Request;

class UserStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user_statuses = User_status::all();;

      $vac = compact("user_statuses");
      return view ("user_statuses",$vac);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("UserStatusadd");
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
          "name" => "filled|string|max:25|unique:user_statuses",
        ];
        $messages = [
          "filled" => "El campo :attribute no puede estar vacío.",
          "string" => "El campo :attribute debe ser texto.",
          "max" => "El campo :attribute tiene un máximo de :max",
          "unique" => "El campo :attribute debe ser unico.",
          // "image"=>"el archivo debe ser del tipo .jpeg, .png, .bmp, .gif, o .svg"
        ];
        $this->validate($request, $rules, $messages); //Son 3 arrays asociativos


        $userstatusNuevo = new User_status();

        $userstatusNuevo->id = $request["id"];
        $userstatusNuevo->name = $request["name"];

        $userstatusNuevo->save();

        return redirect("/userStatuses");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User_status  $user_status
     * @return \Illuminate\Http\Response
     */
    public function show(User_status $myUserStatus)
    {
      $user_status = User_status::find($myUserStatus->id);

      $vac = compact("user_status");
      return view("user_status",$vac);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User_status  $user_status
     * @return \Illuminate\Http\Response
     */
    public function edit(User_status $myuser_status)
    {
      $user_status = User_status::find($myuser_status->id);

      $vac = compact("user_status");
      return view ("colorEdit",$vac);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User_status  $user_status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User_status $user_status)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User_status  $user_status
     * @return \Illuminate\Http\Response
     */
    public function destroy(User_status $user_status)
    {
        //
    }
    public function delete($id){
      $userstatusABorrar = User_status::find($id);
      $userstatusABorrar->delete();
      return redirect("/userStatuses");
    }
}
