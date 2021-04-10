<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = ['product_id', 'qty'];
    
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function order_detail()
    {
        return $this->belongsTo('App\OrderDetail');
    }
    
}
