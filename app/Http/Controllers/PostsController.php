<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{

    public function __construct() {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index () {
    	$posts = Post::all();
    	return view('posts.index', compact('posts'));
    }

    public function create () {
    	return view('posts.create');
    }

    public function show(Post $post) {
    	return view('posts.show', compact('post'));
    }

    public function store () {
    	// 0. Validate the data (Server side validation)
    	$this->validate(request(), [
    		'title' => 'required|min:3|max:50',
    		'body' => 'required|max:255'
    	]);

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
    	// Post::create([
        //     'title' => request('title'), 
        //     'body' => request('body'), 
        //     'user_id' => auth()->user()->id
        // ]);

        // or
        auth()->user()->publish(
            new Post(request(['title', 'body']))
        );

    	// 3. And then redirect to the application
    	return redirect('/posts');
    }
}
