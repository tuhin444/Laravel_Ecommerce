<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Divistion;
use App\District;
use DB;

class DivistionController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth:admin');
    }




    public function index(){

       $divistions = Divistion::orderBy('id')->get();
       return view('admin.divistion.showlist',compact('divistions'));

    }

   
    public function create(){

       return view('admin.divistion.create');
    }

    
     public function store(Request $request)
      {


          $validatedData = $request->validate([
             'name' => 'required|max:200',
             'priority' => 'required|max:200',
             
             
         ]);

      $divistions = new Divistion;
      $divistions->name = $request->name;
      $divistions->priority = $request->priority;
     
      $divistions->save();
     
        session()->flash('success', 'Divistion has add successfully !!');
        return redirect()->route('admin.divistion.create');

       }

   public function delete($id)
    {
      $divistions = Divistion::find($id); 
      $districts = District::where('divistion_id',$id)->first();
       $districts->delete();
    if (!is_null($divistions)) {
     
      $divistions->delete();
    }

    session()->flash('error', 'Divition has deleted successfully !!');
    return redirect()->route('admin.divistion.showlist');

    
   }



    public function edit($id){

        $divistions=DB::table('divistions')->where('id',$id)->first();
     
       return view('admin.divistion.edit')->with('divistions',$divistions);
    }



     public function update(Request $request,$id){


         $request->validate([
	      'name'         => 'required|max:150',
	      'priority'     => 'required',
     
       ]);
        
        $divistions = Divistion::find($id);
        
       $divistions->name = $request->name;
       $divistions->priority = $request->priority;
       $divistions->save();


     
      session()->flash('success', 'District has updated successfully !!');
      return redirect()->route('admin.divistion.create');
      
    }
}
