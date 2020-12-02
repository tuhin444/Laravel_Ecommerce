<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    
     protected $fillable = [
        'name', 'devistion_id',
    ];


    public function divistion(){
      return $this->belongsTo(Divistion::class);
    }
}
