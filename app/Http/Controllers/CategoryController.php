<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
    public function index(){

    }

    public function show($id){
    	$category = Category::find($id);
    	return view('frontend.pages.category.show',compact('category'));
    }
}
