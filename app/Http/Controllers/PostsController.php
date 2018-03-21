<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    public function index () {
    	return view('posts.index');
    }

    public function create () {
    	return view('posts.create');
    }

    public function store () {
    	// 1. Create a new post using request data
    	// dd(request()->all());
    	// dd(request('title'));
    	// dd(request('body'));
    	// dd(request(['title', 'body']));
    	// $post = new Post;

    	// $post->title = request('title');
    	// $post->body = request('body');

    	// 2. Save it into database
    	// $post->save();

    	// 2.5 Use default constructor Post:Create()
    	// Post::create([
    	// 	'title' => request('title'), 
    	// 	'body' => request('body')
    	// ]);

    	// or 
    	// Post::create(request()->all());

    	// or
    	Post::create(request(['title', 'body']));

    	// 3. And then redirect to the application
    	return redirect('/posts');
    }
}
