<?php

namespace App\Http\Controllers;

use App\Shipping_status;
use Illuminate\Http\Request;

class ShippingStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $shipping_statuses = Shipping_status::all();;

      $vac = compact("shipping_statuses");
      return view ("shipping_statuses",$vac);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("ShippingStatusadd");
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
            "name" => "filled|string|max:50|unique:shipping_statuses",
          ];
          $messages = [
            "filled" => "El campo :attribute no puede estar vacío.",
            "string" => "El campo :attribute debe ser texto.",
            "max" => "El campo :attribute tiene un máximo de :max",
            "unique" => "El campo :attribute debe ser unico.",
            // "image"=>"el archivo debe ser del tipo .jpeg, .png, .bmp, .gif, o .svg"
          ];
          $this->validate($request, $rules, $messages); //Son 3 arrays asociativos


          $shippingNuevo = new Shipping_status();

          $shippingNuevo->id = $request["id"];
          $shippingNuevo->name = $request["name"];

          $shippingNuevo->save();

          return redirect("/shippingStatuses");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shipping_status  $shipping_status
     * @return \Illuminate\Http\Response
     */
    public function show(Shipping_status $myShippingStatus)
    {
      $shipping_status = Shipping_status::find($myShippingStatus->id);

      $vac = compact("shipping_status");
      return view("shipping_status",$vac);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shipping_status  $shipping_status
     * @return \Illuminate\Http\Response
     */
    public function edit(Shipping_status $shipping_status)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shipping_status  $shipping_status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shipping_status $shipping_status)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shipping_status  $shipping_status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shipping_status $shipping_status)
    {
        //
    }
    public function delete($id){
      $userstatusABorrar = Shipping_status::find($id);
      $userstatusABorrar->delete();
      return redirect("/shippingStatuses");
    }
}
