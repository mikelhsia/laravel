<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

	/* Implementing query method 1 */
    // public static function incomplete() {
    // 	return static::where('completed', '0')->get();
    // }

	/* Implementing query method 2 */
    // Name this function as scope, and Laravel knows this is a query scope
    // Scope is a wrapper of a particular query
    public function scopeIncomplete($query) {
    	return $query->where('completed', '0');
    }
}
