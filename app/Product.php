<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model


{
	    protected $fillable = [
        'category_id',
        'brand_id',
        'title',
        'description',
        'slug',
        'quantity',
        'price',
        'status',
        'offer_price',
      
    ];



   public function images(){

   	return $this->hasMany('App\ProductImage');
   }


    public function category()
	  {
	    return $this->belongsTo(Category::class);
	  }

	  public function brand()
	  {
	    return $this->belongsTo(Brand::class);
	  }


 

}
