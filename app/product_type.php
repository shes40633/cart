<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product_type extends Model
{
    protected $table = 'product_type';
    protected $fillable = ['type_name'];

    public function product()
    {
        return $this->hasMany('App\product','type_id');
    }
}
