<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Category;
class CategoryController extends Controller
{


   public function addCategory(Request $request){
     if($request->isMethod('post')){
     	$data = $request->all();

     	$categorys = new Category;
     	$categorys->name =$data['category_name'];
     	$categorys->parent_id =$data['parent_id'];
     	$categorys->url =$data['category_url'];
     	$categorys->description =$data['category_description'];
     	$categorys->save();
     	return redirect('/admin/add-category')->with('flash_message_success','Category Added Successfully!!');
     }
     $levels = Category::where(['parent_id'=>0])->get();
    return view('backend.category.add_category',compact('levels'));

   }

   public function viewCategory(){
        $categorys = Category::get(); 
        return view('backend.category.view_category',compact('categorys'));
   }


   public function editCategory(Request $request, $id=null){
     if($request->isMethod('post')){
            $data = $request->all();
            Category::where(['id'=>$id])->update([

                'name'=>$data['category_name'],
                'parent_id'=>$data['parent_id'],
                'description'=>$data['category_description'],
                'url'=>$data['category_url'
            ]]);
            return redirect('/admin/view-categories')->with('flash_message_success','Category Updated Successfully!!!');
        }
        $levels = Category::where(['parent_id'=>0])->get();
        $categoryDetails = Category::where(['id'=>$id])->first();
        return view('backend.category.edit')->with(compact('levels','categoryDetails'));
   }

   public function deleteCategory($id=null){
      Category::where(['id'=>$id])->delete();
       Alert::success('Deleted Successfully', 'Success Message');
       return redirect()->back()->with('flash_message_error','Category Deleted');
     
   }

   public function updateStatus(Request $request,$id=null){
     $data = $request->all();
     Category::where('id',$data['id'])->update(['status'=>$data['status']]);

   }

}
