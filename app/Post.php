<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;
use App\User;
use Carbon\Carbon;

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

    // Using scope with laravl 5: https://www.easylaravelbook.com/blog/using-scopes-with-laravel-5/
    public function scopeFilter ($query, $filters) {

        // dd($filters);
        if ($filters) {
            if ($filters['month']) {
                $query->whereMonth('created_at', $filters['month']);
            }

            if ($filters['year']) {
                $query->whereYear('created_at', $filters['year']);
            }

            $posts = $query->get();
        }
    }

    public static function archives () {
        return static::selectRaw('year(created_at) year, month(created_at) month, count(*) published')
        ->groupBy('year', 'month')
        ->orderByRaw('min(created_at) desc')
        ->get()
        ->toArray();
    }
}
