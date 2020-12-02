<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

use App\ProductImage;
use Image;


class ProductsController extends Controller
{

     public function __construct()
      {
          $this->middleware('auth:admin');
      }

   
    public function index(){
    	return view('admin.pages.index');
    }

    public function Product_create(){

    	return view('admin.product.create');
    }

      public function Product_create1(){

       $products = Product::orderBy('id')->get();
       return view('admin.product.showlist')->with('products',$products);

    }


   public function delete($id)
    {
    $product = Product::find($id);
    if (!is_null($product)) {
      $product->delete();
    }
    $img = ProductImage::where('product_id', $id)->first();
    $img->delete();
    session()->flash('success', 'Product has deleted successfully !!');
    return back();

   }


      public function edit($id){
 
        $product = Product::find($id);
        return view('admin.product.edit')->with('product', $product);
    }



    public function product_store(Request $request)
    {

      $request->validate([
            'title'         => 'required|max:150',
            'description'     => 'required',
            'price'             => 'required|numeric',
            'quantity'             => 'required|numeric',
            'category_id'             => 'required',
            'brand_id'             => 'required',
        ]);


      $product = new Product;

      $product->title = $request->title;
      $product->description = $request->description;
      $product->quantity = $request->quantity;
      $product->price = $request->price;
      $product->slug = $request->slug;
     
      $product->category_id = $request->category_id;
      $product->brand_id = $request->brand_id;
      $product->admin_id = 1;
      $product->save();


      if (count($request->product_image) > 0) {
            foreach ($request->product_image as $image) {

                //insert that image
                //$image = $request->file('product_image');
                $img = time() . '.'. $image->getClientOriginalExtension();
                $location = public_path('images/products/' .$img);
                Image::make($image)->save($location);

                $product_image = new ProductImage;
                $product_image->product_id = $product->id;
                $product_image->image = $img;
                $product_image->save();

            }
        }

   


     return redirect()->route('admin.product.create');
    
    
    }


    public function update(Request $request, $id)
    {


      $request->validate([
      'title'         => 'required|max:150',
      'description'     => 'required',
      'price'             => 'required|numeric',
      'quantity'             => 'required|numeric',
    ]);

    $product = Product::find($id);

    $product->title = $request->title;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->quantity = $request->quantity;
    $product->category_id = $request->category_id;
    $product->brand_id = $request->brand_id;
    $product->save();
    return redirect()->route('admin.product.showlist');
    
     

    }

   

    
}
