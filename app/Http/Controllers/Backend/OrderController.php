<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Order;

class OrderController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
   public function __construct()
      {
          $this->middleware('auth:admin');
      }

    public function index(){

      $orders = Order::orderBy('id')->get();
       
       return view('admin.orders.index',compact('orders'));

    }


    public function show($id){

        $order = Order::find($id);
        $order->is_seen_by_admin = 1;
        $order->save();
        return view('admin.orders.show',compact('order'));

    }

    public function completed($id){

      $order = Order::find($id);

      if($order->is_completed){
         $order->is_completed = 0;
      }else{
        $order->is_completed = 1;
      }
      $order->save();
      session()->flash('success', 'Order completed has updated successfully !!');
      return back();

    }

    public function paid($id){

      $order = Order::find($id);

      if($order->is_paid){
         $order->is_paid = 0;
      }else{
        $order->is_paid = 1;
      }
      $order->save();
      session()->flash('success', 'completed has updated successfully !!');
      return back();

    }
}
