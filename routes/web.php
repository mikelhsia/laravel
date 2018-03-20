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

/***********************************************
// Route to controller instead of inline function
************************************************/
Route::get('/tasks', 'TasksController@index');
Route::get('/tasks/{task}', 'TasksController@show');



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
    	'Go to store front',
    	'Finish my screenshot',
    	'Clean the house'];
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
