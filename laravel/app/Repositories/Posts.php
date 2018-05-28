<?php 
/*
 * Respositories are collections of things that you use very offten
 * Therefor Posts Respository is place you place your functions
 */

namespace App\Repositories;

use App\Post;
use App\Redis;

class Posts {
	protected $redis;

	public function __construct(Redis $redis) {
		$this->redis = $redis;
	}

	public function all() {
		// return all revelant posts
		return Post::all();
	}
}