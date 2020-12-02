<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\District;
use App\Divistion;
use DB;
class DistrictController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth:admin');
    }




    public function index(){
      
      
       $districts = District::orderBy('name','asc')->get();
       return view('admin.district.showlist',compact('districts'));

    }

   
    public function create(){

       $divistions = Divistion::orderBy('priority','asc')->get();
       return view('admin.district.create',compact('divistions'));
    }

   

   public function store(Request $request){
    
          $validatedData = $request->validate([
             'name' => 'required',
             'divistion_id' => 'required',
             
         ]);

      $districts = new District;
      $districts->name = $request->name;
      $districts->divistion_id = $request->divistion_id;
      $districts->save();
     
       session()->flash('success', 'A new district has added successfully !!');
        return redirect()->route('admin.district.create');

    }

   public function delete($id)
    {
      $districts = District::find($id); 
      if (!is_null($districts)) {
      $districts->delete();
    }
    
    return redirect()->route('admin.district.showlist');

    
   }



    public function edit($id){
        $divistions = Divistion::orderBy('priority','asc')->get();
        $districts=DB::table('districts')->where('id',$id)->first();
       
       return view('admin.district.edit',compact('districts','divistions'));
    }



     public function update(Request $request,$id){

        $validatedData = $request->validate([
             'name' => 'required|max:200',
             'divistion_id' => 'required',
            
         ]);

       $districts = District::find($id);
        
      $districts->name = $request->name;
      $districts->divistion_id = $request->divistion_id;
      $districts->save();

      session()->flash('success', 'District has updated successfully !!');
      return redirect()->route('admin.district.create');
    }
}
