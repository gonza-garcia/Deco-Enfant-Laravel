<?php

namespace App\Http\Controllers;

use App\Order_status;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $order_statuses = Order_status::all();;

      $vac = compact("order_statuses");
      return view ("order_statuses",$vac);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          return view("OrderStatusadd");
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
            "name" => "filled|string|max:50|unique:order_statuses",
          ];
          $messages = [
            "filled" => "El campo :attribute no puede estar vacío.",
            "string" => "El campo :attribute debe ser texto.",
            "max" => "El campo :attribute tiene un máximo de :max",
            "unique" => "El campo :attribute debe ser unico.",
            // "image"=>"el archivo debe ser del tipo .jpeg, .png, .bmp, .gif, o .svg"
          ];
          $this->validate($request, $rules, $messages); //Son 3 arrays asociativos


          $orderstatusNuevo = new Order_status();

          $orderstatusNuevo->id = $request["id"];
          $orderstatusNuevo->name = $request["name"];

          $orderstatusNuevo->save();

          return redirect("/orderStatuses");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order_status  $order_status
     * @return \Illuminate\Http\Response
     */
    public function show(Order_status $myOrderStatus)
    {
      $order_status = Order_status::find($myOrderStatus->id);

      $vac = compact("order_status");
      return view("order_status",$vac);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order_status  $order_status
     * @return \Illuminate\Http\Response
     */
    public function edit(Order_status $order_status)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order_status  $order_status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order_status $order_status)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order_status  $order_status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order_status $order_status)
    {
        //
    }
    public function delete($id){
      $orderstatusABorrar = Order_status::find($id);
      $orderstatusABorrar->delete();
      return redirect("/orderStatuses");
    }
}
