<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Slider;
use Image;
use File;
use DB;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('auth:admin');
    }



    public function index()
    {
       $sliders = Slider::orderBy('id')->get();
       return view('admin.slider.showlist',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   

      public function store(Request $request)
      {
      

          $validatedData = $request->validate([
             'title_h1' => 'required|max:200',
             'title_h2' => 'required|max:200',
             'title_h2' => 'required|max:200',
             'title_p' => 'required|max:800',
             'image' => 'required|image',
             
             
         ]);

      $sliders = new Slider;
      $sliders->title_h1 = $request->title_h1;
      $sliders->title_h2 = $request->title_h2;
      $sliders->title_p = $request->title_p;
      $sliders->title_p = $request->title_p;
      $sliders->button_text = $request->button_text;
      $sliders->button_link = $request->button_link;

      //insert images also
        if (($request->image) > 0) {
            $image = $request->file('image');
            $img = time() . '.'. $image->getClientOriginalExtension();
            $location = public_path('images/sliders/' .$img);
            Image::make($image)->save($location);
            $sliders->image = $img;
        }
         $sliders->save();
     
        session()->flash('success', 'Slider has add successfully !!');
        return redirect()->route('admin.slider.create');

       }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sliders = Slider::find($id);
      
       return view('admin.slider.edit')->with('sliders',$sliders);  

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
         $validatedData = $request->validate([
             'title_h1' => 'required|max:200',
             'title_h2' => 'required|max:200',
             'title_h2' => 'required|max:200',
             'title_p' => 'required|max:800',
             'image' => 'nullable|image',
         ],
         [
          'title_h1.required'  => 'Please provide a category title_h1',
          'image.image'  => 'Please provide a valid image with .jpg, .png, .gif, .jpeg exrension..',  
         ]);

     
        
        $sliders = Slider::find($id);
        
       $sliders->title_h1 = $request->title_h1;
       $sliders->title_h2 = $request->title_h2;
       $sliders->title_p = $request->title_p;
       $sliders->button_text = $request->button_text;
       $sliders->button_link = $request->button_link;
       /// image insert

       if (($request->image) > 0) {
        $image = $request->file('image');
        $img = time() . '.'. $image->getClientOriginalExtension();
        $location = public_path('images/sliders/' .$img);
        Image::make($image)->save($location);
        $sliders->image = $img;
        }
       $sliders->save();


     
      session()->flash('success', 'Slider has updated successfully !!');
      return redirect()->route('admin.slider.create');
      
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id) {
      
     $slider = Slider::find($id);
      if (!is_null($slider)) {

        // Delete slider image
        if (File::exists('images/sliders/'.$slider->image)) {
          File::delete('images/sliders/'.$slider->image);
        }
        $slider->delete();
      }
      session()->flash('success', 'slider has deleted successfully !!');
      return back();
      
    }
    
   
}
