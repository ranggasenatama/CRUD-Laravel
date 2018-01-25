<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'body'
    ];

    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function tags()
    {
        return $this->morphToMany('App\Tag','taggable');
    }
}
