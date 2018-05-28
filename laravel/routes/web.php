<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Task;

/*
// Bind into service container, and you register this class with service container
App::bind('App\Billing\Stripe', function () {
    return new \App\Billing\Stripe(config('services.stripe.secret'));
});

// Only generate single instance no matter how many time you try to new an instance
App::singleton('App\Billing\Stripe', function () {
    return new \App\Billing\Stripe(config('services.stripe.secret'));
});

// $stripe = App::make('App\Billing\Stripe');
// or ps. resolve() is an alias of app()
// $stripe = resolve('App\Billing\Stripe');
// or
$stripe = app('App\Billing\Stripe');

*/

// Now it's getting value from AppServiceProvider::register()
//dd(resolve('App\Billing\Stripe'));

/***********************************************
// Route to controller instead of inline function
************************************************/
Route::get('/tasks', 'TasksController@index');
Route::get('/tasks/{task}', 'TasksController@show');

/***********************************************
// Route with layout file
************************************************/
// Eloquent model ==> Post
// controller ==> PostsController
// Migration ==> create_posts_table
// Create all three by using "php artisan make:model {name} -mc -r"
//                      -m : migration
//                      -c : controller
//                      -r : resourceful controller
Route::get('/posts', 'PostsController@index');
Route::get('/posts/create', 'PostsController@create');
Route::get('/posts/{post}', 'PostsController@show');
Route::post('/posts/{post}/comments', 'CommentsController@store');
Route::post('/posts', 'PostsController@store');

Route::get('/posts/tag/{tag}', 'TagsController@index');

/***********************************************
// Route without controller
************************************************/
Route::get('/', function () {
	/* Method 1 */
    // return view('welcome', [
    // 	'name' => 'World',
    // 	'age' =>3
    // ]);

    /* Method 2 */
    // return view('welcome')->with('name', 'my world');

    /* Method 3: Pass variable by compact */
    // $name = "Michael";
    // return view('welcome', compact("name"));

    /* Method 4: Fetch variables by array */
    $tasks = [
        'go to store front',
        'finish my screenshot',
        'clean the house'];
    return view("welcome", compact("tasks"));

});

// Route::get('/tasks', function () {
//     /* Method 5: Query database using Laravel's query sentence */
//     //$tasks = DB::table('tasks')->latest()->get();
//     // If I use App/Task, then I can skip the namespace
//     $tasks = Task::all(); // Eloquent method
//     // return $tasks; // Return data as JSON
//     return view("tasks.index", compact("tasks"));
// });

/* Wild cart route */
// Route::get('/tasks/{id}', function ($id) {
// 	/* Helper function */
// 	// dd($id);
//     /* Method 6: Query database using Laravel's query sentence assistance*/
//     // $task = DB::table('tasks')->find($id);
//     $task = App\Task::find($id); // Eloquent method
//     // dd($task);
//     return view("tasks.show", compact("task"));
// });

Auth::routes();
// Redirect to login page
Route::get('/home', 'HomeController@index')->name('home');  // Name this route as home page

Route::get('/register', 'RegistrationController@create');
Route::post('/register', 'RegistrationController@store');

Route::get('/login', 'SessionController@create');
Route::post('/login', 'SessionController@store');

Route::get('/logout', 'SessionController@destroy');
