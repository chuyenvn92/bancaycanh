<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = ['product_id', 'size_id', 'color_id', 'qty'];
    
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function order_detail()
    {
        return $this->belongsTo('App\OrderDetail');
    }
    
    public function color()
    {
        return $this->belongsTo('App\Color');
    }

    public function size()
    {
        return $this->belongsTo('App\Size');
    }
}
