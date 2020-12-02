 <div class="sidebar" data-color="purple" data-background-color="white" data-image="image/sidebar-1.jpg">
      
      <div class="logo">
        <a href="" class="simple-text logo-normal">
          Creative Tim
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">

           @if(Request::is('admin*'))

          <li class="nav-item active  ">
            <a class="nav-link" href="{{route('admin.index')}}">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>


    

       

          <li class="nav-item ">
            <a class="nav-link" href="{{route('admin.product.showlist')}}">
              <i class="material-icons">library_books</i>
              <p>Manage Product</p>
            </a>
          </li>

           <li class="nav-item ">
            <a class="nav-link" href="{{route('admin.order')}}">
              <i class="material-icons">library_books</i>
              <p>Manage Orders</p>
            </a>
          </li>
           <li class="nav-item ">
            <a class="nav-link" href="{{route('admin.slider.showlist')}}">
             <i class="material-icons">library_books</i>
              <p>Manage Slider</p>
            </a>
           </li>


          <li class="nav-item ">
            <a class="nav-link" href="{{route('admin.category.showlist')}}">
             <i class="material-icons">library_books</i>
              <p>Category</p>
            </a>
          </li>

           <li class="nav-item ">
            <a class="nav-link" href="{{route('admin.brands.showlist')}}">
             <i class="material-icons">library_books</i>
              <p>Brands</p>
            </a>
          </li>

           <li class="nav-item ">
            <a class="nav-link" href="{{route('admin.divistion.showlist')}}">
             <i class="material-icons">library_books</i>
              <p>Divistion</p>
            </a>
          </li>

           <li class="nav-item ">
            <a class="nav-link" href="{{route('admin.district.showlist')}}">
             <i class="material-icons">library_books</i>
              <p>District</p>
            </a>
          </li>


          

            <li class="nav-item ">
               <a class="dropdown-item" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
             <i class="material-icons">close</i>  </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
            </form>
          </li>

          @else


       
            @endif       

              

        
       
        </ul>
      </div>
    </div>