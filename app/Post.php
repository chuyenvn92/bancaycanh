<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    
    protected $fillable = ['post_category_id', 'user_id', 'title', 'slug', 'content', 'image'];

    public function comments()
    {
        return $this->hasMany('App\CommentPost');
    }

    public function postcategory()
    {
        return $this->belongsTo('App\PostCategory');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function posttags()
    {
        return $this->hasMany('App\PostTag');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag','post_tags','post_id','tag_id');
    }
}
