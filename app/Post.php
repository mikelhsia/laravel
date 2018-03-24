<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;
use App\User;

class Post extends Model
{
    // construct fillable format to accept the data that valid by internal controller
    // PostsController.php
    protected $fillable = ['title', 'body', 'user_id'];

    public function comments() {
    	// return $this->hasMany('App\Comment');
    	return $this->hasMany(Comment::class);
    }

    public function addComment($body) {
    	// Comment::create([
    	// 	'body' => $body,
    	// 	'post_id' => $this->id
    	// ]);

    	/* Doing the same thing with eloquent */
    	// $this->comments()->create(compact('body'));
    	$this->comments()->create(['body' => $body]);
    }


    public function user() {
        // return $this->belongsTo(User::class);
        return User::find($this->user_id);
    }
}
