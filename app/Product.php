<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable = ['product_category_id', 'name', 'slug', 'description', 'import_price', 'price', 'discount', 'qty', 'image'];
    
    public function product_category()
    {
        return $this->belongsTo('App\ProductCategory');
    }

    public function attributes()
    {
        return $this->hasMany('App\Attribute');
    }

    public function tags()
    {
        return $this->beLongsToMany('App\Tag','product_tags','product_id','tag_id');
    }
}
