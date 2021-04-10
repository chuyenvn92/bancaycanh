<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = ['order_id', 'attribute_id', 'qty'];

    public function attribute()
    {
        return $this->belongsTo('App\Attribute');
    }

    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
