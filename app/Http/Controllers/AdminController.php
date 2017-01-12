<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Session;
use Image;
use DB;

class AdminController extends Controller
{
    //
    public function getOrders(){
      $orders = DB::table('orders')->get();
      /*$orders = Auth::user()->orders;
      $orders->transform(function($order, $key){
        $order->cart = unserialize($order->cart);
        return $order;
      });*/

      return view('admin.orders', ['orders' => $orders]);
    }

    public function getUsers(){
      $users = DB::table('users')->get();

      return view('admin.users', ['users' => $users]);
    }

    public function getProducts(){
      $products = DB::table('products')->get();

      return view('admin.products', ['products' => $products]);
    }


}
