<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use App\Category;
use App\Product;
class IndexController extends Controller
{
   
    public function index(){
      $banners = Banner::where('status','1')->orderby('sort_order','asc')->get();
      $categorys = Category::with('categories')->where(['parent_id' => 0])->get();
      $products = Product::get();
      return view('frontend.index',compact('banners','categorys','products'));

    }

    public function categories($category_id){
        $categorys = Category::with('categories')->where(['parent_id'=>0])->get();
        $products = Product::where(['category_id'=>$category_id])->get();
        $product_name = Product::where(['category_id'=>$category_id])->first();
        return view('frontend.categories')->with(compact('categorys','products','product_name'));
    }

     public function home(){
      $banners = Banner::where('status','1')->orderby('sort_order','asc')->get();
      $categorys = Category::with('categories')->where(['parent_id' => 0])->get();
      $products = Product::get();
      return view('frontend.index',compact('banners','categorys','products'));

    }

   
}
