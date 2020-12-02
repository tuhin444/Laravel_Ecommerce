<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', 'PagesController@index')->name('index');
Route::get('/', 'ProductController@index')->name('index');

Route::get('/contact', 'ProductController@contact')->name('contact');


//Route::get('/products', 'ProductController@products')->name('products');
Route::get('/products/{id}', 'ProductController@show')->name('products.show');
Route::get('/search', 'ProductController@search')->name('products.search');



///Categorys route

Route::get('/category', 'CategoryController@index')->name('category.index');
Route::get('/category/{id}', 'CategoryController@show')->name('category.show');


// User Routes
Route::group(['prefix' => 'user'], function(){
Route::get('/dashboard', 'UsersController@dashboard')->name('user.dashboard');
Route::get('/profile', 'UsersController@profile')->name('user.profile');
Route::post('/profile/update', 'UsersController@profileUpdate')->name('user.profile.update');
});



Route::group(['prefix' => 'admin'], function(){
	
	Route::get('/index','Backend\ProductsController@index')->name('admin.index');
	
	//--------product route -----
	
	Route::group(['prefix' => 'product'], function(){
		
		Route::get('/create','Backend\ProductsController@Product_create')->name('admin.product.create');
	    Route::post('/create', 'Backend\ProductsController@product_store')->name('admin.product.store');
		Route::get('/showlist','Backend\ProductsController@Product_create1')->name('admin.product.showlist');
		Route::post('/delete/{id}', 'Backend\ProductsController@delete')->name('admin.product.delete');
		Route::get('/edit{id}', 'Backend\ProductsController@edit')->name('admin.product.edit');
		Route::post('/edit{id}', 'Backend\ProductsController@update')->name('admin.product.update');
		
		
	});

		///----orders route-----
	
	  Route::group(['prefix' => 'orders'], function(){
	  Route::get('/','Backend\OrderController@index')->name('admin.order');
	  Route::get('/view/{id}','Backend\OrderController@show')->name('admin.order.show');
	  Route::post('/delete/{id}','Backend\OrderController@delete')->name('admin.order.delete');
	 
	  Route::post('/completed/{id}','Backend\OrderController@completed')->name('admin.order.completed');
	  Route::post('/paid/{id}','Backend\OrderController@paid')->name('admin.order.paid');
	
	
	});
	
	///----category route-----
	
	 Route::group(['prefix' => 'category'], function(){
	 Route::get('/create','Backend\CategoryConroller@create')->name('admin.category.create');
	 Route::post('/create', 'Backend\CategoryConroller@store')->name('admin.category.store');
	 Route::get('/showlist','Backend\CategoryConroller@index')->name('admin.category.showlist');
	 Route::post('/delete/{id}','Backend\CategoryConroller@delete')->name('admin.category.delete');
	 Route::get('/edit{id}', 'Backend\CategoryConroller@edit')->name('admin.category.edit');
	 Route::post('/edit{id}', 'Backend\CategoryConroller@update')->name('admin.category.update');
	
	});




		///----Brands route-----
	
	 Route::group(['prefix' => 'brands'], function(){
	 Route::get('/create','Backend\brandController@create')->name('admin.brands.create');
	 Route::post('/create', 'Backend\brandController@store')->name('admin.brands.store');
	 Route::get('/showlist','Backend\brandController@index')->name('admin.brands.showlist');
	 Route::post('/delete/{id}','Backend\brandController@delete')->name('admin.brands.delete');
	 Route::get('/edit{id}', 'Backend\brandController@edit')->name('admin.brands.edit');
	 Route::post('/edit{id}', 'Backend\brandController@update')->name('admin.brands.update');
	
	});

   ///----district route-----
	 Route::group(['prefix' => 'district'], function(){
	 Route::get('/create','Backend\DistrictController@create')->name('admin.district.create');
	 Route::post('/create', 'Backend\DistrictController@store')->name('admin.district.store');
	 Route::get('/showlist','Backend\DistrictController@index')->name('admin.district.showlist');
	 Route::post('/delete/{id}','Backend\DistrictController@delete')->name('admin.district.delete');
	 Route::get('/edit{id}', 'Backend\DistrictController@edit')->name('admin.district.edit');
	 Route::post('/edit{id}', 'Backend\DistrictController@update')->name('admin.district.update');
	
	});

	  ///  divistion Route -----

	 Route::group(['prefix' => 'divistion'], function(){
	 Route::get('/create','Backend\DivistionController@create')->name('admin.divistion.create');
	 Route::post('/create', 'Backend\DivistionController@store')->name('admin.divistion.store');
	 Route::get('/showlist','Backend\DivistionController@index')->name('admin.divistion.showlist');
	 Route::post('/delete/{id}','Backend\DivistionController@delete')->name('admin.divistion.delete');
	 Route::get('/edit{id}', 'Backend\DivistionController@edit')->name('admin.divistion.edit');
	 Route::post('/edit{id}', 'Backend\DivistionController@update')->name('admin.divistion.update');
	
	});


	   ///  Slider Route -----

	 Route::group(['prefix' => 'slider'], function(){
	 Route::get('/create','Backend\SliderController@create')->name('admin.slider.create');
	 Route::post('/create', 'Backend\SliderController@store')->name('admin.slider.store');
	 Route::get('/showlist','Backend\SliderController@index')->name('admin.slider.showlist');
	 Route::post('/delete/{id}','Backend\SliderController@delete')->name('admin.slider.delete');
	 Route::get('/edit{id}', 'Backend\SliderController@edit')->name('admin.slider.edit');
	 Route::post('/edit{id}', 'Backend\SliderController@update')->name('admin.slider.update');
	
	});

   
 
});


 // Carts Route ----
	 Route::group(['prefix' => 'carts'], function(){

      Route::get('/', 'CartControllser@index')->name('carts.index');
      Route::post('/store', 'CartControllser@store')->name('carts.store');
      Route::post('/update{id}', 'CartControllser@update')->name('carts.update');
      Route::post('/delete{id}', 'CartControllser@destroy')->name('carts.delete');
     });

      // checkout Route ----
	 Route::group(['prefix' => 'checkout'], function(){

      Route::get('/', 'CheckoutsController@index')->name('checkout');
      Route::post('/store', 'CheckoutsController@store')->name('checkout.store');
     });




Auth::routes(['verify' => true]);
	// Auth::routes();

 Route::get('/deashbord', 'HomeController@index')->name('index');


// Route::get('admin/home', 'Backend\AdminController@index');
Route::get('admin/login', 'Backend\LoginController@showLoginFrom')->name('admin.login');
Route::post('admin/login', 'Backend\LoginController@Login');


//API routes


 // Route::get('get-district/{id}', function($id){
 // 	return App\District::where('divistion_id','$id')->get();
 // });

