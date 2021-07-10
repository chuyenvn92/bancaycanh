<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    public function tag()
    {
        return $this->belongsTo('App\Tag');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
