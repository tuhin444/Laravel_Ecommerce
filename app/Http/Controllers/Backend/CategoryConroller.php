<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Category;

use App\ProductImage;
use Image;
use DB;

class CategoryConroller extends Controller
{

      public function __construct()
        {
            $this->middleware('auth:admin');
        }




    public function index(){

       $categorys = Category::orderBy('id')->get();
       return view('admin.category.showlist')->with('categorys',$categorys);

    }




    public function create(){


      $manage_category = Category::orderBy('id')->get();
       return view('admin.category.create')->with('manage_category',$manage_category);
    }



    public function edit($id){
    
    $manage_category = Category::orderBy('name', 'desc')->where('parent_id', NULL)->get();
    $categorys= Category::find($id);
    if (!is_null($categorys)) {
      return view('admin.category.edit', compact('categorys', 'manage_category'));
    }else {
      return resirect()->route('admin.category.showlist');
    }
   }



    public function update(Request $request,$id){
        $validatedData = $request->validate([
             'name' => 'required|max:200',
             'description' => 'required',
             'image' => 'required | mimes:jpeg,jpg,png,PNG | max:10000',
         ]);

        $data=array();
        $data['name']=$request->name;
        $data['parent_id']=$request->parent_id;
        $data['description']=$request->description;
        $image=$request->file('image');
        if ($image) {
            $image_name=hexdec(uniqid());
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='images/category/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            $data['image']=$image_url;
            unlink($request->old_photo);
            DB::table('categories')->where('id',$id)->update($data);
             $notification=array(
                'messege'=>'Successfully Post Inserted',
                'alert-type'=>'success'
                 );
             return Redirect()->back();
        }else{
             $data['image']=$request->old_photo;
              DB::table('categories')->where('id',$id)->update($data);
             $notification=array(
                'messege'=>'Successfully Post Inserted',
                'alert-type'=>'success'
                 );
             return Redirect()->back();
        }



    }


    public function delete($id)
    {

      $category = Category::find($id);
      if(!is_null($category)){
        $category->delete();
      }
       return back();
        
    // $category=DB::table('catagories')->where('id',$id)->first();
    //     $image=$category->image;
    //     $delete=DB::table('catagories')->where('id',$id)->delete();

          
     
     return back();
   }




     public function store(Request $request)
    {
      
        $data=array();
        $data['name']=$request->name;
        $data['description']=$request->description;
        $data['parent_id']=$request->parent_id;
        $image=$request->file('image');
        if ($image) {
            $image_name=hexdec(uniqid());
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='images/category/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            $data['image']=$image_url;
            DB::table('categories')->insert($data);
             $notification=array(
                'messege'=>'Successfully Post Inserted',
                'alert-type'=>'success'
                 );
              session()->flash('success', 'Category has updated successfully !!');
             return Redirect()->back()->with($notification);
        }else{
             DB::table('catagories')->insert($data);
             $notification=array(
                'messege'=>'Successfully Post Inserted',
                'alert-type'=>'success'
                 );
              session()->flash('success', 'Category has updated successfully !!');
             return Redirect()->back()->with($notification);
        }

    }
}
