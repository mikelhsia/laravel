<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Repositories\Posts;

class PostsController extends Controller
{

    public function __construct() {
        $this->middleware('auth')->except(['index', 'show']);
    }
/*
    // Method 1
    public function index () {
    	// $posts = Post::all(); // Return collection
        $posts = Post::latest(); // Return Builder

        if (request('month')) {
            $posts->whereMonth('created_at', request('month'));
        }

        if (request('year')) {
            $posts->whereYear('created_at', request('year'));
        }

        if (request('month') || request('year')) {
            $posts = $posts->get();
        }
    }

    // Method 2
    public function index () {
        $posts = Post::latest()
        ->filter(request(['month', 'year']))
        ->get();

        $archives = Post::archives();

        // dd($archives);

        return view('posts.index', compact('posts', 'archives'));
    }

    // Method 3: Using Repository injection
    public function index () {
        $archives = Post::archives();

        $posts = (new \App\Repositories\Posts)->all();

        return view('posts.index', compact('posts', 'archives'));

    }
*/

    // Method 4: Automatic dependency / Automatic resolution
    public function index (Posts $posts) {
        // Dependency Injection to automatically generate a new instance
        // dd($posts);

        $archives = Post::archives();

        // dd($posts);
        $posts = $posts->all();

        return view('posts.index', compact('posts', 'archives'));

    }

    public function create () {
        $archives = Post::archives();

    	return view('posts.create', compact('archives'));
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
