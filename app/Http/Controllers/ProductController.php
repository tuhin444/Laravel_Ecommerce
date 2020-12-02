<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\post;
use App\Slider;
class ProductController extends Controller
{

 
   
    public function index()
    {
     $sliders = Slider::orderBy('button_text', 'asc')->get();
     $products = Product::orderBy('id', 'desc')->get();
      return view('frontend.pages.index',compact('products','sliders'));
    }


     public function contact()
    {
      return view('frontend.pages.contact');
    }


   public function products(){
         
    	 $products = Product::orderBy('id', 'desc')->get();
    	 return view('frontend.pages.product.index',compact('products'));
    }


   


    public function show($id){
     
       $products = Product::where('id', $id)->first(); 
      return view('frontend.pages.product.single')->with('products',$products);
    }


     public function search(Request $request){

         $search = $request->search;

          $products = Product::orwhere('title', 'like','%'.$search.'%')
                             ->orwhere('description', 'like','%'.$search.'%')
                             ->orwhere('quantity', 'like','%'.$search.'%')
                             ->orderBy('id', 'desc')
                             ->paginate(9);
         return view('frontend.pages.search',compact('products','search'));
    }

}
