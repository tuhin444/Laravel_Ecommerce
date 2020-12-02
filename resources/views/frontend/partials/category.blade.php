       <div class="col-sm-3">
          <div class="left-sidebar">
            <h2>Catagory Product</h2>
            <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            

       
            <div class="panel panel-default">
         @foreach(App\Category::orderBy('name','asc')->where('parent_id',NULL)->get() as $parent)
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordian" href="#main-{{$parent->id}}">
                      <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                      {{$parent->name}}
                    </a>
                  </h4>
                </div>
                @endforeach
                <div id="main-{{$parent->id}}" class="panel-collapse collapse">
                 
                  <div class="panel-body">
                    
                    <ul>
                      @foreach(App\Category::orderBy('name','asc')->where('parent_id',$parent->id)->get() as $child)
                    <li><a href="{{route('category.show',$child->id)}}">{{$child->name}} </a></li>
                     @endforeach
                    </ul>
                     
                  </div>

                </div>
           
              
              </div>
        
 

       

              
      
            

            </div><!--/category-products-->
          
            
            <div class="price-range"><!--price-range-->
              <h2>Price Range</h2>
              <div class="well text-center">
                 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
              </div>
            </div><!--/price-range-->
            
            <div class="shipping text-center"><!--shipping-->
              <img src="{{asset('frontend/images/home/shipping.jpg')}}" alt="" />
            </div><!--/shipping-->
          
          </div>
        </div>