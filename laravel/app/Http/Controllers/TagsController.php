<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Post;

class TagsController extends Controller
{
    public function index (Tag $tag) {
        $posts = $tag->posts;
        $archives = Post::archives();
        $tags = Tag::has('posts')->pluck('name');
        return view('posts.index', compact(['posts', 'archives', 'tags']));
    }
}
