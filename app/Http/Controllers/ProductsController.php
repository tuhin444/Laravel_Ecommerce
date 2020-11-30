<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Input;
use Image;
use App\Product;
use App\Category;
use App\Cart;
use App\ProductsAttributes;
use App\ProductsImages;
use App\Coupon;
use App\User;
use App\Country;
use App\DeliveryAddress;
use App\Order;
use App\orderProduct;
use Auth;
use DB;
use Session;

class ProductsController extends Controller
{
    

       public function addProduct(Request $request){

        if($request->ismethod('post')){
            $data = $request->all();
            // echo "<pre>";print_r($data);die;
            $product = new Product;
            $product->category_id = $data['category_id'];
            $product->name = $data['product_name'];
            $product->code = $data['product_code'];
            $product->color = $data['product_color'];
            if(!empty($data['product_description'])){
                $product->description = $data['product_description'];

            }else{
                $produc->description = '';
            }
            $product->price = $data['product_price'];

            //Upload image
            if($request->hasfile('image')){
                echo $img_tmp = Input::file('image');
                if($img_tmp->isValid()){

                //image path code
                $extension = $img_tmp->getClientOriginalExtension();
                $filename = rand(111,99999).'.'.$extension;
                $img_path = 'uploads/products/'.$filename;

                //image resize
                Image::make($img_tmp)->resize(500,500)->save($img_path);

                $product->image = $filename;
            }
            }
            $product->save();
            return redirect('/admin/add-product')->with('flash_message_success','Product has been added successfully!!');

        }

      //Categories Dropdown menu Code
        $categories = Category::where(['parent_id' => 0])->get();
        $categories_dropdown = "<option value='' selected disabled>Select</option>";
        foreach($categories as $cat){
            $categories_dropdown .= "<option value='".$cat->id."'>".$cat->name."</option>";
            $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
            foreach($sub_categories as $sub_cat){
                $categories_dropdown .="<option value='".$sub_cat->id."'>&nbsp;--&nbsp".$sub_cat->name."</option>";

            }
        }
       
        return view('backend.products.add_products',compact('categories_dropdown'));
    }



    public function viewProduct(){
    	$products = Product::get(); 
    	return view('backend.products.viw_product',compact('products'));
    }


    public function editProduct(Request $request, $id=null){
          if($request->ismethod('post')){
          	 $data = $request->all();

          	  //Upload image
            if($request->hasfile('image')){
                echo $img_tmp = Input::file('image');
                if($img_tmp->isValid()){

                //image path code
                $extension = $img_tmp->getClientOriginalExtension();
                $filename = rand(111,99999).'.'.$extension;
                $img_path = 'uploads/products/'.$filename;

                //image resize
                Image::make($img_tmp)->resize(500,500)->save($img_path);

            }
            }else{
              $filename = $data['current_image'];
            }

            if(empty($data['product_description'])){
                $data['product_description'] = '';
            }


            Product::where(['id'=>$id])->update([

            	'name'=>$data['product_name'],
            	'category_id'=>$data['category_id'],
                'code'=>$data['product_code'],
                'color'=>$data['product_color'],
                'description'=>$data['product_description'],
                'price'=>$data['product_price'],
                'image'=>$filename]);

             return redirect('/admin/view-product')->with('flash_message_success','Product has been updated!!');
          }

          $productDetails = Product::where(['id'=>$id])->first();

          //Category dropdown code 
        $categories = Category::where(['parent_id'=>0])->get();
        $categories_dropdown = "<option value='' selected disabled>Select</option>";
        foreach($categories as $cat){
            if($cat->id==$productDetails->category_id){
                $selected = "selected";
            }else{
                $selected = "";
            }
            $categories_dropdown .= "<option value='".$cat->id."' ".$selected.">".$cat->name."</option>";
        //code for showing subcategories in main category
        $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
        foreach($sub_categories as $sub_cat){
            if($sub_cat->id==$productDetails->category_id){
                $selected = "selected";
            }else{
                $selected = "";
            }
        $categories_dropdown .= "<option value = '".$sub_cat->id."' ".$selected.">&nbsp;--&nbsp;".$sub_cat->name."</option>";
        }

    	return view('backend.products.edit',compact('productDetails','categories_dropdown'));
    }
}

    public function deleteProduct($id=null){

       Product::where(['id'=>$id])->delete();
       Alert::success('Deleted Successfully', 'Success Message');
       return redirect()->back()->with('flash_message_error','Product Deleted');
     
    }

   //Product Statuse Update 

    public function updateStatus(Request $request,$id=null){
     
       $data = $request->all();
       Product::where('id',$data['id'])->update(['status'=>$data['status']]);
    }

   //Single Product view

    public function products($id=null){
         $productDetails = Product::with('attributes')->where('id', $id)->first();
         $ProductsAltImages = ProductsImages::where('product_id',$id)->get();
         $featuredProducts = Product::where(['featured_products' =>1])->get();
        return view('frontend.product_details',compact('productDetails','ProductsAltImages','featuredProducts'));
    }

  //Product attributes add

    public function addAttributes(Request $request,$id=null){
        $productDetails = Product::with('attributes')->where(['id'=>$id])->first();
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>";print_r($data);die;
            foreach($data['sku'] as $key =>$val){
                if(!empty($val)){
                    //Prevent duplicate SKU Record
                    $attrCountSKU = ProductsAttributes::where('sku',$val)->count();
                    if($attrCountSKU>0){
                        return redirect('/admin/add-attributes/'.$id)->with('flash_message_error','SKU is already exist please select another sku');
                    }
                    //Prevent duplicate Size Record
                    $attrCountSizes = ProductsAttributes::where(['product_id'=>$id,'size'=>$data['size']
                    [$key]])->count();
                    if($attrCountSizes>0){
                    return redirect('/admin/add-attributes/'.$id)->with('flash_message_error',''.$data['size'][$key].'Size is already exist please select another size');
                    }
                    $attribute = new ProductsAttributes;
                    $attribute->product_id = $id;
                    $attribute->sku = $val;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                   // dd($attribute);
                   $attribute->save();
                }

            }
            return redirect('/admin/add-attributes/'.$id)->with('flash_message_success','Products attributes added successfully!');

        }
        return view('backend.products.add_attributes')->with(compact('productDetails'));
    }


     public function deleteAttribute($id=null){
        ProductsAttributes::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_error','Product Attribute is deleted!');

    }


    public function editAttributes(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
              foreach($data['attr'] as $key=>$attr){
                 ProductsAttributes::where(['id'=>$data['attr'][$key]])->update([
                                    'sku'=>$data['sku'][$key],
                                    'size'=>$data['size'][$key],
                                    'price'=>$data['price'][$key],
                                    'stock'=>$data['stock'][$key]
                                ]);
              }
         return redirect()->back()->with('flash_message_success','Products Attributes Updated!!!');
        }
    }

   public function addImages(Request $request,$id=null){
     $productDetails = Product::where(['id'=>$id])->first();
      if($request->isMethod('post')){
            $data = $request->all();
            if($request->hasfile('image')){
                $files = $request->file('image');
                foreach($files as $file){
                    $image = new ProductsImages;
                    $extension = $file->getClientOriginalExtension();
                    $filename = rand(111,9999).'.'.$extension;
                    $image_path = 'uploads/products/'.$filename;
                    Image::make($file)->save($image_path);
                    $image->image = $filename;
                    $image->product_id = $data['product_id'];
                    $image->save();
                }
            }
            return redirect('/admin/add-images/'.$id)->with('flash_message_success','Image has been updated');
        }
     $productImages = ProductsImages::where(['product_id'=>$id])->get();    
    return view('backend.products.add_images',compact('productDetails','productImages'));
   }

     public function deleteAltImage($id=null){
        $productImage = ProductsImages::where(['id'=>$id])->first();

        $image_path = 'uploads/products/';
        if(file_exists($image_path.$productImage->image)){
            unlink($image_path.$productImage->image);
        }
        ProductsImages::where(['id'=>$id])->delete();
        Alert::success('Deleted','Success Message');
        return redirect()->back();
    }

    public function updateFeatured(Request $request,$id=null){
        $data = $request->all();
        Product::where('id',$data['id'])->update(['featured_products'=>$data['status']]);
      
    }
    
/// price 
    public function getprice(Request $request){
         $data = $request->all();
        //  echo "<pre>";print_r($data);die;
        $proArr = explode("-",$data['idSize']);
        $proAttr = ProductsAttributes::where(['product_id'=>$proArr[0],'size'=>$proArr[1]])->first();
        echo $proAttr->price;
    } 

 public function addtoCart(Request $request){
         $data = $request->all();
         if (empty($data['user_email'])) {
            $data['user_email'] = '';
         }


        $session_id = Session::get('session_id');
        if (empty($session_id)) {
        $session_id = str::random(40);
        Session::put('session_id',$session_id);
        }
     
       
      
       
         $sizeArr = explode('-',$data['size']);
         $countProducts = DB::table('carts')->where(['product_id'=>$data['product_id'],'product_color'=>$data['color'],'price'=>$data['price'],
        'size'=>$sizeArr[1],'session_id'=>$session_id])->count();
         if($countProducts>0){
            return redirect()->back()->with('flash_message_error','Product already exists in cart');
         }else{
           DB::table('carts')->insert([
            'product_id'=>$data['product_id'],
            'product_name'=>$data['product_name'],
            'product_code'=>$data['product_code'],
            'product_color'=>$data['color'],
            'price'=>$data['price'],
            'size'=>$sizeArr[1],
            'quantity'=>$data['quantity'],
            'user_email'=>$data['user_email'],
            'session_id'=>$session_id]);  
         }
        
      
     return redirect('/cart')->with('flash_message_success','Product has been added in cart');

    }

    public function cart(Request $request){

        Session::forget('couponAmount');
        Session::forget('CouponCode');
        $session_id = Session::get('session_id');
        $userCarts = Cart::where(['session_id' => $session_id])->get();
        foreach($userCarts as $key=>$products){
          $productDetails = Product::where(['id'=>$products->product_id])->first();
         echo $userCarts[$key]->image = $productDetails->image;
        }
        //dd($userCarts);
       // echo "<pre>";print_r($userCarts);die;
        return view('frontend.product.cart',compact('userCarts'));
    }


    public function deleteCartProduct($id=null){

       Session::forget('couponAmount');
       Session::forget('CouponCode');

      DB::table('carts')->where('id',$id)->delete();
     return redirect('/cart')->with('flash_message_error','Product has been deleted!');
    }

    public function updateCartQuantity($id=null,$quantity=null){

        Session::forget('couponAmount');
        Session::forget('CouponCode');

      DB::table('carts')->where('id',$id)->increment('quantity',$quantity);
        return redirect('/cart')->with('flash_message_success','Product Quantity has been updated Successfully');
    }

    public function applyCoupon(Request $request){
      
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>";print_r($data);die;
            $couponCount = Coupon::where('coupon_code',$data['coupon_code'])->count();
            if($couponCount == 0){
                return redirect()->back()->with('flash_message_error','Coupon code does not exists');
            }else{
                // echo "Success";die;
                $couponDetails = Coupon::where('coupon_code',$data['coupon_code'])->first();
                //Coupon code status
                if($couponDetails->status==0){
                    return redirect()->back()->with('flash_message_error','Coupon code is not active');
                }
                //Check coupon expiry date
                $expiry_date = $couponDetails->expiry_date;
                $current_date = date('Y-m-d');
                if($expiry_date < $current_date){
                    return redirect()->back()->with('flash_message_error','Coupon Code is Expired');
                }
                //Coupon is ready for discount
                $session_id = Session::get('session_id');

                if(Auth::check()){
                    $user_email = Auth::user()->email;
                    $userCart = DB::table('carts')->where(['user_email'=>$user_email])->get();
                }else{
                    $session_id = Session::get('session_id');
                    $userCart = DB::table('carts')->where(['session_id'=>$session_id])->get();
                }
                $total_amount = 0;
                foreach($userCart as $item){
                    $total_amount = $total_amount + ($item->price*$item->quantity);
                }
                //Check if coupon amount is fixed or percentage
                if($couponDetails->amount_type=="Fixed"){
                    $couponAmount = $couponDetails->amount;
                }else{
                    $couponAmount = $total_amount * ($couponDetails->amount/100);
                }
                //Add Coupon code in session
                Session::put('CouponAmount',$couponAmount);
                Session::put('CouponCode',$data['coupon_code']);
                return redirect()->back()->with('flash_message_success','Coupon Code is Successffully Applied.You are Availing Discount');
            }
        }
    }

   public function checkout(Request $request){
       $user_id = Auth::user()->id;
       $user_email = Auth::user()->email;
       $userDetails = User::find($user_id); 
       $shippingDetailes = DeliveryAddress::where('user_id',$user_id)->first();
       $countries=Country::get();

       $shippingCount = DeliveryAddress::where('user_id',$user_id)->count();
       $shippingDetails = array();
       if ($shippingCount>0) {
         $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();
       }

        //Update Cart Table With Email 
         $session_id = Session::get('session_id');
         DB::table('carts')->where(['session_id'=>$session_id])->update(['user_email'=>$user_email]);

       if ($request->ismethod('post')) {
          $data = $request->all();
          //echo "<pre>";print_r($data);die;
          //Update Users Details 
        User::where('id',$user_id)->update(['name'=>$data['billing_name'],'address'=>$data['billing_address'],'city'=>$data['billing_city'],'state'=>$data['billing_state'],'pincode'=>$data['billing_pincode'],'country'=>$data['billing_country'],'mobile'=>$data['billing_mobile']]);
        if ($shippingCount > 0) {
            //update Shipping Address
            DeliveryAddress::where('user_id',$user_id)->update(['name'=>$data['shipping_name'],'address'=>$data['shipping_address'],
            'city'=>$data['shipping_city'],'state'=>$data['shipping_state'],'pincode'=>$data['shipping_pincode'],
            'country'=>$data['shipping_country'],'mobile'=>$data['shipping_mobile']]);
        }else{
           //New Shipping Address
            $shipping = new DeliveryAddress;
            $shipping->user_id = $user_id;
            $shipping->user_email = $user_email;
            $shipping->name = $data['shipping_name'];
            $shipping->address = $data['shipping_address'];
            $shipping->city = $data['shipping_city'];
            $shipping->state= $data['shipping_state'];
            $shipping->country =$data['shipping_country'];
            $shipping->pincode =$data['shipping_pincode'];
            $shipping->mobile = $data['shipping_mobile'];
             $shipping->save();
        }
        
        //echo "redirect to order view page";die;
        return redirect()->action('ProductsController@orderReview');
       }
       
      
      return view('frontend.product.checkout',compact('userDetails','countries','shippingDetailes'));
   }

   public function orderReview(){
       $user_id = Auth::user()->id;
       $user_email = Auth::user()->email;
       $userDetails = User::find($user_id);
       $shippingDetailes = DeliveryAddress::where('user_id',$user_id)->first();

       $userCart = DB::table('carts')->where(['user_email'=>$user_email])->get();
       foreach ($userCart as $key => $product) {
         $productDetails = Product::where('id',$product->product_id)->first();
        $userCart[$key]->image = $productDetails->image;
        
       }

     return view('frontend.product.order_review',compact('userDetails','shippingDetailes','userCart'));
    } 

    public function placeOrder(Request $request){
        if ($request->ismethod('post')) {
           
          
            $user_id = Auth::user()->id;
            $user_email = Auth::user()->email;
            $data = $request->all();
            $shippingDetails = DeliveryAddress::where(['user_email'=>$user_email])->first();
          

              if(empty(Session::get('CouponCode'))){
                $coupon_code = 'Not Used';
             }else{
                $coupon_code = Session::get('CouponCode');
             }
             if(empty(Session::get('CouponAmount'))){
                $coupon_amount = '0';
             }else{
                $coupon_amount = Session::get('CouponAmount');
             }

             // echo "<pre>";print_r($data);
            $order = new Order;
            $order->user_id = $user_id;
            $order->user_email = $user_email;
            $order->name = $shippingDetails->name;
            $order->address = $shippingDetails->address;
            $order->city = $shippingDetails->city;
            $order->state = $shippingDetails->state;
            $order->pincode = $shippingDetails->pincode;
            $order->country = $shippingDetails->country;
            $order->mobile = $shippingDetails->mobile;
            $order->coupon_code = $coupon_code;
            $order->coupon_amount = $coupon_amount;
            $order->order_status = "New";
            $order->payment_method = $data['payment_method'];
            $order->grand_total  = $data['grand_total'];
            $order->Save();
            //echo "<pre>";print_r($data);
           // echo "<pre>";print_r($shippingDetails);
            $order_id = DB::getPdo()->lastinsertID();
            
            $catProducts = DB::table('carts')->where(['user_email'=>$user_email])->get();
             foreach($catProducts as $pro){
                $cartPro = new orderProduct;
                $cartPro->order_id = $order_id;
                $cartPro->user_id = $user_id;
                $cartPro->product_id = $pro->product_id;
                $cartPro->product_code = $pro->product_code;
                $cartPro->product_name = $pro->product_name;
                $cartPro->product_color = $pro->product_color;
                $cartPro->product_size = $pro->size;
                $cartPro->product_price = $pro->price;
                $cartPro->product_qty = $pro->quantity;
                $cartPro->save();

            }
            Session::put('order_id',$order_id);
            Session::put('grand_total',$data['grand_total']);
             return redirect('/thanks');
        }
    }
    public function thanks(){
      $user_email = Auth::user()->email;
      DB::table('carts')->where('user_email',$user_email)->delete();
      return view('frontend.orders.thanks');
    }

    public function userOrders(){
      $user_id = Auth::user()->id;
      $orders = Order::where('user_id',$user_id)->orderBy('id','DESC')->get();
     // echo "<pre>";print_r($orders);die;
      return view('frontend.orders.user_order',compact('orders'));
    }
    public function userOrderDetails($order_id){
       $orderDetailes = Order::with('orders')->where('id',$order_id)->first();
       $user_id = $orderDetailes->user_id;
       $userDetails = User::where('id',$user_id)->first();
      // dd($orderDetailes);
      return view('frontend.orders.user_order_details',compact('orderDetailes','userDetails'));
    }

    public function viewOrders(){
      $orders = Order::with('orders')->orderBy('id','DESC')->get();
      return view('backend.orders.view_orders',compact('orders'));
    }
  }
