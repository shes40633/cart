<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['title','type_id','sort','imges','description','price'];

    public function product_type()
    {
        return $this->belongsTo('App\product_type','type_id');
    }
    public function productimg()
    {
        return $this->hasMany('App\productimg','product_id');
    }
}
