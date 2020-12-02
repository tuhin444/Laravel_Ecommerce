<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
             'title_h1',
             'title_h2',
             'title_hp',
             'image',
             'button_text',
             'button_link',

     ];
}
