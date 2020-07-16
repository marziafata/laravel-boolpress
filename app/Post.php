<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'slug', 'category_id'];

    // Il mio post ha una singola categoria
    public function category() {
        return $this->belongsTo('App\Category');
    }
    // e tanti tags
    public function tags() {
        return $this->belongsToMany('App\Tag');
    }
}
