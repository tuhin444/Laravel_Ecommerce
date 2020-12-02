<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
   protected $fillable = [
   	'name',
   	'image',
   	'priority',
   	'short_name',
   	'no',
   	'type',
   ];
}
