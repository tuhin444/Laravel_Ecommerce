<?php

namespace App\Http\Controllers;
use App\Product;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    //   public function index()
    // {
    //  $products = Product::orderBy('id', 'desc')->get();
    //   return view('home')->with('products',$products);
    // }
}
