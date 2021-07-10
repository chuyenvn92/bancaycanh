<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{   
    protected $fillable = ['user_id', 'total_price', 'status'];

    public function order_details()
    {
        return $this->hasMany('App\OrderDetail');
    }
    public function attributes()
    {
        return $this->beLongsToMany('App\Attribute','order_details','order_id','attribute_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
