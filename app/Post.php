<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;

class Post extends Model
{
    // construct fillable format to accept the data that valid by internal controller
    // PostsController.php
    protected $fillable = ['title', 'body'];

    public function comments() {
    	// return $this->hasMany('App\Comment');
    	return $this->hasMany(Comment::class);
    }
}
