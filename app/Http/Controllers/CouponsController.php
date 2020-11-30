<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Coupon;
class CouponsController extends Controller
{
   public function addCoupon(Request $request){
    	if($request->isMethod('post')){
            $data = $request->all();
            //echo"<pre>"; print_r($data);die;
            $coupon = new Coupon;
            $coupon->coupon_code = $data['coupon_code'];
            $coupon->amount = $data['coupon_amount'];
            $coupon->amount_type = $data['amount_type'];
            $coupon->expiry_date = $data['expiry_date'];
          //  dd($coupon);
            $coupon->save();
            return redirect('/admin/view-coupons')->with('flash_message_success','Coupon has been added Successfully');
          }
        return view('backend.coupons.add_coupons');
    }

    public function viewCoupons(){
        $coupons = Coupon::get();
        return view('backend.coupons.view_coupons')->with(compact('coupons'));
    }

  

     public function editCoupon(Request $request,$id=null){
        if($request->isMethod('post')){
          $data = $request->all();
          $coupon = Coupon::find($id);
          $coupon->coupon_code = $data['coupon_code'];
          $coupon->amount = $data['coupon_amount'];
          $coupon->amount_type = $data['amount_type'];
          $coupon->expiry_date = $data['expiry_date'];
          $coupon->save();
          return redirect('/admin/view-coupons')->with('flash_message_success','Coupon has been Updated Successfully');
        }
       $couponDetails = Coupon::find($id);
       return view('backend.coupons.edit_coupon')->with(compact('couponDetails'));
      }

       public function deleteCoupon($id=null){
        Coupon::where(['id'=>$id])->delete();
        Alert::success('Deleted', 'Success Message');
        return redirect()->back();
    }

    public function updateStatus(Request $request,$id=null){
     $data = $request->all();
     Coupon::where('id',$data['id'])->update(['status'=>$data['status']]);

   }
}
