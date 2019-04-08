<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    
    protected $fillable = ['name']; 
    
    public function post_tags()
    {
        return $this->hasMany('App\PostTag');
    }
    
    public function product_tags()
    {
        return $this->hasMany('App\ProductTag');
    }

    public function posts()
    {
        return $this->belongsToMany('App\Post', 'post_tags', 'tag_id', 'post_id');
    }
}
