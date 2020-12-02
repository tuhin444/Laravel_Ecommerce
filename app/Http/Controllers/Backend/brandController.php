<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;
use DB;
use Image;

class brandController extends Controller
{

      public function __construct()
        {
            $this->middleware('auth:admin');
        }




    public function index(){

       $brands = Brand::orderBy('id')->get();
       return view('admin.brand.showlist')->with('brands',$brands);

    }

     public function create(){
       return view('admin.brand.create');
    }

       public function store(Request $request)
    {


          $validatedData = $request->validate([
             'name' => 'required|max:200',
             'description' => 'required',
             
         ]);

      
        $data=array();
        $data['name']=$request->name;
        $data['description']=$request->description;
     
        $image=$request->file('image');
        if ($image) {
            $image_name=hexdec(uniqid());
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='images/brand/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            $data['image']=$image_url;
            DB::table('brands')->insert($data);
           
        }else{
             DB::table('brands')->insert($data);
            
             
        }
        return redirect()->route('admin.brands.create');

    }

   public function delete($id)
    {
      $brands = Brand::find($id); 
    if (!is_null($brands)) {
      $brands->delete();
    }
    return redirect()->route('admin.brands.showlist');

    
   }



    public function edit($id){

        $brands=DB::table('brands')->where('id',$id)->first();
       
       return view('admin.brand.edit')->with('brands',$brands);
    }



     public function update(Request $request,$id){
        $validatedData = $request->validate([
             'name' => 'required|max:200',
             'description' => 'required',
             'image' => 'required | mimes:jpeg,jpg,png,PNG | max:10000',
         ]);

        $data=array();
        $data['name']=$request->name;
      
        $data['description']=$request->description;
        $image=$request->file('image');
        if ($image) {
            $image_name=hexdec(uniqid());
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='images/brand/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            $data['image']=$image_url;
            unlink($request->old_photo);
            DB::table('brands')->where('id',$id)->update($data);
             $notification=array(
                'messege'=>'Successfully Post Inserted',
                'alert-type'=>'success'
                 );
             return Redirect()->back();
        }else{
             $data['image']=$request->old_photo;
              DB::table('brands')->where('id',$id)->update($data);
             $notification=array(
                'messege'=>'Successfully Post Inserted',
                'alert-type'=>'success'
                 );
             return Redirect()->back();
        }



    }

}
