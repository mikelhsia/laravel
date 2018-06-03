<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');

// We can group the routes we need authentication for under a common middleware.
// Laravel comes with the auth:api middleware in-built and we can just use that to secure some routes
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/category/{category}/tasks', 'CategoryController@tasks');
    Route::resource('/category', 'CategoryController');
    Route::resource('/task', 'TaskController');
});
/*
|--------------------------------------------------------------------------
| Route good practice
|--------------------------------------------------------------------------
| As a good practice, when creating routes, always put more specific routes ahead of less specific ones.
| For instance, in the code above the /category/{category}/tasks route is above the less specific /category route.
*/

