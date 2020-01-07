<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class productimg extends Model
{
    protected $table = 'productimg';
    protected $fillable = ['imges','product_id'];

}
