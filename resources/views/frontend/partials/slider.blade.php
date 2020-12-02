 <section id="slider"><!--slider-->
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div id="slider-carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
              <li data-target="#slider-carousel" data-slide-to="1"></li>
              <li data-target="#slider-carousel" data-slide-to="2"></li>
            </ol>
            
            <div class="carousel-inner">
             
             
           @foreach($sliders as $slider)
              <div class="item  {{$loop->index == 0 ? 'active':''}}">
                <div class="col-sm-6">
                  <h1><span>E</span>-{{$slider->title_h1}}</h1>
                  <h2>{{$slider->title_h2}}</h2>
                  <p>{{$slider->title_p}}</p>
                  <button type="button" class="btn btn-default get">{{$slider->button_text}}</button>
                </div>
                <div class="col-sm-6">
                  <img src="{{ asset('images/sliders/'.$slider->image) }}" class="girl img-responsive" alt="{{$slider->title_h1}}" />
                
                </div>
              </div>
             @endforeach
           
              
             
              
            </div>
            
            <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
              <i class="fa fa-angle-left"></i>
            </a>
            <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
              <i class="fa fa-angle-right"></i>
            </a>
          </div>
          
        </div>
      </div>
    </div>
  </section><!--/slider-->