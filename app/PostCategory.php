<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    protected $fillable = [ 'id', 'name', 'slug'];

    public function post()
    {
        return $this->hasMany('App\Post');
    }
}
